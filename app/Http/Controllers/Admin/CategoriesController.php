<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateCategoryRequets;
use App\Http\Requests\Categories\UpdateCategoryRequets;
use App\Models\Categories;
use App\Models\Pets;

class CategoriesController extends Controller
{
    protected $category;
    protected $pet;

    public function __construct(Categories $category, Pets $pet)
    {
        $this->category = $category;
        $this->pet = $pet;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pet_id = request()->pet_id;
        $parent_id = request()->parent_id;
        $name = request()->name;

        $status = request()->status;


        $query = $this->category->latest('id');
        $parent = $this->category->whereNull('parent_id')->get();
        if($pet_id){
            $query->where('pet_id', $pet_id);
        }
        if($parent_id){
            $query->where('parent_id', $parent_id);
        }
        if($name){
            $query->where('name', 'LIKE', "%$name%");
        }
        if($status) {
            $query->where('status', $status);
        }
        $categories = $query->paginate(8);

        $pets = $this->pet->all();
        return view('admin.categories.index', compact('categories','parent','pets','pet_id','parent_id','name','status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pets = $this->pet->where('status','active')->get();
        $parent = $this->category->whereNull('parent_id')->get();
        return view('admin.categories.create',compact('pets','parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequets $request)
    {
        //
        $data = $request->all();
        if($data['parent_id']){
            $parent = $this->category->where('id',$data['parent_id'])->first();
            if($parent->pet_id != $data['pet_id']){
                return redirect()->back()->withErrors(['parent_id' => 'Danh mục cha không thuộc loại thú cưng này']);
            }
        }
        $this->category->create($data);
        return to_route('categories.index')->with(['success' => 'Thêm mới danh mục thành công']);

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
        $pets = $this->pet->where('status','active')->get();
        $parent = $this->category->whereNull('parent_id')->get();
        $category = $this->category->findOrfail($id);
        return view('admin.categories.edit',compact('category','pets','parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequets $request, string $id)
    {
        //
        $category = $this->category->findOrfail($id);
        $data = $request->all();
        if($data['parent_id']){
            $parent = $this->category->where('id',$data['parent_id'])->first();
            if($parent->pet_id != $data['pet_id']){
                return redirect()->back()->withErrors(['parent_id' => 'Danh mục cha không thuộc loại thú cưng này']);
            }
            if($category->children()->exists()){
                return redirect()->back()->withErrors(['parent_id' => 'Danh mục này đã tồn tại danh mục con']);
            }
        }else{
            if($category->products()->exists()){
                return redirect()->back()->withErrors(['name' => 'Đã tồn tại sản phẩm thuộc danh mục này']);
            }
        }
        $category->update($data);
        return to_route('categories.index')->with(['success' => 'Cập nhật danh mục thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->category->findOrfail($id);

        if($category->status == "active"){
            $data = $category->updateInactive();
        }else{
            $data = $category->updateActive();
        }
        return to_route('categories.index')->with([$data['type'] => $data['message'] ]);
    }
}
