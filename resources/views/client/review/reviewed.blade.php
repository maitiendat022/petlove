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
                    <h1>Sản phẩm đã đánh giá</h1>
                    <p class="lead">Danh sách sản phẩm bạn đã đánh giá</p>
                    <div class="nav flex-column flex-sm-row nav-pills">
                        <a href="{{ route('user.review.index') }}" class="nav-link flex-sm-fill text-sm-center">
                            Chưa đánh giá
                        </a>
                        <a href="{{ route('user.review.reviewed') }}" class="nav-link flex-sm-fill text-sm-center active">
                            Đã đánh giá
                        </a>
                    </div>
                    <div class="ml-3 mb-4">
                        <form action="">
                            <div class="form-group">
                                <label class="row" for="rating">Phân loại đánh giá</label>
                                <div class="row">
                                    <select class="form-control col-2 mr-3" name="rating" id="rating">
                                        <option value="">Tất cả</option>
                                        @for ($i=1; $i<=5; $i++)
                                        <option {{ $i == $rating ? 'selected' : '' }} value="{{ $i }}">{{ $i }} sao</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn btn-info">Lọc</button>
                                </div>
                            </div>
                        </form>
                        @if ($reviewed->count() > 0)
                        @foreach ($reviewed as $item)
                        <hr>
                        <div class="row ml-3">
                            <div class="row">
                                <div class="row ml-1">
                                    <a href="{{ route('user.order.show',['id'=> $item->orderProduct->order_id]) }}">
                                        Đơn hàng DH{{ $item->orderProduct->order_id }}PL đã được giao thành công<i class="fa fa-check-circle"></i>
                                    </a>
                                </div>
                                <div class="row pl-1">
                                    <div class="col-1 ml-1">
                                        <a class="" href="{{ route('product.detail',$item->product_id) }}">
                                            <img width="180%" src="{{ $item->orderProduct->product->image_path }}" alt="">
                                        </a>
                                    </div>
                                    <div class="col ml-3" style="font-size: 13px">
                                        <span class="row">{{ $item->orderProduct->product->name }}</span>
                                        <span class="row">
                                            {{ $item->orderProduct->detail->size != "null" ? $item->orderProduct->detail->size : ''}}
                                             | {{ $item->orderProduct->detail->color != "null" ? $item->orderProduct->detail->color : ''}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="row ml-4" style="width:700px">
                                    <div class="col-1 ml-4 pt-1">
                                        <img
                                            style="height: 35px;object-fit: cover; border-radius: 50%;"
                                            src="{{ auth()->user()->images ? asset('upload/user/'.auth()->user()->images()->first()->url) : asset('upload/user/avt-default.jpg') }}"
                                            alt="">
                                    </div>
                                    <div id="review" class="pr-2 col">
                                        <span>{{ auth()->user()->name }}</span>
                                        <div>
                                            @for($i = 1; $i <=5; $i++)
                                                    @if ($i <= $item->rating)
                                                    <i class="fa fa-star text-primary"></i>
                                                @else
                                                    <i class="fa fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="mt-1" style="max-width:90%;">
                                            <pre class="mb-1">{{ $item->comment }}</pre>
                                            <img
                                                {{ $item->image ? '' : 'hidden' }}
                                                width="20%"
                                                src="{{ $item->image ? asset('upload/review/'.$item->image) : '' }}"
                                                alt="">
                                        </div>
                                        <small class="text-secondary">{{ Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y') }}</small>
                                        @if ($item->feedback != null)
                                        <div class="feedback">
                                            <strong>Phản hồi của người bán</strong>
                                            <pre class="mb-1">{{ $item->feedback }}</pre>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p class="text-danger">Không có sản phẩm đã đánh giá !</p>
                        @endif
                    </div>
                    {{ $reviewed->appends(['rating' => $rating])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
