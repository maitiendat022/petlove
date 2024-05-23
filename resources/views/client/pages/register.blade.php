@extends('client.layouts.app')

@section('title','Petlove - Đăng ký')

@section('content')

<div id="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li aria-current="page" class="breadcrumb-item active">Tạo tài khoản / Đăng ký</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6">
          <div class="box">
            <h1>Tạo tài khoản mới</h1>
            <p class="lead">Chưa phải là khách hàng đã đăng ký của chúng tôi?</p>
            <p>Với việc đăng ký với chúng tôi, thế giới thời trang mới, mức giảm giá tuyệt vời và nhiều hơn thế nữa sẽ mở ra cho bạn! Toàn bộ quá trình sẽ không đưa bạn quá một phút!</p>
            <hr>
            <form name="formRegister" action="{{ route('auth.register') }}" method="POST">
            @csrf
              <div class="form-group">
                <label for="name">Tên tài khoản</label>
                <input
                    id="name"
                    name= "name"
                    type="text"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Nhập tên tài khoản"
                >
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    name= "email"
                    type="text"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="Nhập email"
                >
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
              <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input
                    id="password"
                    name= "password"
                    type="password"
                    class="form-control"
                    placeholder="Nhập mật khẩu"
                >
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Đăng ký</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="box">
            <h1>Đăng nhập</h1>
            <p class="lead">Đã là khách hàng của chúng tôi?</p>
            <hr>
            <strong>
                <a href="{{ route('auth.loginIndex') }}">Đăng nhập tại đây</a>
            </strong>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
