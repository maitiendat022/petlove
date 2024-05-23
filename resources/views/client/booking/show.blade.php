@extends('client.layouts.app')

@section('content')

@php
use Carbon\Carbon;
@endphp
<div id="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li aria-current="page" class="breadcrumb-item"><a href="#">Lịch đặt của tôi</a></li>
              <li aria-current="page" class="breadcrumb-item active">Lịch đặt LD{{ $booking->id }}PL</li>
            </ol>
          </nav>
        </div>

        @include('client.layouts.content.sidebar_user')

        <div id="customer-order" class="col-lg-9">
          <div class="box">
            <h1>Lịch đặt LD{{ $booking->id }}PL</h1>
            <hr>
            <div class="col-11" style="font-size: 20px">
                <div class="row">
                    <div>
                        @if($booking->status == 'unconfirmed')
                        <a onclick="event.preventDefault(); if (confirm('Xác nhận cập nhật trạng thái ?')) { document.getElementById('update-form').submit(); }" class="btn btn-danger btn-sm" style="color: #fff">Hủy lịch đặt</a>
                        <form id="update-form" action="{{ route( 'user.booking.update',['id' => $booking->id]) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endif
                    </div>
                    <div class="ml-auto">
                        @include('client.booking.status',['status'=>$booking->status,
                        'time'=>Carbon::parse($booking->updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')])
                    </div>
                </div>
                <div class="row mt-2">
                    <h3>Thông tin lịch đặt</h3>
                    <div class="col-12">
                        <div class="row">
                            <span class="col-4">Tên khách hàng :</span>
                            <strong>{{ $booking->book_name }}</strong>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Số điện thoại :</span>
                            <strong>{{ $booking->book_phone }}</strong>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Dịch vụ :</span>
                            <span>{{ $booking->servieceName }}</span>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Thời gian :</span>
                            <span>{{ Carbon::parse($booking->time)->format('H:i') }}</span>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Ngày :</span>
                            <span>{{ Carbon::parse($booking->date)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y') }}</span>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Ghi chú :</span>
                            <span>{{ $booking->note }}</span>
                        </div>
                    </div>
                    <h3 class="mt-3">Thông tin Thú cưng</h3>
                    <div class="col-12">
                        <div class="row">
                            <span class="col-4">Tên thú cưng :</span>
                            <span>{{ $booking->pet_name }}</span>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Tuổi :</span>
                            <span>{{ $booking->pet_age }} tháng</span>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">Giống :</span>
                            <span>{{ $booking->pet_specie }}</span>
                        </div>
                        <div class="row mt-1">
                            <span class="col-4">cân nặng :</span>
                            <span>{{ $booking->pet_weight }} kg</span>
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
