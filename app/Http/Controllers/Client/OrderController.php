<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Carts;
use App\Models\OrderProduct;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $cart;
    protected $order;
    protected $orderProduct;

    public function __construct(Carts $cart, Orders $order, OrderProduct $orderProduct)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->orderProduct = $orderProduct;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = $this->order
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);
        return view('client.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('client.order.information');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        //
        $cart = $this->cart->firstOrCreate(auth()->user()->id);
        $cartProduct = $cart->cartProduct->where('cart_id',$cart->id);
        $totalOrder = $cart->totalCart;

        if($request->payment == "cash"){
            $order = $this->order->create([
                'user_id' => auth()->user()->id,
                'reciver_name' => $request->name,
                'reciver_phone' => $request->phone,
                'reciver_address' => $request->address . ', ' . $request->ward . ', ' . $request->district . ', ' . $request->city,
                'note' => $request->note,
                'payment' =>  $request->payment,
                'total' => $totalOrder,
            ]);
            $data = [];
            foreach($cartProduct as $item){
                $data[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'detail_id' => $item->detail_id,
                    'quantity' => $item->quantity,
                    'total' => $item->total,
                ];
                $item->detail->decrement('quantity', $item->quantity);
            }
            $orderProduct = $this->orderProduct->insert($data);
            if($orderProduct){
                $cart->cartProduct()->delete();
                return to_route('user.order.index')->with('success','Đặt hàng thành công');
            }
        }else{
            return back()->with('warning','Hiện tại cửa hàng chưa hỗ trợ thanh toán online');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $order = $this->order->findOrfail($id);
        $orderProduct = $this->orderProduct->where('order_id',$order->id)->get();
        return view('client.order.show',compact('order','orderProduct'));
    }
    public function update(Request $request)
    {
        $order = $this->order->findOrfail($request->id);
        $orderProducts = $this->orderProduct->where('order_id', $order->id)->get();
        foreach ($orderProducts as $orderProduct) {
            $detail = $orderProduct->detail;
            $detail->increment('quantity', $orderProduct->quantity);
        }
        $order->update(['status'=> $request->status]);
        return to_route('user.order.show',['id'=> $request->id ])->with(['success' => 'Bạn đã hủy đơn hàng thành công']);
    }
}
