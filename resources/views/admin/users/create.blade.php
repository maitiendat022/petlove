@extends('admin.layouts.app')

@section('title','Người dùng')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h3 class="card-title">Thêm mới người dùng</h3>
                    </div>
                    <hr>
                    <div class="col-12 mt-3">
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row ml-1">
                                    <div class="col-4 mr-4">
                                        <h4 class="ml-2">Thông tin tài khoản</h4>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tên người dùng</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        placeholder="Nhập tên người dùng"
                                                        value="{{ old('name')}}"
                                                    >
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Nhập email" value="{{ old('email')}}">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Mật khẩu</label>
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Nhập mật khẩu" value="{{ old('password')}}">
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Phân quyền</label>
                                                    <select class="form-control" name="role_id">
                                                        <option value="">Chọn quyền</option>
                                                        @foreach ($roles as $item)
                                                        <option value="{{ $item->id }}" {{ old('role_id')==$item->id ?
                                                            'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-4 ml-4 mr-4">
                                        <h4 class="ml-2">Thông tin liên hệ</h4>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Ngày sinh</label>
                                                    <input type="date" class="form-control" name="birthday"
                                                        placeholder="Nhập ngày sinh" value="{{ old('brithday')}}">

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Giới tính</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="">Chọn giới tính</option>
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Số điện thoại</label>
                                                    <input pattern="\d*" oninput="this.value = this.value.replace(/\D/, '')" type="text" class="form-control" name="phone"
                                                        placeholder="Nhập số điện thoại" value="{{ old('phone')}}">
                                                </div>
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Địa chỉ</label>
                                                    <input type="text" class="form-control" name="address"
                                                        placeholder="Nhập địa chỉ" value="{{ old('address')}}">
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-2 ml-4">
                                        <h4 class="ml-2">Hình ảnh</h4>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Chọn hình ảnh</label>
                                                    <input style="width:82px" type="file" accept="images/"
                                                        class="form-control" id="image" name="image">
                                                </div>
                                                <div class="form-group col-12">
                                                    <img class="img-fluid" src="{{ asset('upload/user/avt-default.jpg') }}"
                                                        alt="" id="show-image">
                                                </div>

                                                @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill mt-2 mb-4">Thêm mới</button>
                                <a href="{{ route('users.index') }}" style="margin-left: 400px" class="btn btn-danger btn-fill mt-2 mb-4">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src = {{ asset('admin/assets/js/show_image.js') }}></script>
@endsection
