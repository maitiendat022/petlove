<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use App\Models\Carts;
use App\Models\ProductDetail;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $product;
    protected $detail;
    protected $cart;
    protected $cartProduct;

    public function __construct(Products $product, ProductDetail $detail, Carts $cart, CartProduct $cartProduct)
    {
        $this->product = $product;
        $this->detail = $detail;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cart = $this->cart->firstOrCreate(auth()->user()->id);
        $cartProduct = $cart->cartProduct->where('cart_id',$cart->id);

        return view('client.shop.cart',compact('cartProduct','cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = $this->product->findOrfail($request->product_id);
        if(!$request->detail_id && $product->detail->count() > 1 ){
            return to_route('product.detail',$request->product_id)->with(['warning' => 'Vui lòng chọn chi tiết sản phẩm']);
        }
        if(!$request->detail_id && $product->detail->count() == 1 ){
            $detail = $product->detail->first();
        }else{
            $detail = $this->detail->findOrfail($request->detail_id);
        }
        $cart = $this->cart->firstOrCreate(auth()->user()->id);
        $cartProduct = $this->cartProduct->get($cart->id,$detail->id);
        if($cartProduct){
            $quantity = $cartProduct->quantity;
            if($detail->quantity < ($quantity + $request->quantity)){
                return back()->with(['error' => 'Số lượng sản phẩm còn lại không đủ']);
            }
            $cartProduct->update(['quantity' => ($quantity + $request->quantity)]);
        }else{
            if($detail->quantity < $request->quantity){
                return back()->with(['error' => 'Số lượng sản phẩm còn lại không đủ']);
            }
            $data = [
                'cart_id' => $cart->id,
                'detail_id' => $detail->id,
                'product_id' => $detail->product_id,
                'quantity' => $request->quantity,
            ];
            $this->cartProduct->create($data);
        }
        return back()->with(['success' => 'Thêm vào giỏ thành công']);
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = $this->cart->firstOrCreate(auth()->user()->id);
        $detail = $this->detail->findOrfail($request->detail_id);
        $cartProduct = $this->cartProduct->findOrFail($id);
        $quantity_old = $cartProduct->quantity;
        if ($request->quantity > $detail->quantity) {
            return response()->json([
                'id' => $id,
                'error' => 'Số lượng sản phẩm không đủ trong kho',
                'quantity' => $quantity_old,
            ]);
        }
        $cartProduct->update(['quantity' => $request->quantity]);
        $totalCart = $cart->total_cart;

        return response()->json([
            'id' => $id,
            'total' => $cartProduct->total,
            'totalCart' => $totalCart,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cart = $this->cart->firstOrCreate(auth()->user()->id);
        $this->cartProduct->destroy($id);
        $totalCart = $cart->total_cart;

        return response()->json([
            'id' => $id,
            'totalCart' => $totalCart,
        ]);
    }
}
