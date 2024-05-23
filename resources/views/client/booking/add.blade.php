@extends('client.layouts.app')

@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Thông tin lịch đặt</li>
                    </ol>
                </nav>
            </div>

            <div id="checkout" class="col-lg-12">
                <div class="box">
                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf

                        <h1>Đặt lịch - Thông tin</h1>
                        <div class="nav flex-column flex-md-row nav-pills text-center mt-3">
                            <span class="nav-link  text-sm-center active">Nhập thông tin lịch đặt</span>
                        </div>
                        <div class="content py-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chọn dịch vụ <span class="text-danger">*</span></label>
                                        <select class="form-control bg-light" name="serviece_id">
                                            <option value="">Chọn loại dịch vụ</option>
                                            @foreach ($servieces as $item)
                                            <option value="{{ $item->id }}" {{ old('serviece_id')==$item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('serviece_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chọn ngày <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name = "date" value="{{ old('date') ?? date('Y-m-d') }}">
                                        @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Chọn thời gian <span class="text-danger">*</span></label>
                                        <select class="form-control bg-light" name="time">
                                            @foreach ($time as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @error('time')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="book_name">Họ và tên <span class="text-danger">*</span></label>
                                        <input
                                            value="{{ old('book_name') ?? auth()->user()->name }}"
                                            name="book_name" id="book_name"
                                            type="text"
                                            class="form-control"
                                            placeholder="Nhập họ tên"
                                        >
                                        @error('book_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="book_phone">Số điện thoại <span class="text-danger">*</label>
                                        <input
                                            pattern="\d*"
                                            oninput="this.value = this.value.replace(/\D/, '')"
                                            id="book_phone"
                                            type="text"
                                            class="form-control"
                                            name="book_phone"
                                            value="{{ old('book_phone') ?? auth()->user()->phone }}"
                                            placeholder="Nhập số điện thoại"
                                        >
                                        @error('book_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pet_name">Tên thú cưng <span class="text-danger">*</label>
                                        <input
                                            class="form-control"
                                            name="pet_name"
                                            id="pet_name"
                                            value="{{ old('pet_name') }}"
                                            placeholder="Nhập tên thú cưng"
                                        >
                                        @error('pet_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pet_age">Tuổi (tháng) <span class="text-danger">*</label>
                                            <input
                                                pattern="\d*"
                                                oninput="this.value = this.value.replace(/\D/, '')"
                                                id="pet_age"
                                                type="text"
                                                class="form-control"
                                                name="pet_age"
                                                value="{{ old('pet_age') }}"
                                                placeholder="Nhập tuổi của thú cưng"
                                            >
                                            @error('pet_age')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pet_specie">Giống <span class="text-danger">*</label>
                                            <input
                                            class="form-control"
                                            name="pet_specie"
                                            id="pet_specie"
                                            value="{{ old('pet_specie') }}"
                                            placeholder="Nhập giống"
                                        >
                                        @error('pet_specie')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pet_weight">Cân nặng (kg) <span class="text-danger">*</label>
                                            <input
                                                pattern="\d*"
                                                oninput="this.value = this.value.replace(/\D/, '')"
                                                id="pet_weight"
                                                type="text"
                                                class="form-control"
                                                name="pet_weight"
                                                value="{{ old('pet_weight') }}"
                                                placeholder="Nhập cân nặng của thú cưng"
                                            >
                                            @error('pet_weight')
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
                                            rows="1"
                                            placeholder="Nhập một số thông tin cơ bản..."
                                        >{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer d-flex justify-content-between mt-1">
                            <button type="submit" class="btn btn-primary ml-auto pl-4 pr-4">
                                <span id="submit">Xác nhận</span>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box-->
            </div>
        </div>
    </div>
</div>

@endsection
