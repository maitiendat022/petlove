@if($status == 'completed' || $status == 'cancel')
    <td colspan="2"></td>
@else
<td>
    <a onclick="event.preventDefault(); if (confirm('Xác nhận cập nhật trạng thái ?')) { document.getElementById('update-form-{{ $item->id }}').submit(); }" class="btn btn-info">Cập nhật</a>
    <form id="update-form-{{ $item->id }}" action="{{ route( 'orders.update',['id' => $item->id,'status'=>$status]) }}" method="POST" style="display: none;">
        @csrf

    </form>
</td>
<td>
    <a onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hủy đơn hàng ?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="btn btn-danger">Hủy</a>
    <form id="delete-form-{{ $item->id }}" action="{{ route('orders.cancel', ['id' => $item->id]) }}" method="POST" style="display: none;">
        @csrf

    </form>
</td>
@endif
