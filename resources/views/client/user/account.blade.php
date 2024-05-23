@extends('client.layouts.app')

@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Tài khoản của tôi</li>
                    </ol>
                </nav>
            </div>

            @include('client.layouts.content.sidebar_user')

            <div class="col-lg-9">
                <div class="box">
                    <h1>Tài khoản của tôi</h1>
                    <p class="text-primary ml-1">{{ $user->email }}</p>
                    <p class="lead">Thay đổi thông tin cá nhân hoặc mật khẩu của bạn tại đây.</p>
                    <h3>Đổi mật khẩu</h3>
                    <form action="{{ route('user.account.changePassword') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="old_password">Mật khẩu cũ <span class="text-danger">*</span></label>
                                    <input
                                        id="old_password"
                                        type="password"
                                        class="form-control"
                                        placeholder="Nhập mật khẩu cũ"
                                        name="old_password"
                                    >
                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password">Mật khẩu mới <span class="text-danger">*</span></label>
                                    <input
                                        id="new_password"
                                        type="password"
                                        class="form-control"
                                        placeholder="Nhập mật khẩu mới"
                                        name = "new_password"
                                    >
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                                    <input
                                        id="confirm_password"
                                        type="password"
                                        class="form-control"
                                        placeholder="Nhập lại mật khẩu mới"
                                        name = "confirm_password"
                                    >
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu mật khẩu
                                mới</button>
                        </div>
                    </form>
                    <h3 class="mt-5">Thông tin tài khoản</h3>
                    <form action="{{ route('user.account.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Tên <span class="text-danger">*</span></label>
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Nhập tên của bạn"
                                        value="{{ old('name') ?? $user->name }}"
                                        name="name"
                                    >
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input
                                        pattern="\d*"
                                        oninput="this.value = this.value.replace(/\D/, '')"
                                        id="phone"
                                        type="text"
                                        class="form-control"
                                        placeholder="Nhập số điện thoại"
                                        value="{{ old('phone') ?? $user->phone }}"
                                        name="phone"
                                    >
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input
                                        id="address"
                                        type="text" class="form-control"
                                        placeholder="Nhập địa chỉ"
                                        value="{{ old('address') ?? $user->address }}"
                                        name="address"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <div>
                                        <label for="image" class="btn btn-info btn-sm"><i class="fa fa-camera"></i> Chọn ảnh</label>
                                        <input hidden type="file" accept="images/" class="form-control" id="image" name="image">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <img width="35%" class="img-fluid"
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
                                        <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                                        <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        name="birthday"
                                        placeholder="Nhập ngày sinh"
                                        value="{{ old('brithday') ?? $user->birthday }}"
                                    >
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
            $("#image").change(function (e) {
                $("#show-image").attr("src", URL.createObjectURL(e.target.files[0]));
            });
        });
</script>
@endsection
