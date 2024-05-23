<nav class="navbar navbar-expand-lg">
    <div class="container"><a href="{{ route('home.index') }}" class="navbar-brand home"><img src="{{ asset('logo/logo_chu.png') }}"
                alt="Obaju logo" class="d-none d-md-inline-block"><img src="{{ asset('logo/logo_chu.png') }}" alt=""
                class="d-inline-block d-md-none"></a>
        <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="{{ route('home.index') }}" class="nav-link active">Home</a></li>
                @foreach ($pet as $pet)
                <li class="nav-item dropdown menu-large">
                    <a href="{{ route('home.product', ['pet_id' => $pet->id]) }}" class="dropdown-toggle nav-link">
                        {{ $pet->name }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu megamenu">
                        <li>
                            <div class="row">
                                @foreach ($pet->categories->whereNull('parent_id')->where('status','active') as $parent)
                                <div class="col-md-6 col-lg-3">
                                    <a class="nav-link"
                                        href="{{ route('home.product', ['pet_id' => $pet->id,'parent_id' => $parent->id]) }}">
                                        <h5>{{ $parent->name }}</h5>
                                    </a>
                                    <ul class="list-unstyled mb-3">
                                        @foreach ($parent->children->where('status','active') as $category)
                                        <li class="nav-item">
                                            <a href="{{ route('home.product', ['pet_id' => $pet->id,'parent_id' => $parent->id, 'category_id' => $category->id]) }}"
                                                class="nav-link">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </li>
                @endforeach
                <li class="nav-item dropdown menu-large">
                    <a href="" class="dropdown-toggle nav-link">
                        Dịch vụ
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu megamenu">
                        <li>
                            <div class="">
                                <div class="col-md-6 col-lg-3">
                                    <a class="nav-link"
                                        href="">
                                        <h5>Danh sách dịch vụ</h5>
                                    </a>
                                    @foreach ($serviece as $item)
                                    <ul class="list-unstyled mb-3">
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                {{ $item->name }}
                                            </a>
                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
                <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                    <a href="{{ route('booking.create') }}" class="btn btn-danger navbar-btn">
                        <i class="fa fa-calendar"></i>
                    <span>Đặt lịch</span></a>
                </div>
                <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse"
                    href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span
                        class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
                <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="{{ route('cart.index') }}"
                        class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i>
                        <span>{{ $countProduct }} sản phẩm</span></a>
                </div>
            </div>
        </div>
    </div>
</nav>
