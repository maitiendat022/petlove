<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Servieces\CreateServieceRequest;
use App\Http\Requests\Servieces\UpdateServieceRequest;
use App\Models\Servieces;

class ServiecesController extends Controller
{
    protected $serviece;
    public function __construct(Servieces $serviece)
    {
        $this->serviece = $serviece;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $name = request()->name;

        $query = $this->serviece->latest('id');

        if($name){
            $query->where('name', 'LIKE', "%$name%");
        }
        $servieces = $query->paginate(7);
        return view('admin.servieces.index', compact('servieces','name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.servieces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServieceRequest $request)
    {
        //
        $data = $request->all();
        $this->serviece->create($data);
        return to_route('servieces.index')->with(['success' => 'Thêm mới thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $serviece = $this->serviece->findOrfail($id);
        return view('admin.servieces.edit',compact('serviece'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServieceRequest $request, string $id)
    {
        //
        $serviece = $this->serviece->findOrfail($id);
        $data = $request->all();
        $serviece->update($data);
        return to_route('servieces.index')->with(['success' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $serviece = $this->serviece->findOrfail($id);

        if($serviece->status == "active"){
            $serviece->update(['status'=>'inactive']);
            $message = 'Xóa dịch vụ thành công';
        }else{
            $serviece->update(['status'=>'active']);
            $message = 'Mở lại dịch vụ thành công';
        }

        return to_route('servieces.index')->with(['success' => $message]);
    }
}
