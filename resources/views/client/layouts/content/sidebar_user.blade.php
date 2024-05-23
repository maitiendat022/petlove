<div class="col-lg-3">

    <div class="card sidebar-menu mb-5">
        <div class="card-header">
            <h3 class="h4 card-title">Quản lý tài khoản</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills flex-column">
                <a href="{{ route('user.order.index') }}" class="nav-link {{ request()->routeIs('user.order.*') ? 'active' : '' }}"><i class="fa fa-truck"></i> Đơn hàng</a>
                <a href="{{ route('user.booking.index') }}" class="nav-link {{ request()->routeIs('user.booking.*') ? 'active' : '' }}"><i class="fa fa-clock-o"></i> Lịch đặt</a>
                <a href="{{ route('user.review.index') }}" class="nav-link {{ request()->routeIs('user.review.*') ? 'active' : '' }}"><i class="fa fa-star"></i> Đánh giá</a>
                <a href="{{ route('user.account.index') }}" class="nav-link {{ request()->routeIs('user.account.*') ? 'active' : '' }}"><i class="fa fa-user"></i> Tài khoản</a>
            </ul>
        </div>
    </div>
</div>
