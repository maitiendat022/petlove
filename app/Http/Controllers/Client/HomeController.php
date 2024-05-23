<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Pets;
use App\Models\ProductDetail;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    protected $category;
    protected $product;
    protected $pet;
    protected $detail;

    public function __construct(Categories $category, Products $product, Pets $pet, ProductDetail $detail)
    {
        $this->pet = $pet;
        $this->product = $product;
        $this->category = $category;
        $this->detail = $detail;
    }
    public function index(){
        if (auth()->user() && auth()->user()->role_id != 2) {
            return back()->with('warning','Bạn không có quyền truy cập');
        }
        $product = $this->product->inRandomOrder()->where('status','active')->take(10)->get();
        return view('client.pages.index',compact('product'));
    }
    public function product(Request $request){
        if (auth()->user() && auth()->user()->role_id != 2) {
            return back()->with('warning','Bạn không có quyền truy cập');
        }
        $pet_id = $request->pet_id;
        $parent_id = $request->parent_id;
        $category_id = $request->category_id;

        $name = request()->name;

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
        if($name) {
            $query->where('name', 'LIKE', "%$name%");
        }
        $products = $query->paginate(9);
        return view('client.shop.product',compact('products','pet_id','parent_id','category_id','name'));
    }
    public function detail(Request $request){
        if (auth()->user() && auth()->user()->role_id != 2) {
            return back()->with('warning','Bạn không có quyền truy cập');
        }
        $id = $request->id;

        $product = $this->product->findOrfail($id);
        $category_id = $product->category_id;
        $parent_id = $product->category->parent_id;
        $pet_id = $product->category->pet_id;

        $query = $product->review()->whereNotNull('rating');
        $rating = $request->rating;
        if($rating){
            $query = $query->where('rating', $rating);
        }
        $review = $query->orderBy('created_at')->paginate(3);

        $detail = $this->detail->where('product_id', $id)->get();
        return view('client.shop.detail', compact('product', 'detail','pet_id','parent_id','category_id','review','rating'));
    }
}

