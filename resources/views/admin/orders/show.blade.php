@extends('admin.layouts.app')

@section('title','Đơn hàng')

@section('content')

@php
use Carbon\Carbon;
@endphp
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover" style="font-size: 18px">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Chi tiết đơn hàng: #{{ $order->id }}</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 ml-5">
                            <div class="row mb-2">
                                <span class="col-3">Tên người nhận:</span>
                                <strong class="col">{{ $order->reciver_name }}</strong>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Số điện thoại:</span>
                                <strong class="col">{{ $order->reciver_phone }}</strong>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Địa chỉ:</span>
                                <span class="col">{{ $order->reciver_address }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Thanh toán:</span>
                                <span class="col">{{ ($order->payment = 'cash') ? 'Tiền mặt' : 'Online' }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Thời gian đặt:</span>
                                <span class="col">{{ Carbon::parse($order->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')  }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Tổng tiền:</span>
                                <strong class="col text-danger">{{ number_format($order->total, 0, ',', '.') }} đ</strong>
                            </div>
                            <div class="row">
                                <span class="col-3">Ghi chú:</span>
                                <span class="col">{{ $order->note }}</span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row mb-2">
                                <span class="col-4">Trạng thái:</span>
                                <span class="col">@include('admin.orders.status',['status'=>$order->status])</span>
                            </div>
                            <div class="row">
                                <span class="col-4">Thời gian cập nhật:</span>
                                <span class="col">{{ Carbon::parse($order->updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4 class="ml-4 mb-4">Thông tin sản phẩm</h4>
                        <div class="ml-5 mr-5 pl-5 pr-5">
                            <table class="table table-bordered">
                                <thead>
                                    <th width="2%">Sản phẩm</th>
                                    <th width="25%">Tên sản phẩm</th>
                                    <th width="5%">Kích thước</th>
                                    <th width="5%">Màu sắc</th>
                                    <th width="8%">Đơn giá</th>
                                    <th width="5%">Số lượng</th>
                                    <th width="8%">Thành tiền</th>
                                </thead>
                                <tbody>
                                    @foreach ($orderProduct as $item)
                                    <tr>
                                        <td style="text-align: center"><a href="{{ route('products.show',$item->product_id) }}"><img height="100px" src="{{ $item->product->image_path }}" alt=""></a></td>
                                        <td style="padding-top: 50px"><a href="{{ route('products.show',$item->product_id) }}">{{ $item->product->name }}</a></td>
                                        <td style="padding-top: 50px">{{ ($item->detail->size != 'null') ? $item->detail->size : '' }}</td>
                                        <td style="padding-top: 50px">{{ ($item->detail->color != 'null') ? $item->detail->color : ''}}</td>
                                        <td style="padding-top: 50px">{{ number_format($item->detail->price, 0, ',', '.') }} đ</td>
                                        <td style="padding-top: 50px">{{ $item->quantity  }}</td>
                                        <td style="padding-top: 50px">{{ number_format($item->total, 0, ',', '.') }} đ</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
