@extends('client.layouts.app')

@section('title','Petlove - Sản phẩm')

@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            @include('client.layouts.content.header_ct')

            @include('client.layouts.content.sidebar_shop')

            <div class="col-lg-9">
                <div class="box">
                    <h2>

                    </h2>
                </div>
                <div class="row products">
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="{{ route('product.detail',$product->id) }}">
                                            <img
                                                src="{{ $product->image_path }}"
                                                alt=""
                                                class="img-fluid"
                                            >
                                        </a>
                                    </div>
                                </div>
                            </div>
                                <a href="{{ route('product.detail',$product->id) }}" class="invisible">
                                    <img
                                        src="{{ $product->image_path }}"
                                        alt=""
                                        class="img-fluid"
                                    >
                                </a>
                            <div class="text">
                                <h3><a href="{{ route('product.detail',$product->id) }}">{{ $product->name }}</a></h3>
                                <p class="price">
                                    @if($product->status == 'inactive')
                                    <strong class="text-danger">Ngừng bán</strong>
                                    @elseif($product->detail->count() == 1 && $product->quantity_detail == 0 )
                                    <strong class="text-danger">Hết hàng</strong>
                                    @else
                                    <strong class="text-danger">{{ number_format($product->detail->first()->price, 0, ',', '.') }} ₫</strong>
                                    @endif
                                </p>
                                <div class="buttons" style="display: flex">
                                    <a
                                        href="{{ route('product.detail',$product->id) }}"
                                        class="btn btn-outline-secondary ml-1">
                                       Chi tiết
                                    </a>
                                    <form
                                        method="post"
                                        action="{{ route('cart.store', ['product_id'=>$product->id,'quantity'=>1]) }}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="btn btn-primary ml-3"
                                            @if($product->detail->count() == 1 && $product->quantity_detail == 0 || $product->status == 'inactive')
                                                disabled
                                            @endif
                                            >
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $products->appends([
                                    'name' => $name,
                                    'pet_id' => $pet_id,
                                    'parent_id' => $parent_id,
                                    'category_id' => $category_id,
                                ])->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var breadcrumbItems = $(".breadcrumb-item");
        if (breadcrumbItems.length === 2 && breadcrumbItems.last().text() != "Sản phẩm") {
            $(".box h2").text("Shop cho " + breadcrumbItems.last().text().toLowerCase());
        }else {
            $(".box h2").text(breadcrumbItems.last().text());
        }
    });
</script>
@endsection
