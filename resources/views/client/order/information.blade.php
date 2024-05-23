@extends('client.layouts.app')

@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Thông tin người nhận</li>
                    </ol>
                </nav>
            </div>

            <div id="checkout" class="col-lg-12">
                <div class="box">
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf

                        <h1>Đặt hàng - Thông tin</h1>
                        <div class="nav flex-column flex-md-row nav-pills text-center mt-3">
                            <span class="nav-link  text-sm-center active">Nhập thông tin người nhận</span>
                        </div>
                        <div class="content py-3">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="name">Tên người nhận <span class="text-danger">*</span></label>
                                        <input
                                            value="{{ old('name') ?? auth()->user()->name }}"
                                            name="name" id="name"
                                            type="text"
                                            class="form-control"
                                            placeholder="Nhập họ tên"
                                        >
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại <span class="text-danger">*</label>
                                        <input
                                            pattern="\d*"
                                            oninput="this.value = this.value.replace(/\D/, '')"
                                            id="phone"
                                            type="text"
                                            class="form-control"
                                            name="phone"
                                            value="{{ old('phone') ?? auth()->user()->phone }}"
                                            placeholder="Nhập số điện thoại"
                                        >
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">Tỉnh/Thành phố <span class="text-danger">*</label>
                                        <input
                                            class="form-control"
                                            name="city"
                                            id="city"
                                            value="{{ old('city') }}"
                                            placeholder="Nhập tỉnh hoặc thành phố"
                                        >
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="district">Quận/Huyện <span class="text-danger">*</label>
                                            <input
                                            class="form-control"
                                            name="district"
                                            id="district"
                                            value="{{ old('district') }}"
                                            placeholder="Nhập quận hoặc huyện"
                                        >
                                        @error('district')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ward">Phường/Xã <span class="text-danger">*</label>
                                            <input
                                            class="form-control"
                                            name="ward"
                                            id="ward"
                                            value="{{ old('ward') }}"
                                            placeholder="Nhập phường hoặc xã"
                                        >
                                        @error('ward')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ cụ thể <span class="text-danger">*</label>
                                        <input
                                            value="{{ old('address') }}"
                                            id="address"
                                            name="address"
                                            type="text"
                                            class="form-control"
                                            placeholder="Nhập địa chỉ cụ thể (số nhà, đường, ngõ, thôn, xóm, ấp...)"
                                        >
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note">Ghi chú</label>
                                        <textarea
                                            id="note"
                                            name="note"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Ghi chú cho đơn hàng..."
                                        >{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">Phương thức thanh toán <span class="text-danger">*</label>
                                        <select class="form-control" name="payment" id="payment">
                                            <option value="cash">Tiền mặt(Thanh toán khi nhận hàng)</option>
                                            <option value="online">Thanh toán online</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer d-flex justify-content-between mt-1">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-chevron-left"></i>
                                Giỏ hàng
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <span id="submit">Tiếp tục</span>
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box-->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#payment').change(function() {
            var selectedPayment = $(this).val();
            var submitSpan = $('#submit');
            if (selectedPayment === 'cash') {
                submitSpan.text('Xác nhận');
            } else {
                submitSpan.text('Tiếp tục');
            }
        });
    });
</script>

@endsection
