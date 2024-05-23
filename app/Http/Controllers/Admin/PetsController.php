<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pets\CreatePetRequets;
use App\Http\Requests\Pets\UpdatePetRequets;
use App\Models\Pets;

class PetsController extends Controller
{
    protected $pet;
    public function __construct(Pets $pet)
    {
        $this->pet = $pet;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $name = request()->name;

        $query = $this->pet->latest('id');

        if($name){
            $query->where('name', 'LIKE', "%$name%");
        }
        $pets = $query->paginate(7);
        return view('admin.pets.index', compact('pets','name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePetRequets $request)
    {
        //
        $data = $request->all();
        $this->pet->create($data);
        return to_route('pets.index')->with(['success' => 'Thêm mới thành công']);
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
        $pet = $this->pet->findOrfail($id);
        return view('admin.pets.edit',compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequets $request, string $id)
    {
        //
        $pet = $this->pet->findOrfail($id);
        $data = $request->all();
        $pet->update($data);
        return to_route('pets.index')->with(['success' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = $this->pet->findOrfail($id);

        if($pet->status == "active"){
            $data = $pet->updateInactive();
        }else{
            $data = $pet->updateActive();
        }
        return to_route('pets.index')->with([$data['type'] => $data['message']]);
    }
}
