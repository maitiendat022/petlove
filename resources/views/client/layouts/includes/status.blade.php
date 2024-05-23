@switch($status)
    @case('unconfirmed')
        <span class="badge badge-warning">Chờ xác nhận</span>
        @break
    @case('confirmed')
        <span class="badge badge-success">Đã xác nhận</span>
        @break
    @case('processing')
        <span class="badge badge-info">Đang chuẩn bị hàng</span>
        @break
    @case('delivering')
        <span class="badge badge-info">Đang giao hàng</span>
        @break
    @case('completed')
        <span class="badge badge-success">Đã giao hàng</span>
        @break
    @case('cancel')
        <span class="badge badge-danger">Đã hủy</span>
        @break
@endswitch
