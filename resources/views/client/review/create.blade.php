@extends('client.layouts.app')

@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Đánh giá sản phẩm</li>
                    </ol>
                </nav>
            </div>

            @include('client.layouts.content.sidebar_user')
            <div id="checkout" class="col-lg-9">
                <div class="box">
                    <h1>Đánh giá sản phẩm</h1>
                    <p class="lead">Thông tin sản phẩm</p>
                    <div class="nav flex-column flex-sm-row nav-pills pb-3">
                        <div class="col-2">
                            <a href="{{ route('product.detail',$review->product_id) }}">
                                <img width="100%" src="{{ $review->orderProduct->product->image_path }}" alt="">
                            </a>
                        </div>
                        <div class="col pt-2" style="font-size:15px">
                            <div class="row">
                                <span class="col-3">Tên sản phẩm:</span>
                                <a href="{{ route('product.detail',$review->product_id) }}">
                                    {{ $review->orderProduct->product->name }}
                                </a>
                            </div>
                            <div class="row mt-2">
                                <span class="col-3">Kích thước:</span>
                                {{ $review->orderProduct->detail->size != "null" ? $review->orderProduct->detail->size : 'Không có'}}
                            </div>
                            <div class="row mt-2">
                                <span class="col-3">Màu sắc:</span>
                                {{ $review->orderProduct->detail->color != "null" ? $review->orderProduct->detail->color : 'Không có'}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <p class="lead">Thông tin đánh giá</p>
                        <div class="col">
                            <form action="{{ route('user.review.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="text" name="id" hidden value="{{ $review->id }}">
                                <div class="row ml-1 d-flex align-items-center">
                                    <label for="rating">Chất lượng sản phẩm:</label>
                                    <div class="rating ml-3 mr-2">
                                        @for($i = 5; $i >=1; $i--)
                                            <input hidden {{ ($i == 5) ? 'checked' : '' }} type="radio" id="rating{{ $i }}" name="rating" value="{{ $i }}" required>
                                            <label for="rating{{ $i }}"><i class="fa fa-star"></i></label>
                                        @endfor
                                    </div>
                                    <div>
                                        <label id="selectedLabel" class=""></label>
                                    </div>
                                </div>
                                <div class="row ml-1">
                                    <div class="form-group">
                                        <div>
                                            <label for="image" class="btn btn-info btn-sm"><i class="fa fa-camera"></i> Thêm ảnh</label>
                                            <input hidden type="file" accept="images/" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="35%"  class="img-fluid"src=""alt="" id="show-image">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row ml-1">
                                    <div class="col">
                                        <label class="row" for="comment">Nhận xét: </label>
                                        <div class="row">
                                            <textarea class="p-2" name="comment" id="" cols="85" rows="10" placeholder="Nhập đánh giá">{{ old('comment') }}</textarea>
                                        </div>
                                        @error('comment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3 ml-1">
                                    <button class="btn btn-primary">Lưu đánh giá</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('client/js/review.js') }}"></script>
@endsection
