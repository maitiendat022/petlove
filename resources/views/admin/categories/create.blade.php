@extends('admin.layouts.app')

@section('title','Danh mục')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h3 class="card-title">Thêm mới danh mục</h3>
                    </div>
                    <hr>
                    <div class="col-12 mt-3">
                        <div class="card-body">
                            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row ml-1">
                                    <div class="col-4 mr-4">
                                        <h4 class="ml-2">Thông tin danh mục</h4>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Chọn quyền</label>
                                                    <select class="form-control" name="pet_id" id="pet_id">
                                                        <option value="">Chọn thú cưng</option>
                                                        @foreach ($pets as $item)
                                                        <option value="{{ $item->id }}"{{ old('pet_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pet_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Chọn danh mục chính</label>
                                                    <select class="form-control" name="parent_id" id="parent_id">
                                                        <option value="">Chọn danh mục chính</option>
                                                        @foreach ($parent as $item)
                                                        <option data-pet="{{ $item->pet_id }}" value="{{ $item->id }}"{{ old('parent_id') == $item->id ? 'selected' : '' }} >{{
                                                            $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('parent_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tên danh mục</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Nhập tên danh mục" value="{{ old('name')}}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-info btn-fill mt-2 mb-4">Thêm mới</button>
                                <a style="margin-left: 370px" href="{{ route('categories.index') }}" class="btn btn-danger btn-fill mt-2 mb-4">Hủy</a>
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
<script src="{{ asset('admin/assets/js/pet.js') }}"></script>
@endsection
