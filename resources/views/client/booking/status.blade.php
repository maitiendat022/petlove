@switch($booking->status)
    @case('unconfirmed')
        <span class="badge badge-warning row"><i class="fa fa-clock-o"></i> Đang chờ xác nhận</span>
        @break
    @case('confirmed')
        <span class="badge badge-success row"><i class="fa fa-check-circle"></i> Đã xác nhận</span>
        <div class="row">
            <small class="text-secondary ml-auto">{{ $time }}</small>
        </div>
        @break
    @case('cancel')
        <span class="badge badge-danger row"><i class="fa fa-times-circle"></i> Đã hủy</span>
        <div class="row">
            <small class="text-secondary ml-auto">{{ $time }}</small>
        </div>
        @break
@endswitch
