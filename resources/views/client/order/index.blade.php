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
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Đơn hàng của tôi</li>
                </ol>
            </nav>
        </div>

        @include('client.layouts.content.sidebar_user')

        <div id="customer-orders" class="col-lg-9">
          <div class="box">
            <h1>Đơn hàng của tôi</h1>
            <p class="lead">Danh sách đơn đặt hàng của bạn</p>
            @if ($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Đơn hàng</th>
                      <th>Ngày đặt</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($orders as $item)
                      <tr>
                          <th>DH{{ $item->id }}PL</th>
                          <td>{{ Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y') }}</td>
                          <td>{{ number_format($item->total, 0, ',', '.') }} đ</td>
                          <td>@include('client.layouts.includes.status',['status'=>$item->status])</td>
                          <td><a href="{{ route('user.order.show',['id' => $item->id]) }}" class="btn btn-primary btn-sm">Xem</a></td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              {{ $orders->links() }}
            @else
            <h3 class="text-danger">Bạn hiện chưa có đơn hàng nào !</h3>
            <div>Tiến hàng đặt hàng <a href="{{ route('cart.index') }}">Tại đây</a></div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
