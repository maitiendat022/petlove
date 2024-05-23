<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Orders;
use App\Models\Reviews;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    protected $order;
    protected $orderProduct;
    protected $review;

    protected $orderStatus = [
        ['id' => 'unconfirmed','name' => 'Chờ xác nhận'],
        ['id' => 'confirmed','name' => 'Đã xác nhận'],
        ['id' => 'processing','name' => 'Đang xử lý'],
        ['id' => 'delivering','name' => 'Đang giao hàng'],
        ['id' => 'completed','name' => 'Đã giao hàng'],
        ['id' => 'cancel','name' => 'Đã hủy'],
    ];
    public function __construct(Orders $order, OrderProduct $orderProduct, Reviews $review)
    {
        $this->order = $order;
        $this->orderProduct = $orderProduct;
        $this->review = $review;
    }
    public function index(){
        $status = request()->status;
        $name = request()->name;

        $query = $this->order->latest('id');

        if($status){
            $query->where('status', $status);
        }
        if($name){
            $query->where('reciver_phone', 'LIKE', "%$name%");
        }
        $orders = $query->paginate(7);
        $orderStatus = $this->orderStatus;
        return view('admin.orders.index', compact('orders','orderStatus','status','name'));
    }
    public function show(string $id){
        $order = $this->order->findOrfail($id);
        $orderProduct = $order->orderProduct->all();
        return view('admin.orders.show', compact('order','orderProduct'));
    }
    public function update(Request $request){
        $status = $request->status;
        switch($status){
            case 'unconfirmed':
                $status = 'confirmed';
                break;
            case 'confirmed':
                $status = 'processing';
                break;
            case 'processing':
                $status = 'delivering';
                break;
            case 'delivering':
                $status = 'completed';
                break;
        }
        $order = $this->order->findOrfail($request->id);
        if($status == 'completed'){
            $orderProduct = $order->orderProduct->all();
            foreach($orderProduct as $item){
                $data[] = [
                    'user_id' => $order->user_id,
                    'product_id' => $item->product_id,
                    'orderProduct_id' => $item->id
                ];
            }
            $this->review->insert($data);
        }
        $order->update(['status'=> $status]);
        return to_route('orders.index')->with(['success' => 'Cập nhật trạng thái đơn hàng thành công']);
    }
    public function cancel(Request $request){
        $order = $this->order->findOrfail($request->id);
        $orderProducts = $order->orderProduct->all();
        foreach ($orderProducts as $orderProduct) {
            $detail = $orderProduct->detail;
            $detail->increment('quantity', $orderProduct->quantity);
        }
        $order->update(['status'=> 'cancel']);
        return to_route('orders.index')->with(['success' => 'Hủy đơn hàng thành công']);
    }
}
