@extends('admin.layouts.app')

@section('title','Sản phẩm')

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
                        <h3 class="card-title">Chi tiết sản phẩm: #{{ $product->id }}</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 ml-5">
                            <div class="row mb-2">
                                <span class="col-3">Tên sản phẩm:</span>
                                <strong class="col">{{ $product->name }}</strong>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Danh mục:</span>
                                <span class="col">{{ $product->categoryName }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Thú cưng:</span>
                                <span class="col">{{ $product->category->petName }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Kích thước:</span>
                                <span class="col">
                                    @if(count(collect($detail)->unique('size'))>1)
                                        @foreach (collect($detail)->unique('size') as $item)
                                            {{  $item->size }},
                                        @endforeach
                                    @elseif(count(collect($detail)->unique('size')) == 1 && $detail[0]->size !='null')
                                    @foreach (collect($detail)->unique('size') as $item)
                                        {{  $item->size }}
                                    @endforeach
                                    @else
                                    Không có
                                    @endif
                                </span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Màu sắc:</span>
                                <span class="col">
                                    @if(count(collect($detail)->unique('color'))>1)
                                    @foreach (collect($detail)->unique('color') as $item)
                                        {{  $item->color }},
                                    @endforeach
                                    @elseif(count(collect($detail)->unique('color')) == 1 && $detail[0]->color !='null')
                                    @foreach (collect($detail)->unique('color') as $item)
                                        {{  $item->color }}
                                    @endforeach
                                    @else
                                    Không có
                                    @endif
                                </span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Trạng thái:</span>
                                @if ($product->status == 'active')
                                    <span class="col text-success">Đang bán</span>
                                @else
                                    <span class="col text-danger">Ngừng bán</span>
                                @endif
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Ngày tạo: </span>
                                <span class="col">{{ Carbon::parse($product->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')  }}</span>
                            </div>
                            <div class="row">
                                <span class="col-3">Hình ảnh: </span>
                                <div class="col" id="existing-images">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('upload/product/' . $image->url) }}" alt="{{ $image->alt }}" class="img-fluid" style="width:100px; margin-right: 5px;">
                                    @endforeach

                                </div>
                            </div>
                            <div class="row">
                                <span>Biến thể sản phẩm:</span>
                                <table class="col-10 mt-2 ml-3">
                                    <thead>
                                        <th width='10%'>Kích thước</th>
                                        <th width='10%'>Màu sắc</th>
                                        <th width='15%'>Giá</th>
                                        <th width='8%'>Số lượng</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail as $key => $item )
                                            <tr>
                                                <td>{{ $item->size == 'null' ? 'Không có' : $item->size }}</td>
                                                <td>{{ $item->color == 'null' ? 'Không có' : $item->color }}</td>
                                                <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                                <td>{{ $item->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="row">
                                <div class="col">Mô tả: {!! $product->description !!}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-header mb-4">
                        <h4 class="card-title mb-3">Thông tin đánh giá</h4>
                        <div class="col-2">
                            <form action="">
                                <div class="form-group">
                                    <div class="row">
                                        <select class="form-control col mr-3" name="rating" id="rating">
                                            <option value="">Lọc đánh giá</option>
                                            @for ($i=1; $i<=5; $i++)
                                            <option {{ $i == $rating ? 'selected' : '' }} value="{{ $i }}">{{ $i }} sao</option>
                                            @endfor
                                        </select>
                                        <button type="submit" class="btn btn-info col-3">Lọc</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-10 ml-4">
                        @if (count($review) > 0)
                        @foreach ($review as $item)
                        <div class="row">
                            <div class="col-1 pt-1 pl-5">
                                <img
                                    style="height: 45px;object-fit: cover; border-radius: 50%;"
                                    src="{{ $item->user->images ? asset('upload/user/'.$item->user->images()->first()->url) : asset('upload/user/avt-default.jpg') }}"
                                    alt="">
                            </div>
                            <div id="review" class="pr-2 col">
                                <span>{{ $item->user->name }}</span>
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
                                    <small class="text-secondary">{{ Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y') }} |</small>
                                    <small class="text-secondary">Loại sản phẩm: </small>
                                    <small class="text-secondary">{{ $item->orderProduct->detail->color != "null" ? 'màu '.$item->orderProduct->detail->color.' , ' : ''}}</small>
                                    <small class="text-secondary">{{ $item->orderProduct->detail->size != "null" ? 'size '.$item->orderProduct->detail->size : ''}}</small>
                                    <pre class="mb-1">{{ $item->comment }}</pre>
                                    <img
                                        {{ $item->image ? '' : 'hidden' }}
                                        width="20%"
                                        src="{{ $item->image ? asset('upload/review/'.$item->image) : '' }}"
                                        alt="">
                                </div>
                                @if ($item->feedback != null)
                                <div class="feedback" style="background-color: rgb(245, 241, 241); padding:10px">
                                    <strong>Phản hồi</strong>
                                    <pre class="mb-1 pl-2">{{ $item->feedback }}</pre>
                                </div>
                                @else
                                <a href="{{ route('reviews.show',['id'=>$item->id]) }}" class="btn mt-2">Phản hồi</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        {{ $review->appends(['rating'=>$rating])->links() }}
                        @else
                        <p class="text-primary">Chưa có đánh giá</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
