<div class="sidebar" data-image="">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text">
                <img src="{{ asset('logo/logo_chu.png') }}" alt="">
            </a>
        </div>
        <ul class="nav">
            <li class="{{ request()->routeIs('admin.index') ? 'nav-item active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Trang chủ</p>
                </a>
            </li>
            @if(auth()->user()->role_id == 1)
            <li class="{{ request()->routeIs('users.*') ? 'nav-item active' : '' }}">
                <a href="{{ route('users.index')}}" class="nav-link">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Người dùng</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 5)
            <li class="{{ request()->routeIs('customers.*') ? 'nav-item active' : '' }}">
                <a href="{{ route('customers.index') }}" class="nav-link">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Khách hàng</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
            <li class="{{ request()->routeIs('pets.*') ? 'nav-item active' : '' }}">
                <a class="nav-link" href="{{ route('pets.index') }}">
                    <i class="nc-icon nc-favourite-28"></i>
                    <p>Thú cưng</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
            <li class="{{ request()->routeIs('categories.*') ? 'nav-item active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Danh mục</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
            <li class = "{{ request()->routeIs('products.*') ? 'nav-item active' : '' }}" >
                <a class="nav-link" href="{{ route('products.index')}}">
                    <i class="nc-icon nc-palette"></i>
                    <p>Sản phẩm</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
            <li class = "{{ request()->routeIs('servieces.*') ? 'nav-item active' : '' }}">
                <a class="nav-link" href="{{ route('servieces.index')}}">
                    <i class="nc-icon nc-atom"></i>
                    <p>Dịch vụ</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
            <li class = "{{ request()->routeIs('orders.*') ? 'nav-item active' : '' }}">
                <a class="nav-link" href="{{ route('orders.index')}}">
                    <i class="nc-icon nc-delivery-fast"></i>
                    <p>Đơn hàng</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
            <li class = "{{ request()->routeIs('bookings.*') ? 'nav-item active' : '' }}">
                <a class="nav-link" href="{{ route('bookings.index')}}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Lịch đặt</p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 5)
            <li class = "{{ request()->routeIs('reviews.*') ? 'nav-item active' : '' }}">
                <a class="nav-link" href="{{ route('reviews.index')}}">
                    <i class="nc-icon nc-chat-round"></i>
                    <p>Đánh giá</p>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
