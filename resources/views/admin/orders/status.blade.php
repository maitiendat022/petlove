@switch($status)
    @case('unconfirmed')
        <span class="text-warning">Chờ xác nhận</span>
        @break
    @case('confirmed')
        <span class="text-success">Đã xác nhận</span>
        @break
    @case('processing')
        <span class="text-warning">Đang xử lý</span>
        @break
    @case('delivering')
        <span class="text-info">Đang giao hàng</span>
        @break
    @case('completed')
        <span class="text-success">Đã giao hàng</span>
        @break
    @case('cancel')
        <span class="text-danger">Đã hủy</span>
        @break
@endswitch
