@extends('admin.layouts.app')

@section('title','Khách hàng')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Danh sách khách hàng</h3>
                    </div>
                    <div class="col-12 mt-3 ml-3">
                        <form action="" method="">
                            <div class="row">
                                <div class="col-1">
                                    <button class="btn btn-info">Tìm kiếm</button>
                                </div>
                                <div class="col-3">
                                    <input type="search" name="name" class="form-control" placeholder="Từ khóa tìm kiếm"
                                        value="{{ $name }}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="col-3 mt-3">
                        <a href="{{ route('customers.create') }}" class="btn btn-primary">Thêm khách hàng</a>
                    </div>
                    <div class="col-12 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th width="1%">#</th>
                                <th width="15%">Tên</th>
                                <th width="15%">Email</th>
                                <th width="10%">Số điện thoại</th>
                                <th width="10%">Đơn hàng</th>
                                <th width="10%">Trạng thái</th>
                                <th width="1%"></th>
                            </thead>

                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td><a href="{{ route('customers.show',$item->id) }}" class="text-primary">{{ $item->id }}</a></td>
                                    <td><a href="{{ route('customers.show',$item->id) }}" class="text-primary">{{ $item->name }}</a></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ count($item->order) }}</td>
                                    <td
                                        class="{{ ($item->status)=='active'?'text-success':'text-danger' }}"
                                        >
                                        {{ ($item->status)=='active'?'Hoạt động':'Đã khóa' }}
                                    </td>
                                    @if($item->status == "active")
                                        <td style="text-align: center;">
                                            <a onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa ?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="btn btn-danger">Xóa</a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('customers.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <a onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn kích hoạt lại ?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="btn btn-info">Kích hoạt</a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('customers.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->appends(['name' => $name])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
