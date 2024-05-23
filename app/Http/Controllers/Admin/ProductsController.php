<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequets;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Categories;
use App\Models\Images;
use App\Models\Pets;
use App\Models\ProductDetail;
use App\Models\Products;

class ProductsController extends Controller
{
    protected $product;
    protected $category;
    protected $image;
    protected $detail;
    protected $pet;

    public function __construct(Products $product, Categories $category, Images $image, ProductDetail $detail, Pets $pet)
    {
        $this->product = $product;
        $this->category = $category;
        $this->image = $image;
        $this->detail = $detail;
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
        $category_id = request()->category_id;
        $name = request()->name;
        $status = request()->status;

        $query = $this->product->latest('id');

        if ($pet_id) {
            $query->whereHas('category.pet', function ($q) use ($pet_id) {
                $q->where('id', $pet_id);
            });
        }
        if ($parent_id) {
            $query->whereHas('category.parent', function ($q) use ($parent_id) {
                $q->where('id', $parent_id);
            });
        }
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        if ($name) {
            $query->where('name', 'LIKE', "%$name%");
        }
        if($status) {
            $query->where('status', $status);
        }
        $products = $query->paginate(7);
        $categories = $this->category->whereNotNull('parent_id')->get();
        $parent = $this->category->whereNull('parent_id')->get();
        $pets = $this->pet->all();

        return view('admin.products.index', compact('products', 'categories','pets',
        'parent', 'category_id','pet_id','parent_id', 'name', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->category->whereNotNull('parent_id')->where('status','active')->get();
        $parent = $this->category->whereNull('parent_id')->where('status','active')->get();
        $pets = $this->pet->where('status','active')->get();
        return view('admin.products.create',compact('categories','parent','pets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequets $request)
    {
        $data = $request->all();
        $data['image'] = $this->product->saveImage($request);

        $product = $this->product->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
        ]);
        foreach ($data['image'] as $image) {
            $product->images()->create(['url' => $image]);
        }
        $dataDetail = [];
        foreach ($data['size'] as $key => $size) {
            $dataDetail[] = [
                'size' => $size,
                'color' => $data['color'][$key],
                'price' => isset($data['price'][$key]) ? $data['price'][$key] : null,
                'quantity' => isset($data['quantity'][$key]) ? $data['quantity'][$key] : null,
                'product_id' => $product->id,
            ];
        }
        $this->detail->insert($dataDetail);

        return to_route('products.index')->with(['success' => 'Thêm mới sản phẩm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product->findOrfail($id);
        $query = $product->review()->latest();
        $rating = request()->rating;
        if($rating){
            $query = $query->where('rating',$rating);
        }
        $review = $query->paginate(3);
        $detail = $product->detail;
        return view('admin.products.show', compact('product','review','detail','rating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categories = $this->category->whereNotNull('parent_id')->where('status','active')->get();
        $parent = $this->category->whereNull('parent_id')->where('status','active')->get();
        $pets = $this->pet->where('status','active')->get();

        $product = $this->product->findOrfail($id);
        $productDetail = $this->detail->where('product_id', $id)->get();
        return view('admin.products.edit', compact('product', 'productDetail','categories','parent','pets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        //
        $product = $this->product->findOrfail($id);
        $productDetail = $this->detail->where('product_id', $id)->get();
        $data = $request->all();
        if ($request->has('image')) {
            foreach($product->images as $image){
                $product->deleteImage($image->url);
            }
            $data['image'] = $this->product->saveImage($request);
            $product->images()->delete();
            foreach ($data['image'] as $image) {
                $product->images()->create(['url' => $image]);
            }
        }
        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
        ]);
        if ($data['createDetail'] == 'true') {
            $product->detail()->delete();
            $dataDetail = [];
            foreach ($data['size'] as $key => $size) {
                $dataDetail[] = [
                    'size' => $size,
                    'color' => $data['color'][$key],
                    'price' => isset($data['price'][$key]) ? $data['price'][$key] : null,
                    'quantity' => isset($data['quantity'][$key]) ? $data['quantity'][$key] : null,
                    'product_id' => $product->id,
                ];
            }
            $this->detail->insert($dataDetail);
        } else {
            foreach ($productDetail as $key => $detail) {
                $detail->update([
                    'size' => $data['size'][$key],
                    'color' => $data['color'][$key],
                    'price' => isset($data['price'][$key]) ? $data['price'][$key] : null,
                    'quantity' => isset($data['quantity'][$key]) ? $data['quantity'][$key] : null,
                ]);
            }
        }
        return to_route('products.index')->with(['success' => 'Cập nhật sản phẩm thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->product->findOrfail($id);

        if($product->status == "active"){
            $data = $product->updateInactive();
        }else{
            $data = $product->updateActive();
        }
        return to_route('products.index')->with([$data['type'] => $data['message']]);
    }
}
