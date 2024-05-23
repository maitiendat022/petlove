@extends('admin.layouts.app')

@section('title','Tài khoản')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Thông tin tài khoản</h3>
                    </div>
                    <div class="row-md-12">
                        <div class="ml-5">
                            <span class="row text-primary">{{ $user->email }}</span>
                            <span class="row">Thay đổi thông tin cá nhân hoặc mật khẩu của bạn tại đây.</span>
                        </div>
                        <hr>
                        <div class="row ml-5 mb-5">
                            <div class="col-5 mr-5">
                                <h4>Đổi mật khẩu</h4>
                                <form action="{{ route('admin.account.changePassword') }}" method="POST">
                                    @csrf
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="old_password">Mật khẩu cũ <span
                                                            class="text-danger">*</span></label>
                                                    <input id="old_password" type="password" class="form-control"
                                                        placeholder="Nhập mật khẩu cũ" name="old_password">
                                                    @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="new_password">Mật khẩu mới <span
                                                            class="text-danger">*</span></label>
                                                    <input id="new_password" type="password" class="form-control"
                                                        placeholder="Nhập mật khẩu mới" name="new_password">
                                                    @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="confirm_password">Xác nhận mật khẩu mới <span
                                                            class="text-danger">*</span></label>
                                                    <input id="confirm_password" type="password" class="form-control"
                                                        placeholder="Nhập lại mật khẩu mới" name="confirm_password">
                                                    @error('confirm_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu mật
                                                khẩu
                                                mới</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-5">
                                <h4 class="mt-5">Thông tin tài khoản</h4>
                                <form action="{{ route('admin.account.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">Tên <span class="text-danger">*</span></label>
                                                    <input id="name" type="text" class="form-control"
                                                        placeholder="Nhập tên của bạn"
                                                        value="{{ old('name') ?? $user->name }}" name="name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Số điện thoại</label>
                                                    <input pattern="\d*" oninput="this.value = this.value.replace(/\D/, '')"
                                                        id="phone" type="text" class="form-control"
                                                        placeholder="Nhập số điện thoại"
                                                        value="{{ old('phone') ?? $user->phone }}" name="phone">
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Địa chỉ</label>
                                                    <input id="address" type="text" class="form-control"
                                                        placeholder="Nhập địa chỉ"
                                                        value="{{ old('address') ?? $user->address }}" name="address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ảnh đại diện</label>
                                                    <div>
                                                        <label for="image" class="btn btn-info btn-sm"><i
                                                                class="fa fa-camera"></i>
                                                            Chọn ảnh</label>
                                                        <input hidden type="file" accept="images/" class="form-control"
                                                            id="image" name="image">
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <img width="50%" class="img-fluid"
                                                        src="{{ $user->images ? asset('upload/user/'.$user->images()->first()->url) : asset('upload/user/avt-default.jpg') }}"
                                                        alt="" id="show-image">
                                                </div>
                                                @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">Giới tính</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : ''
                                                            }}>Nam
                                                        </option>
                                                        <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ngày sinh</label>
                                                    <input type="date" class="form-control" name="birthday"
                                                        placeholder="Nhập ngày sinh"
                                                        value="{{ old('brithday') ?? $user->birthday }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i>
                                                    Lưu thay đổi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
