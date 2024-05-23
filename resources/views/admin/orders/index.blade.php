@extends('admin.layouts.app')

@section('title','Đơn hàng')

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
                        <h3 class="card-title">Danh sách đơn hàng</h3>
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
                                        @foreach ($orderStatus as $item)
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
                                <th width="20%">Địa chỉ</th>
                                <th width="10%">Thời gian đặt</th>
                                <th width="10%">Thời gian cập nhật</th>
                                <th width="10%">Trạng thái</th>
                                <th width="1%" colspan="2"></th>
                            </thead>

                            <tbody>
                                @foreach ($orders as $item)
                                <tr>
                                    <td><a href="{{ route('orders.show',$item->id) }}">{{ $item->id }}</a></td>
                                    <td>{{ $item->reciver_name }}</td>
                                    <td>{{ $item->reciver_phone }}</td>
                                    <td>{{ $item->reciver_address }}</td>
                                    <td>{{ Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')  }}</td>
                                    <td>{{ Carbon::parse($item->updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y') }}</td>
                                    <td>@include('admin.orders.status',['status'=>$item->status])</td>
                                    @include('admin.orders.updateOrder',['status'=>$item->status])
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->appends(['name' => $name, 'status' => $status])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
