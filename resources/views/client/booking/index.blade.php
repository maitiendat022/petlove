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
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Lịch đặt của tôi</li>
                </ol>
            </nav>
        </div>

        @include('client.layouts.content.sidebar_user')

        <div id="customer-orders" class="col-lg-9">
          <div class="box">
            <h1>Lịch đặt của tôi</h1>
            <p class="lead">Danh sách lịch dịch vụ bạn đã đặt</p>
            @if($bookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Lịch đặt</th>
                          <th>Thời gian</th>
                          <th>Ngày</th>
                          <th>Dịch vụ</th>
                          <th>Trạng thái</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($bookings as $item)
                          <tr>
                              <th>LD{{ $item->id }}PL</th>
                              <td>{{ Carbon::parse($item->time)->format('H:i') }}</td>
                              <td>{{ Carbon::parse($item->date)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y') }}</td>
                              <td>{{ $item->servieceName }}</td>
                              <td>@include('client.layouts.includes.status',['status'=>$item->status])</td>
                              <td><a href="{{ route('user.booking.show',['id' => $item->id]) }}" class="btn btn-primary btn-sm">Xem</a></td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  {{ $bookings->links() }}
            @else
            <h3 class="text-danger">Chưa có lịch đặt dịch vụ nào !</h3>
            <div>Đặt ngay <a href="{{ route('booking.create') }}">Tại đây</a></div>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
