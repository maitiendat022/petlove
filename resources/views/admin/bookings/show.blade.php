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
                <div class="card strpied-tabled-with-hover" style="font-size: 18px">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Chi tiết lịch đặt: #{{ $booking->id }}</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-5 ml-4">
                            <div class="row mb-2">
                                <span class="col-4">Trạng thái:</span>
                                <span class="col">@include('admin.orders.status',['status'=>$booking->status])</span>
                            </div>
                            <div class="row">
                                <span class="col-4">Thời gian cập nhật:</span>
                                <span class="col">{{ Carbon::parse($booking->updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-5">
                        <div class="col-6 ml-4 mb-5">
                            <h4>Thông tin lịch đặt</h4>
                            <div class="col-12">
                                <div class="row mb-2">
                                    <span class="col-3">Tên khách hàng:</span>
                                    <strong class="col">{{ $booking->book_name }}</strong>
                                </div>
                                <div class="row mb-2">
                                    <span class="col-3">Số điện thoại:</span>
                                    <strong class="col">{{ $booking->book_phone }}</strong>
                                </div>
                                <div class="row mb-2">
                                    <span class="col-3">Dịch vụ:</span>
                                    <span class="col">{{ $booking->servieceName }}</span>
                                </div>
                                <div class="row mb-2">
                                    <span class="col-3">Thời gian:</span>
                                    <span class="col">{{ Carbon::parse($booking->time)->format('H:i') }}</span>
                                </div>
                                <div class="row mb-2">
                                    <span class="col-3">Ngày:</span>
                                    <span class="col">{{ Carbon::parse($booking->date)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y') }}</span>
                                </div>
                                <div class="row">
                                    <span class="col-3">Ghi chú:</span>
                                    <span class="col">{{ $booking->note }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 ml-4 mb-5">
                            <h4>Thông tin thú cưng</h4>
                            <div class="col-12">
                                <div class="row mb-2">
                                    <span class="col-3">Tên thú cưng:</span>
                                    <span class="col">{{ $booking->pet_name }}</span>
                                </div>
                                <div class="row mb-2">
                                    <span class="col-3">Tuổi:</span>
                                    <span class="col">{{ $booking->pet_age }} tháng</span>
                                </div>
                                <div class="row mb-2">
                                    <span class="col-3">Giống:</span>
                                    <span class="col">{{ $booking->pet_specie }}</span>
                                </div>
                                <div class="row mb-2">
                                    <span class="col-3">Cân nặng:</span>
                                    <span class="col">{{ $booking->pet_weight }} kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
