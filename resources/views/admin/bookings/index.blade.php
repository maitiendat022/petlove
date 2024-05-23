@extends('admin.layouts.app')

@section('title','Lịch đặt')

@section('content')

@php
use Carbon\Carbon;
@endphp
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Danh sách lịch đặt</h3>
                    </div>
                    <div class="col-12 mt-3 ml-3">
                        <form action="" method="">


                            <div class="row">
                                <div class="col-1">
                                    <button class="btn btn-info">Tìm kiếm</button>
                                </div>
                                <div class="col-3">
                                    <input type="search" name="name" class="form-control" placeholder="Nhập số điện thoại"
                                        value="{{ $name }}">
                                </div>
                                <div class="col-2">
                                    <select class="form-control" name="status">
                                        <option value="0">Chọn trạng thái</option>
                                        @foreach ($bookStatus as $item)
                                        <option value="{{ $item['id'] }}" {{ $status==$item['id'] ? 'selected' : '' }}>{{
                                            $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="col-12 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%">#</th>
                                <th width="10%">Tên khách hàng</th>
                                <th width="10%">Số điện thoại</th>
                                <th width="10%">Dịch vụ</th>
                                <th width="7%">Thời gian</th>
                                <th width="10%">Ngày</th>
                                <th width="10%">Thời gian cập nhật</th>
                                <th width="10%">Trạng thái</th>
                                <th width="1%" colspan="2"></th>
                            </thead>

                            <tbody>
                                @foreach ($bookings as $item)
                                <tr>
                                    <td><a href="{{ route('bookings.show',$item->id) }}">{{ $item->id }}</a></td>
                                    <td>{{ $item->book_name }}</td>
                                    <td>{{ $item->book_phone }}</td>
                                    <td>{{ $item->servieceName }}</td>
                                    <td>{{ Carbon::parse($item->time)->format('H:i') }}</td>
                                    <td>{{ Carbon::parse($item->date)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y') }}</td>
                                    <td>{{ Carbon::parse($item->updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y') }}</td>
                                    <td>@switch($item->status)
                                        @case('unconfirmed')
                                            <span class="text-warning">Chờ xác nhận</span>
                                            @break
                                        @case('confirmed')
                                            <span class="text-success">Đã xác nhận</span>
                                            @break
                                        @case('cancel')
                                            <span class="text-danger">Đã hủy</span>
                                            @break
                                    @endswitch</td>
                                    @if($item->status == 'unconfirmed')
                                    <td>
                                        <a onclick="event.preventDefault(); if (confirm('Xác nhận lịch đặt ?')) { document.getElementById('update-form-{{ $item->id }}').submit(); }" class="btn btn-info">Xác nhận</a>
                                        <form id="update-form-{{ $item->id }}" action="{{ route('bookings.update', ['id'=>$item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <a onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hủy lịch đặt ?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="btn btn-danger">Hủy</a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('bookings.cancel', ['id'=>$item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $bookings->appends(['name' => $name, 'status' => $status])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
