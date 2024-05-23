@extends('client.layouts.app')

@section('title','Petlove - Đăng nhập')

@section('content')

<div id="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li aria-current="page" class="breadcrumb-item active">Đăng nhập</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6">
            <div class="box">
              <h1>Đăng nhập</h1>
              <p class="lead">Đã là khách hàng của chúng tôi?</p>
              <hr>
                @if(session('message'))
                    <div class="mb-1">
                        <span class="text-danger">{{ (session('message')) }}</span>
                    </div>
                @endif
              <form name="formLogin" action="{{ route('auth.login') }}" method="post">
              @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                      id="email"
                      type="text"
                      class="form-control"
                      name="email"
                      placeholder="Nhập email"
                      value="{{ old('email') }}"
                  >
                  @error('email')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input
                      id="password"
                      type="password"
                      class="form-control"
                      name="password"
                      placeholder="Nhập password"
                  >
                  @error('password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Đăng nhập</button>
                </div>
              </form>
            </div>
          </div>
        <div class="col-lg-6">
          <div class="box">
            <h1>Tạo tài khoản mới</h1>
            <p class="lead">Chưa phải là khách hàng đã đăng ký của chúng tôi?</p>
            <p>Với việc đăng ký với chúng tôi, thế giới thời trang mới, mức giảm giá tuyệt vời và nhiều hơn thế nữa sẽ mở ra cho bạn! Toàn bộ quá trình sẽ không đưa bạn quá một phút!</p>
            <hr>
            <strong>
                <a href="{{ route('auth.registerIndex') }}">Đăng ký ngay</a>
            </strong>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
