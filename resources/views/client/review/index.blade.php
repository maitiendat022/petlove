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
                        <li aria-current="page" class="breadcrumb-item active">Đánh giá</li>
                    </ol>
                </nav>
            </div>

            @include('client.layouts.content.sidebar_user')
            <div id="checkout" class="col-lg-9">
                <div class="box">
                    <h1>Sản phẩm đã mua</h1>
                    <p class="lead">Danh sách sản phẩm bạn đã mua</p>
                    <div class="nav flex-column flex-sm-row nav-pills">
                        <a href="{{ route('user.review.index') }}" class="nav-link flex-sm-fill text-sm-center active">
                            Chưa đánh giá
                        </a>
                        <a href="{{ route('user.review.reviewed') }}" class="nav-link flex-sm-fill text-sm-center ">
                            Đã đánh giá
                        </a>
                    </div>
                    @if ($reviews->count() > 0)
                    <div class="table-responsive mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th colspan="2">Tên sản phẩm (Kích thước/màu sắc)</th>
                                    <th>Đơn hàng</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $item)
                                <tr>
                                    <td><a href="{{ route('product.detail',$item->product_id) }}">
                                            <img src="{{ $item->orderProduct->product->image_path }}" alt="">
                                        </a>
                                    </td>
                                    <td colspan="2">
                                        <div class="col">
                                            <a class="row" href="{{ route('product.detail',$item->product_id) }}">{{
                                                $item->orderProduct->product->name }}</a>
                                            <span class="text-center">{{ $item->orderProduct->detail->size != "null"
                                                ? $item->orderProduct->detail->size : ''}}
                                                / {{ $item->orderProduct->detail->color != "null" ?
                                                $item->orderProduct->detail->color : ''}}</span>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('user.order.show',['id' => $item->orderProduct->order_id]) }}">DH{{ $item->orderProduct->order_id }}PL</a></td>
                                    <td>
                                        <div class="pl-3">
                                            <span class="text-success row">Đã giao hàng</span>
                                        <span class="row">{{ Carbon::parse($item->orderProduct->order->updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y') }}</span>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('user.review.create',['id' => $item->id]) }}"
                                            class="btn btn-primary btn-sm">Đánh giá</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $reviews->links() }}
                    @else
                    <h4 class="text-danger">Bạn hiện chưa có sản phẩm cần đánh giá !</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
