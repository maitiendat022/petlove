@extends('client.layouts.app')

@section('content')

@php
use Carbon\Carbon;
@endphp
<div id="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li aria-current="page" class="breadcrumb-item"><a href="#">Đơn hàng của tôi</a></li>
              <li aria-current="page" class="breadcrumb-item active">Đơn hàng DH{{  $order->id }}PL</li>
            </ol>
          </nav>
        </div>

        @include('client.layouts.content.sidebar_user')

        <div id="customer-order" class="col-lg-9">
          <div class="box">
            <h1>Đơn hàng DH{{ $order->id }}PL</h1>
            <hr>
            <div class="col-11" style="font-size: 16px">
                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <span class="col-4">Tên người nhận :</span> <strong>{{ $order->reciver_name }}</strong>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Số điện thoại :</span> <strong>{{ $order->reciver_phone }}</strong>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Địa chỉ :</span> {{ $order->reciver_address }}
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">
                                Thời gian đặt:
                            </span>
                            {{ Carbon::parse($order->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y')  }}
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Ghi chú :</span> {{ $order->note }}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="ml-auto">
                                @include('client.order.updateOrder',['status'=>$order->status])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="ml-auto">
                        @include('client.layouts.includes.statusShow',['status'=>$order->status,
                        'time'=>Carbon::parse($order->updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')])
                    </div>
                </div>
            </div>
            <hr>

            <div class="table-responsive mb-4">
              <table class="table">
                <thead>
                  <tr>
                    <th>Sản phẩm</th>
                    <th colspan="2">Tên sản phẩm (Kích thước/màu sắc)</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orderProduct as $item)
                    <tr>
                        <td><a href="{{ route('product.detail',$item->product_id) }}"><img src="{{ $item->product->image_path }}" alt=""></td>
                        <td colspan="2">
                            <div class="col">
                                <a class="row" href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->name }}</a>
                                <span class="text-center">{{ $item->detail->size != "null" ? $item->detail->size : ''}}
                                / {{ $item->detail->color != "null" ? $item->detail->color : ''}}</span>
                            </div>
                        </td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td>{{ number_format($item->detail->price, 0, ',', '.') }} ₫</td>
                        <td>{{ number_format($item->total, 0, ',', '.') }} ₫</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="5" class="text-right font-weight-bold">Tổng tiền:</th>
                    <th class="text-danger font-weight-bold">{{ number_format($order->total, 0, ',', '.') }} ₫</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
