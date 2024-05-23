@extends('admin.layouts.app')

@section('title','Sản phẩm')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h3 class="card-title">Thêm mới sản phẩm</h3>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST" id="product"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row ml-1">
                                    <div class="col-8 mr-4">
                                        <h4 class="ml-2">Thông tin sản phẩm</h4>
                                        <div class="row ml-1">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>Chọn thú cưng</label>
                                                    <select class="form-control" name="pet_id" id ="pet_id">
                                                        <option value="">Chọn thú cưng</option>
                                                        @foreach ($pets as $item)
                                                        <option value="{{ $item->id }}"{{ old('pet_id')==$item->id ? 'selected' : '' }}>{{$item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3 ml-4">
                                                <div class="form-group">
                                                    <label>Chọn danh mục chính</label>
                                                    <select class="form-control" name="parent_id" id="parent_id">
                                                        <option value="">Chọn danh mục chính</option>
                                                        @foreach ($parent as $item)
                                                        <option data-pet="{{ $item->pet_id }}"{{ old('parent_id')==$item->id ? 'selected' : '' }} value="{{ $item->id }}" >{{$item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3  ml-4">
                                                <div class="form-group">
                                                    <label>Chọn danh mục phụ</label>
                                                    <select class="form-control" name="category_id" id="category_id">
                                                        <option value="">Chọn danh mục phụ</option>
                                                        @foreach ($categories as $item)
                                                        <option data-pet_id="{{ $item->pet_id }}" data-parent_id="{{ $item->parent_id }}" {{ old('category_id')==$item->id ? 'selected' : '' }} value="{{ $item->id }}"
                                                            {{ old('category_id')==$item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row ml-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tên sản phẩm</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Nhập tên sản phẩm" value="{{ old('name')}}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <textarea id="description" name="description">{{ old('description')}}</textarea>
                                                    @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="ml-4">
                                            <h5>Biến thể sản phẩm</h5>
                                            <div class="">
                                                <div class="col-1 mb-2">
                                                    <select class="form-control" id="selectOption"
                                                        onchange="showInput()">
                                                        <option value="add" selected disabled>Thêm</option>
                                                        <option value="size">Kích thước</option>
                                                        <option value="color">Màu sắc</option>
                                                    </select>
                                                </div>
                                                <div class="row" id="outputContainer">
                                                </div>

                                                <div class="version-container" id="versionContainer">
                                                </div>

                                            </div>
                                            <a href="#" class="add-version" onclick="createVariants()">Tạo biến thể</a>
                                           <div class="col">
                                                @error('size')
                                                <span class="text-danger row">{{ $message }}</span>
                                                @enderror
                                                @error('quantity')
                                                <span class="text-danger row">{{ $message }}</span>
                                                @enderror
                                                @error('price')
                                                <span class="text-danger row">{{ $message }}</span>
                                                @enderror
                                           </div>
                                            <table id="variantTable" class="col-9">

                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-3 ml-4">
                                        <h4 class="ml-2">Hình ảnh</h4>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <div class="form-group ml-3">
                                                    <label class="row">Chọn hình ảnh</label>
                                                    <label class="row btn btn-dark" for="image-input">Chọn album</label>
                                                    <input hidden type="file" accept="images/"
                                                        class="form-control" id="image-input" name="image[]" multiple>
                                                </div>

                                                <div class="form-group col-12">
                                                    <label>Ảnh đã chọn:</label>
                                                    <div id="selected-images"></div>
                                                </div>
                                                @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill mt-4 mb-4">Thêm mới</button>
                                <a style="margin-left: 720px" href="{{ route('products.index') }}" class="btn btn-danger btn-fill mt-4 mb-4">Hủy</a>
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

<script src="{{ asset('admin/assets/js/product.js') }}"></script>
<script src="{{ asset('admin/assets/js/category.js') }}"></script>
@endsection
