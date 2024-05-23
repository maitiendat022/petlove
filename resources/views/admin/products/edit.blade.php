@extends('admin.layouts.app')

@section('title','Sản phẩm')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h3 class="card-title">Cập nhật sản phẩm</h3>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="card-body">
                            <form action="{{ route('products.update',$product->id) }}" method="POST" id="product"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row ml-1">
                                    <div class="col-8 mr-4">
                                        <h4 class="ml-2">Thông tin sản phẩm</h4>
                                        <div class="row ml-1">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>Chọn loại thú cưng</label>
                                                    <select class="form-control" name="pet_id"  id="pet_id">
                                                        <option value="">Chọn</option>
                                                        @foreach ($pets as $item)
                                                        <option
                                                            value="{{ $item->id }}" {{ $product->category->pet->id == $item->id ? 'selected' : '' }}
                                                        >
                                                        {{ $item->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3 ml-4">
                                                <div class="form-group">
                                                    <label>Chọn loại sản phẩm chính</label>
                                                    <select class="form-control" name="parent_id" id="parent_id">
                                                        <option value="">Chọn</option>
                                                        @foreach ($parent as $item)
                                                        <option
                                                            data-pet="{{ $item->pet_id }}" value="{{ $item->id }}" {{ $product->category->parent->id == $item->id ? 'selected' : '' }}
                                                        >
                                                        {{ $item->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3  ml-4">
                                                <div class="form-group">
                                                    <label>Chọn loại sản phẩm phụ</label>
                                                    <select class="form-control" name="category_id" id="category_id">
                                                        <option value="">Chọn</option>
                                                        <option value="1">Loại sp phụ 1</option>
                                                        @foreach ($categories as $item)
                                                        <option
                                                            data-pet_id="{{ $item->pet_id }}" data-parent_id="{{ $item->parent_id }}"
                                                            value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}
                                                        >
                                                        {{ $item->name }}
                                                        </option>
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
                                                        placeholder="Nhập tên sản phẩm" value="{{ old('name') ?? $product->name }}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <textarea id="description" name="description">{{ old('description') ?? $product->description }}</textarea>
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
                                                        <option value="add" selected disabled>Chọn</option>
                                                        <option value="size">Kích thước</option>
                                                        <option value="color">Màu sắc</option>
                                                    </select>
                                                </div>
                                                <div class="row" id="outputContainer">
                                                </div>

                                                <div class="version-container" id="versionContainer">
                                                </div>

                                            </div>
                                            <a href="#" class="add-version" onclick="createVariants()">Tạo lại biến thể</a>
                                            <input hidden type="text" id ="createDetail" name = "createDetail" value="">
                                            <table id="variantTable" class="col-9">
                                                <thead>
                                                    <th width='12%'>Kích thước</th>
                                                    <th width='10%'>Màu sắc</th>
                                                    <th width='20%'>Giá</th>
                                                    <th width='10%'>Số lượng</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($productDetail as $key => $item )
                                                        <tr>
                                                            <td><input hidden name = 'size[]' type='text' value = '{{ $item->size }}'>{{ $item->size }}</td>
                                                            <td><input hidden name = 'color[]' type='text' value = '{{ $item->color }}'>{{ $item->color }}</td>
                                                            <td><input name = 'price[]' type='text' placeholder='Nhập giá' value = '{{ $item->price }}'></td>
                                                            <td><input name = 'quantity[]' type='text' placeholder='Nhập số lượng'  value = '{{ $item->quantity }}'></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
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
                                                    <label>Ảnh sản phẩm:</label>
                                                    <div id="selected-images"></div>
                                                </div>
                                                @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div class="col-md-12">
                                                    <div id="existing-images">
                                                        @foreach ($product->images as $image)
                                                            <img src="{{ asset('upload/product/' . $image->url) }}" alt="{{ $image->alt }}" class="img-fluid" style="width:100px; margin-right: 5px;">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill mt-4 mb-4">Cập nhật</button>
                                <a  id="goBackButton" style="margin-left: 720px" href="" class="btn btn-danger btn-fill mt-4 mb-4">Hủy</a>
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
<script>
    document.getElementById('goBackButton').addEventListener('click', function () {
        window.history.back();
    });
</script>
@endsection
