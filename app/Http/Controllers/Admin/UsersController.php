<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequets;
use App\Http\Requests\Users\UpdateUserRequets;
use App\Models\Images;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $user;
    protected $role;
    protected $image;

    public function __construct(User $user, Roles $role, Images $image)
    {
        $this->user = $user;
        $this->role = $role;
        $this->image = $image;
    }
    /**
     *
     * Display a listing of the resource.
     */
    public function index()
    {
        $role_id = request()->role_id;
        $name = request()->name;
        $status = request()->status;

        $query = $this->user->latest('id');

        if($role_id){
            $query->where('role_id', $role_id);
        }
        if($name){
            $query->where('name', 'LIKE', "%$name%");
        }
        if($status) {
            $query->where('status', $status);
        }
        $users = $query->paginate(7);
        $roles = $this->role->all();
        return view('admin.users.index', compact('users','roles','role_id','name','status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = $this->role->get();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequets $request)
    {
        //
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = $this->user->create($data);
        if($request->has('image')){
            $data['image'] = $this->user->saveImage($request);
            $user->images()->create(['url'=>$data['image']]);
        }
        return to_route('users.index')->with(['success' => 'Thêm mới người dùng thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->user->findOrfail($id);
        $order = $user->order()->latest()->paginate(10);
        return view('admin.users.show', compact('user','order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = $this->user->findOrfail($id);
        $roles = $this->role->get();
        return view('admin.users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequets $request, string $id)
    {
        //
        $user = $this->user->findOrfail($id);

        $data = $request->all();
        if($request->has('image')){
            if($user->images()->first()){
                $curentImage = $user->images()->first()->url;
                $data['image'] = $user->uploadImage($request, $curentImage);
                $user->images()->update(['url'=>$data['image']]);
            }else{
                $data['image'] = $this->user->saveImage($request);
                $user->images()->create(['url'=>$data['image']]);
            }
        }
        $user->update($data);
        return to_route('users.index')->with(['success' => 'Cập nhật người dùng thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = $this->user->findOrfail($id);

        if($user->status == "active"){
            $user->update(['status'=>'inactive']);
            $message = 'Xóa người dùng thành công';
        }else{
            $user->update(['status'=>'active']);
            $message = 'Kích hoạt người dùng thành công';
        }

        return to_route('users.index')->with(['success' => $message]);
    }
}
