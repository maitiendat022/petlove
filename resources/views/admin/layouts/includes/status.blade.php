@if($status == "active")
    <td><a class="btn btn-warning" href="{{ route($name .'.edit', $item->id) }}">Sửa</a></td>
    <td>
        <a onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa ?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="btn btn-danger">Xóa</a>
        <form id="delete-form-{{ $item->id }}" action="{{ route($name . '.destroy', $item->id) }}" method="POST" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </td>
@else
    <td colspan="2" style="text-align: center;">
        <a onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn kích hoạt lại ?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="btn btn-info">Kích hoạt</a>
        <form id="delete-form-{{ $item->id }}" action="{{ route($name . '.destroy', $item->id) }}" method="POST" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </td>
@endif
