@extends('admin.layouts.app')

@section('title','Người dùng')

@section('content')

@php
use Carbon\Carbon;
@endphp
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover" style="font-size: 18px">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Thông tin người dùng: #{{ $user->id }}</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 ml-5">
                            <div class="row mb-2">
                                <span class="col-3">Email:</span>
                                <strong class="col text-primary">{{ $user->email }}</strong>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Tên người dùng:</span>
                                <strong class="col">{{ $user->name }}</strong>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Quyền:</span>
                                <span class="col">{{ $user->role->name }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Số điện thoại:</span>
                                <span class="col">{{ $user->phone ?? 'Chưa có' }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Địa chỉ:</span>
                                <span class="col">{{ $user->address ?? 'Chưa có' }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Giới tính:</span>
                                <span class="col">{{ $user->gender ?? 'Chưa có' }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Ngày sinh:</span>
                                <span class="col">{{ $user->address ? Carbon::parse($user->birthday)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y') : 'Chưa có' }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Trạng thái:</span>
                                @if ($user->status == 'active')
                                    <span class="col text-success">Hoạt động</span>
                                @else
                                    <span class="col text-danger">Đã khóa</span>
                                @endif
                            </div>
                            <div class="row mb-2">
                                <span class="col-3">Ngày tạo: </span>
                                <span class="col">{{ Carbon::parse($user->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')  }}</span>
                            </div>
                            <a href="{{ route('users.edit',$user->id) }}" class="btn mb-4">Cập nhật</a>

                        </div>
                        <div class="col-5 ml-5">
                            <div class="col">
                                <span class="row">Hình ảnh: </span>
                                <div class="row">
                                    <img style="width:40%" src="{{ $user->images ? asset('upload/user/'.$user->images()->first()->url) : asset('upload/user/avt-default.jpg') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ml-5">
                            @if (count($order) > 0)
                            <div class="row mb-4">
                                <span>Danh sách đơn hàng đã đặt:</span>
                                <table class="col-11 mt-2 ml-3">
                                    <thead>
                                        <th width='6%'>Đơn hàng</th>
                                        <th width='10%'>Tên người nhận</th>
                                        <th width='10%'>Số điện thoại</th>
                                        <th width='25%'>Địa chỉ</th>
                                        <th width='10%'>Ngày đặt</th>
                                        <th width='5%'>Tổng tiền</th>
                                        <th width='10%'>Trạng thái</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $key => $item )
                                            <tr>
                                                <td><a href="{{ route('orders.show',$item->id) }}" class="text-primary">#{{ $item->id }}</a></td>
                                                <td>{{ $item->reciver_name }}</td>
                                                <td>{{ $item->reciver_phone }}</td>
                                                <td>{{ $item->reciver_address }}</td>
                                                <td>{{ Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y') }}</td>
                                                <td>{{ number_format($item->total, 0, ',', '.') }}đ</td>
                                                <td>@include('admin.orders.status',['status'=>$item->status])</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-11 mt-5">{{ $order->links() }}</div>
                            </div>
                            @elseif($user->role_id == 2)
                            <div class="row mb-4">
                                <span>Danh sách đơn hàng đã đặt:</span>
                                <span class="text-primary">Chưa có đơn hàng</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
