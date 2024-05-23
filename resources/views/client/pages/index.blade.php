@extends('client.layouts.app')

@section('title','Petlove - Home')

@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="main-slider" class="owl-carousel owl-theme">
                    <div class="item"><img src="{{ asset('logo/z5088102709682_29ce4abc6b36a577288d128a88d497f6.jpg') }}"
                            alt="" class="img-fluid"></div>
                    <div class="item"><img src="{{ asset('logo/z5088102709333_70bf3d99ee1c91bf73109f1034b56052.jpg') }}"
                            alt="" class="img-fluid"></div>
                    <div class="item"><img src="{{ asset('logo/z5088102708688_561f5d7023df36c7eb9b26547528b903.jpg') }}"
                            alt="" class="img-fluid"></div>
                    <div class="item"><img src="{{ asset('logo/z5088102709232_0e9620822b9c7914afbae97ffc3350e9.jpg') }}"
                            alt="" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="advantages">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                        <div class="icon"><i class="fa fa-heart"></i></div>
                        <h3><a href="">Luôn yêu quý khách hàng của mình</a></h3>
                        <p class="mb-0">Chúng tôi được biết là cung cấp dịch vụ tốt nhất có thể từ trước đến nay</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                        <div class="icon"><i class="fa fa-tags"></i></div>
                        <h3><a href="">Giá tốt nhất</a></h3>
                        <p class="mb-0">Chúng tôi luôn cung cấp các dịch vụ tốt nhất với giá ưu đãi nhất trên thị trường
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                        <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                        <h3><a href="">Đảm bảo luôn luôn hài lòng</a></h3>
                        <p class="mb-0">Luôn quan tâm, chăm sóc khách hàng của mình</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hot">
        <div class="box py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-0">Có thể bạn sẽ thích</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="product-slider owl-carousel owl-theme">
                @foreach ($product as $item)
                <div class="item">
                    <div class="product">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front"><a href="{{ route('product.detail',$item->id) }}"><img
                                            src="{{ $item->image_path }}" alt="" class="img-fluid"></a></div>
                                <div class="back"><a href="{{ route('product.detail',$item->id) }}"><img
                                            src="{{ $item->image_path }}" alt="" class="img-fluid"></a></div>
                            </div>
                        </div><a href="{{ route('product.detail',$item->id) }}" class="invisible"><img
                                src="{{ $item->image_path }}" alt="" class="img-fluid"></a>
                        <div class="text">
                            <h3><a href="{{ route('product.detail',$item->id) }}">{{ $item->name }}</a></h3>
                            <p class="price">
                                <strong class="text-danger">{{ number_format($item->detail->first()->price, 0, ',', '.')
                                    }} ₫</strong>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="box slideshow">
                <h3>Nhà cung cấp</h3>
                <p class="lead">Các sản phẩm được nhập từ các hãng sản xuất hàng đầu</p>
                <div id="get-inspired" class="owl-carousel owl-theme">
                    <div class="item"><a href="#"><img
                                src="{{ asset('logo/z5090929503591_2b49728082f25cb0f900e54281ce290f.jpg') }}" alt=""
                                class="img-fluid"></a></div>
                    <div class="item"><a href="#"><img
                                src="{{ asset('logo/z5090929512575_1ca506d5f99f9025be4bcec2de477d7c.jpg') }}" alt=""
                                class="img-fluid"></a></div>
                    <div class="item"><a href="#"><img
                                src="{{ asset('logo/z5090929511924_7067e6aa7cc891b2e170f898b92420be.jpg') }}" alt=""
                                class="img-fluid"></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="box text-center">
        <div class="container">
            <div class="col-md-12">
                <h3 class="text-uppercase">Trang của tôi</h3>
                <p class="lead mb-0">Bạn muốn tìm kiếm điều gì về chúng tôi ? <a href="blog.html">Tới trang!</a></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div id="blog-homepage" class="row">
                <div class="col-sm-6">
                    <div class="post">
                        <h4><a href="https://osinthucung.com/meo-maine-coon/">Mèo Maine Coon – Đặc điểm, cách chăm sóc
                            </a></h4>
                        <p class="author-category">Tháng Năm 13, 2021 Bởi <a
                                href="https://osinthucung.com/author/dungvu/">Dung Vũ </a></p>
                        <hr>
                        <p class="intro">Mèo Maine Coon hay còn được gọi là mèo lông dài Mỹ, là một trong những giống
                            mèo ngoại nhập có ngoại hình đặc biệt, trở thành lựa chọn của rất nhiều người yêu động vật.
                            Khác hoàn toàn với ngoại hình có phần hung tợn, chúng lại có tính cách rất dễ thương, hiền
                            lành, hãy cùng Osin thú cưng tìm hiểu nhiều hơn nhé...</p>
                        <p class="read-more"><a href="https://osinthucung.com/meo-maine-coon/"
                                class="btn btn-primary">Xem thêm</a></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="post">
                        <h4><a href="https://blogcorgi.com/blog/nuoi-cho-corgi-theo-phong-trao/">Trào Lưu Nuôi Chó Corgi
                                – Thật Lòng Yêu Thương Hay Thú Vui Nhất Thời</a></h4>
                        <p class="author-category">Bởi <a href="https://blogcorgi.com/">BlogCorgi.com</a></p>
                        <hr>
                        <p class="intro">Trong thời buổi xã hội bình đẳng thì không chỉ giữa nam hay nữ mà cả động vật
                            cũng cần có sự yêu thương, trân trọng và đối xử công bằng. Rất nhiều người lựa chọn thú cưng
                            chỉ qua vẻ bề ngoài, qua giống loài hay đơn thuần là đang theo đuổi một trào lưu. Dù gia
                            nhập thị trường Việt Nam khá muộn...</p>
                        <p class="read-more"><a href="https://blogcorgi.com/blog/nuoi-cho-corgi-theo-phong-trao/"
                                class="btn btn-primary">Xem thêm</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        console.log('hello');
    })
</script>
@endsection
