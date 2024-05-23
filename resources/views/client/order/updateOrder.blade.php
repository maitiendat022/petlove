@if($status == 'completed' || $status == 'cancel')

@else
<a onclick="event.preventDefault(); if (confirm('Xác nhận hủy đơn hàng ?')) { document.getElementById('update-form').submit(); }" class="btn btn-danger btn-sm" style="color: #fff">Hủy đơn hàng</a>
    <form id="update-form" action="{{ route( 'user.order.update',['id' => $order->id,'status'=>'cancel']) }}" method="POST" style="display: none;">
        @csrf
    </form>
@endif
