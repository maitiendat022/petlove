@extends('client.layouts.app')

@section('content')

@php
use Carbon\Carbon;
@endphp
<div id="content">
    <div class="container">
        <div class="row">

            @include('client.layouts.content.header_ct')

            @include('client.layouts.content.sidebar_shop')

            <div class="col-lg-9 order-1 order-lg-2">
                <div id="productMain" class="row">
                    <div class="col-md-6">
                        <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                            @foreach ($product->images as $image)
                            <div class="item">
                                <img src="{{ asset('upload/product/' . $image->url) }}" alt="" class="img-fluid">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="product_detail" class="col-md-6">
                        <form class="box" method="POST" action="{{ route('cart.store')}}">
                            @csrf
                            <input type="hidden" name="detail_id" class="detail_id" value="{{ $detail[0]['id'] }}">
                            <input type="hidden" name="product_id" class="product_id" value="{{ $product->id }}">
                            <h3 class="row">{{ $product->name }}</h3>
                            @if($product->status == 'inactive')
                            <h3 class="row ml-1 mb-3 text-danger">Ngừng bán</h3>
                            @else
                            <strong
                                id="price"
                                name ="price"
                                class="row ml-1 mb-3 text-danger"
                                >{{ number_format($detail[0]['price'], 0, ',', '.') }}
                                ₫
                            </strong>
                            @endif
                            @if(count(collect($detail)->unique('size'))>1)
                            <div class="row mb-3" style="display:block">
                                <span class="col">Kích thước: </span>
                                <div id="detail" class="col" >
                                    @foreach (collect($detail)->unique('size') as $item)
                                    <div class="col">
                                        <input
                                        hidden
                                        type="radio"
                                        class="size"
                                        id = "{{ $item->size }}"
                                        data-size="{{ $item->size }}"
                                        value="{{ $item->size }}"
                                        name = "size"
                                        {{ $detail[0]->size == $item->size ? 'checked' : '' }}
                                        >
                                        <label for="{{ $item->size }}">{{  $item->size }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @elseif(count(collect($detail)->unique('size')) == 1 && $detail[0]->size !='null')
                            <div class="row mb-3" style="display:block">
                                <span class="col">Kích thước: </span>
                                <div id="detail" class="col" >
                                    @foreach (collect($detail)->unique('size') as $item)
                                    <div class="col">
                                        <input
                                        hidden
                                        type="radio"
                                        class="size"
                                        id = "{{ $item->size }}"
                                        data-size="{{ $item->size }}"
                                        value="{{ $item->size }}"
                                        name = "size"
                                        {{ $detail[0]->size == $item->size ? 'checked' : '' }}
                                        >
                                        <label for="{{ $item->size }}">{{  $item->size }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if(count(collect($detail)->unique('color')) > 1)
                            <div class="row mb-3" style="display:block">
                                <span class="col">Màu sắc: </span>
                                <div id="detail" class="col">
                                    @foreach (collect($detail)->unique('color') as $item)
                                    <div class="col">
                                        <input
                                        hidden
                                        type="radio"
                                        class="color"
                                        id = "{{ $item->color }}"
                                        data-color="{{ $item->color }}"
                                        value="{{ $item->color }}"
                                        name="color"
                                        {{ $detail[0]->color == $item->color ? 'checked' : '' }}
                                        >
                                        <label for="{{ $item->color }}">{{ $item->color }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @elseif (count(collect($detail)->unique('color')) == 1 && $detail[0]->color !='null')
                            <div class="row mb-3" style="display:block">
                                <span class="col">Màu sắc: </span>
                                <div id="detail" class="col">
                                    @foreach (collect($detail)->unique('color') as $item)
                                    <div class="col">
                                        <input
                                        hidden
                                        type="radio"
                                        class="color"
                                        id = "{{ $item->color }}"
                                        data-color="{{ $item->color }}"
                                        value="{{ $item->color }}"
                                        name="color"
                                        {{ $detail[0]->color == $item->color ? 'checked' : '' }}
                                        >
                                        <label for="{{ $item->color }}">{{ $item->color }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="quantity row mb-1" style="display:block">
                                <span class="col">Số lượng: </span>
                                <div class="col pl-4 mt-1">
                                    <input
                                        name="quantity"
                                        class="form-control col-3"
                                        type="number"
                                        pattern="\d*"
                                        oninput="this.value = this.value.replace(/\D/, '')"
                                        onblur="if(this.value === '') { this.value = '1'}"
                                        min="1"
                                        value="1"
                                    >
                                </div>
                            </div>
                            <div class="soldout row" style="display:none">
                                <span class="col text-danger">Hết hàng</span>
                            </div>
                            <button
                                type="submit"
                                class="add_cart btn btn-primary row mt-3"
                                @if($product->status == 'inactive')
                                disabled
                                @endif
                                >
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ
                            </button>
                        </form>

                        <div data-slider-id="1" class="owl-thumbs">
                            @foreach ($product->images as $image)
                            <button class="owl-thumb-item">
                                <img src="{{ asset('upload/product/' . $image->url) }}" alt="" class="img-fluid">
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="details" class="box">
                    <h3>Mô tả: </h3>
                    <hr>
                    <span id="description">{!! $product->description !!}</span>
                </div>
                <div id="details" class="box">
                    <div class="row">
                        <div class="col-3">
                            <h3>Đánh giá</h3>
                        </div>
                        <div class="col-3 ml-auto mr-3">
                            <form action="">
                                <div class="form-group">
                                    <div class="row">
                                        <select class="form-control col mr-3" name="rating" id="rating">
                                            <option value="">Tất cả</option>
                                            @for ($i=1; $i<=5; $i++)
                                            <option {{ $i == $rating ? 'selected' : '' }} value="{{ $i }}">{{ $i }} sao</option>
                                            @endfor
                                        </select>
                                        <button type="submit" class="btn btn-info">Lọc</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    @if (count($review) > 0)
                    @foreach ($review as $item)
                    <div class="row">
                        <div class="col-1 pt-1">
                            <img
                                style="height: 35px;object-fit: cover; border-radius: 50%;"
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
                            <div class="feedback">
                                <strong>Phản hồi của người bán</strong>
                                <pre class="mb-1">{{ $item->feedback }}</pre>
                            </div>
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

<script>
     window.detail = {!! json_encode($detail) !!};
</script>
<script src="{{ asset('client/js/detail.js') }}"></script>
@endsection
