@extends('admin.layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card "id="statis">
                <div class="row">
                    <div class="col statis user">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Khách hàng</strong>
                                <strong>{{ $home['user'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-circle-09 ml-auto"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col statis pet">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Thú cưng</strong>
                                <strong>{{ $home['pet'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-favourite-28 ml-auto"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col statis category">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Danh mục</strong>
                                <strong>{{ $home['category'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-paper-2 ml-auto"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col statis product">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Sản phẩm</strong>
                                <strong>> {{ $home['product'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-palette ml-auto"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col statis serviece">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Dịch vụ</strong>
                                <strong>{{ $home['serviece'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-atom ml-auto"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col statis order">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Đơn hàng</strong>
                                <strong>> {{ $home['order'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-delivery-fast ml-auto"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col statis booking">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Lịch đặt</strong>
                                <strong>> {{ $home['booking'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-notes ml-auto"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col statis review">
                        <div class="row">
                            <div class="col">
                                <strong class="mb-2">Đánh giá</strong>
                                <strong>> {{ $home['review'] }}</strong>
                            </div>
                            <div class="col">
                                <i class="nc-icon nc-chat-round ml-auto"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.includes.cssHome')
@endsection
