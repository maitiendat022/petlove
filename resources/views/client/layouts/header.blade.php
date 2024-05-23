<header class="header mb-5">

    <div id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offer mb-3 mb-lg-0">
                    <a href="#" class="btn btn-success btn-sm">Ưu đãi tết này</a>
                    <a href="#" class="ml-1">Giảm giá dịch vụ 10%</a></div>
                <div class="col-lg-6 text-center text-lg-right">
                    <ul class="menu list-inline mb-0">
                        @if(auth()->check())
                            <li class="list-inline-item">
                                <a href="{{ route('user.order.index') }}">
                                    <img
                                        class="mr-1"
                                        style="height: 20px;width: 20px;object-fit: cover; border-radius: 50%;"
                                        src="{{ auth()->user()->images ? asset('upload/user/'.auth()->user()->images()->first()->url) : asset('upload/user/avt-default.jpg') }}"
                                        alt="">
                                    {{ auth()->user()->name }}
                                </a>
                            </li>
                            <li class="list-inline-item"><a href="{{ route('auth.logout') }}">Đăng xuất</a></li>
                        @else
                            <li class="list-inline-item"><a href="{{ route('auth.loginIndex') }}" >Đăng nhập</a></li>
                            <li class="list-inline-item"><a href="{{ route('auth.registerIndex') }}">Đăng ký</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
    @include('client.layouts.navbar')
    <div id="search" class="collapse">
        <div class="container">
            <form action="{{ route('home.product') }}" method="GET" role="search" class="ml-auto">
                <div class="input-group">
                    <input name="name" type="text" placeholder="Nhập tên sản phẩm bạn muốn tìm..." class="form-control">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>
