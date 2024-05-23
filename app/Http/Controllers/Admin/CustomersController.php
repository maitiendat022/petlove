<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequets;
use App\Http\Requests\Users\UpdateUserRequets;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;
    protected $image;

    public function __construct(User $user, Image $image)
    {
        $this->user = $user;
        $this->image = $image;
    }
    public function index()
    {
        $name = request()->name;

        $query = $this->user->where('role_id',2)->latest('id');
        if($name){
            $query->where('name', 'LIKE', "%$name%");
        }
        $users = $query->paginate(7);
        return view('admin.customers.index', compact('users','name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequets $request)
    {
        //
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if($request->has('image')){
            $data['image'] = $this->user->saveImage($request);
        }else{
            $data['image'] = 'avt-default.jpg';
        }

        $user = $this->user->create($data);
        $user->images()->create(['url'=>$data['image']]);

        return to_route('customers.index')->with(['success' => 'Thêm mới khách hàng thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->user->findOrfail($id);
        $order = $user->order()->latest()->paginate(10);
        return view('admin.customers.show', compact('user','order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequets $request, string $id)
    {
        //
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
            $message = 'Xóa khách hàng thành công';
        }else{
            $user->update(['status'=>'active']);
            $message = 'Kích hoạt khách hàng thành công';
        }

        return to_route('customers.index')->with(['success' => $message]);
    }
}
