@extends('client.layouts.app')

@section('content')

<div id="content">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>

            <div id="basket" class="col-lg-12">
                <div class="box">
                    <div method="" action="">
                        <h1>Giỏ hàng</h1>
                        <p class="ml-1 text-muted">Hiện tại bạn có {{ $countProduct }} sản phẩm trong giỏ hàng.</p>
                        <div class="table-responsive">
                            @if($countProduct < 1)
                            <h3 class="text-danger">Giỏ hàng không có sản phẩm</h3>
                            <div>Tiếp tục mua hàng <a href="{{ route('home.product') }}">Tại đây</a></div>
                            @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Tên (Kích thước / Màu sắc)</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th colspan="2">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartProduct as $item)
                                    <tr id="product-{{ $item->id }}">
                                        <td><a href="{{ route('product.detail',$item->product_id) }}"><img src="{{ $item->product->image_path }}" alt=""></a>
                                        </td>
                                        <td>
                                            <div class="col">
                                                <a class="row" href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->name }}</a>
                                                <span class="text-center">{{ $item->detail->size != "null" ? $item->detail->size : ''}}
                                                    / {{ $item->detail->color != "null" ? $item->detail->color : ''}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input
                                                id ="quantity{{ $item->id }}"
                                                type="number"
                                                min="1"
                                                value="{{ $item->quantity }}"
                                                class="form-control quantity"
                                                data-detail_id="{{ $item->detail->id }}"
                                                data-action = {{ route('cart.update',$item->id) }}
                                                pattern="\d*"
                                                oninput="this.value = this.value.replace(/\D/, '')"
                                                onblur="if(this.value === '') { this.value = '1'}"
                                            >
                                        </td>
                                        <td>{{ number_format($item->detail->price, 0, ',', '.') }} ₫</td>
                                        <td ><span id="total{{ $item->id }}">{{ number_format($item->total, 0, ',', '.') }} ₫</span></td>
                                        <td style="width:1%">
                                            <a
                                                class="delete"
                                                href=""
                                                data-action = {{ route('cart.destroy',$item->id) }}
                                            >
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="mt-3">
                                        <th colspan="3"></th>
                                        <th >Tổng: </th>
                                        <th colspan="2"><span class="text-danger" id="totalCart">{{ number_format($cart->total_cart, 0, ',', '.') }} ₫</span></th>
                                    </tr>
                                </tfoot>
                            </table>
                            @endif
                        </div>

                        <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                            <div class="left"><a href="{{ route('home.product') }}" class="btn btn-outline-secondary"><i
                                        class="fa fa-chevron-left"></i>Tiếp tục mua hàng</a></div>
                            <form class="right" method="GET" action="{{ route('order.create') }}">
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> Cập nhật</a>
                                <button
                                    class="btn btn-primary"
                                    @if($countProduct == 0)
                                        disabled
                                    @endif
                                    >Tiến hành đặt hàng
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </form>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script src={{ asset('client/js/cart.js') }}></script>
@endsection
