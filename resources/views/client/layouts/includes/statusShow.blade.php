@switch($status)
    @case('unconfirmed')
        <span class="badge badge-warning row"><i class="fa fa-clock-o"></i> Đang chờ người bán xác nhận</span>
        @break
    @case('confirmed')
        <span class="badge badge-success row"><i class="fa fa-check-circle"></i> Người bán đã xác nhận đơn hàng</span>
        <div class="row">
            <small class="text-secondary ml-auto">{{ $time }}</small>
        </div>
        @break
    @case('processing')
        <span class="badge badge-info row"><i class="fa fa-archive"></i> Người bán đang chuẩn bị hàng</span>
        <div class="row">
            <small class="text-secondary ml-auto">{{ $time }}</small>
        </div>
        @break
    @case('delivering')
        <span class="badge badge-info row"><i class="fa fa-truck"></i> Đơn hàng đang được vận chuyển</span>
        <div class="row">
            <small class="text-secondary ml-auto">{{ $time }}</small>
        </div>
        @break
    @case('completed')
        <span class="badge badge-success row"><i class="fa fa-check-circle"></i> Đơn hàng đã được giao hàng thành công</span>
        <div class="row">
            <small class="text-secondary ml-auto">{{ $time }}</small>
        </div>
        @break
    @case('cancel')
        <span class="badge badge-danger row"><i class="fa fa-times-circle"></i> Đơn hàng đã bị hủy</span>
        <div class="row">
            <small class="text-secondary ml-auto">{{ $time }}</small>
        </div>
        @break
@endswitch
