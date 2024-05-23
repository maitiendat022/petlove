@extends('admin.layouts.app')

@section('title','Sản phẩm')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Danh sách sản phẩm</h3>
                    </div>
                    <div class="col-12 mt-3 ml-3">
                        <form action="" method="">


                            <div class="row">
                                <div class="col-1">
                                    <button class="btn btn-info">Tìm kiếm</button>
                                </div>
                                <div class="col-3">
                                    <input type="search" name="name" class="form-control" placeholder="Từ khóa tìm kiếm"
                                        value="{{ $name }}">
                                </div>
                                <div class="col-2">
                                    <select class="form-control" name="pet_id" id ="pet_id">
                                        <option value="">Chọn thú cưng</option>
                                        @foreach ($pets as $item)
                                        <option value="{{ $item->id }}" {{ $pet_id==$item->id ? 'selected' : '' }}>{{
                                            $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" name="parent_id" id="parent_id">
                                        <option value="">Chọn danh mục chính</option>
                                        @foreach ($parent as $item)
                                        <option data-pet="{{ $item->pet_id }}" value="{{ $item->id }}" {{ $parent_id==$item->id ? 'selected' : '' }}>{{
                                            $item->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">Chọn danh mục phụ</option>
                                        @foreach ($categories as $item)
                                        <option data-pet_id="{{ $item->pet_id }}" data-parent_id="{{ $item->parent_id }}" value="{{ $item->id }}" {{ $category_id==$item->id ? 'selected' : '' }}>{{
                                            $item->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <select class="form-control" name="status" id="status">
                                        <option value="">Trạng thái</option>
                                        <option {{ $status == 'active' ? 'selected' : '' }} value="active">Đang bán</option>
                                        <option {{ $status == 'inactive' ? 'selected' : '' }}  value="inactive">Ngừng bán</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="col-3 mt-3">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
                    </div>

                    <div class="col-12 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%">#</th>
                                <th width="15%">Tên sản phẩm</th>
                                <th width="15%">Loại sản phẩm</th>
                                <th width="10%">Thú cưng</th>
                                <th width="10%">Trạng thái</th>
                                <th width="1%"></th>
                                <th width="1%"></th>
                            </thead>

                            <tbody>
                                @foreach ($products as $item)
                                <tr>
                                    <td><a class="text-primary" href="{{ route('products.show',$item->id) }}">{{ $item->id }}</a></td>
                                    <td><a class="text-primary" href="{{ route('products.show',$item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->category->petName }}</td>
                                    <td
                                        class="{{ ($item->status)=='active'?'text-success':'text-danger' }}"
                                        >
                                        {{ ($item->status)=='active'?'Đang bán':'Ngừng bán' }}
                                    </td>
                                    @include('admin.layouts.includes.status',['status'=>$item->status,'name'=>'products'])
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->appends(['name' => $name,'pet_id' => $pet_id, 'parent_id' => $parent_id, 'category_id' => $category_id, 'status' => $status])->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('admin/assets/js/category.js') }}"></script>
@endsection
