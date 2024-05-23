@extends('admin.layouts.app')

@section('title','Đánh giá')

@section('content')

@php
use Carbon\Carbon;
@endphp
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Phản hồi đánh giá: #{{ $review->id }}</h3>
                    </div>
                    <hr>
                    <div class="col-12 mt-3">
                        <div class="box ml-5">
                            <p class="lead">Thông tin sản phẩm</p>
                            <div class="row ml-2 mb-2">
                                <div class="col-1">
                                    <a href="{{ route('product.detail',$review->product_id) }}">
                                        <img width="100%" src="{{ $review->orderProduct->product->image_path }}" alt="">
                                    </a>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <span class="col-2">Tên sản phẩm:</span>
                                       {{ $review->orderProduct->product->name }}
                                    </div>
                                    <div class="row">
                                        <span class="col-2">Kích thước:</span>
                                        {{ $review->orderProduct->detail->size != "null" ? $review->orderProduct->detail->size : 'Không có'}}
                                    </div>
                                    <div class="row">
                                        <span class="col-2">Màu sắc:</span>
                                        {{ $review->orderProduct->detail->color != "null" ? $review->orderProduct->detail->color : 'Không có'}}
                                    </div>
                                    <div class="row">
                                        <span class="col-2">Đơn hàng:</span>
                                        #{{ $review->orderProduct->order_id }}
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mb-4">
                                <p class="lead">Thông tin đánh giá</p>
                                <div class="col-9 ml-4">
                                    <div class="row ml-1">
                                        <div class="col-1 pt-1 pl-5">
                                            <img
                                                style="height: 40px;object-fit: cover; border-radius: 50%;"
                                                src="{{ $review->user->images ? asset('upload/user/'.$review->user->images()->first()->url) : asset('upload/user/avt-default.jpg') }}"
                                                alt="">
                                        </div>
                                        <div id="review" class="col">
                                            <span>{{ $review->user->name }}</span>
                                            <div>
                                                @for($i = 1; $i <=5; $i++)
                                                        @if ($i <= $review->rating)
                                                        <i class="fa fa-star text-primary"></i>
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="mt-1 comment" style="max-width:100%;">
                                                <small class="text-secondary">{{ Carbon::parse($review->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y') }}</small>
                                                <pre class="mb-1">{{ $review->comment }}</pre>
                                                <img
                                                    {{ $review->image ? '' : 'hidden' }}
                                                    width="20%"
                                                    src="{{ $review->image ? asset('upload/review/'.$review->image) : '' }}"
                                                    alt="">
                                            </div>
                                            <div class="row">
                                                <form action="{{ route('reviews.feedback') }}" method="POST">
                                                    @csrf
                                                    <input type="text" hidden name="id" value="{{ $review->id }}">
                                                    <div class="col">
                                                        <strong class="row mb-1 mt-1">Phản hồi</strong>
                                                        @error('feedback')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="d-flex flex-column">
                                                            <textarea {{ $review->feedback ? 'readonly' : '' }} class="row" name="feedback" id="" rows="8" placeholder="Nhập thông tin phản hồi">{{ $review->feedback }}</textarea>
                                                            <button {{ $review->feedback ? 'disabled' : '' }} class="btn btn-info mt-2 ml-auto mr-3" type="submit">Lưu phản hồi</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
