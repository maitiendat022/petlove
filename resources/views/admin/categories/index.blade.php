@extends('admin.layouts.app')

@section('title','Danh mục')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Danh mục sản phẩm</h3>
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
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
                    </div>
                    <div class="col-10 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%">#</th>
                                <th width="15%">Tên danh mục</th>
                                <th width="10%">Loại thú cưng</th>
                                <th width="15%">Thuộc danh mục</th>
                                <th width="10%">Trạng thái</th>
                                <th width="1%"></th>
                                <th width="1%"></th>
                            </thead>

                            <tbody>
                                @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->pet_name }}</td>
                                    <td>{{ $item->parent_name }}</td>
                                    <td
                                        class="{{ ($item->status)=='active'?'text-success':'text-danger' }}"
                                        >
                                        {{ ($item->status)=='active'?'Đang bán':'Ngừng bán' }}
                                    </td>
                                    @include('admin.layouts.includes.status',['status'=>$item->status,'name'=>'categories'])
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->appends(['name' => $name, 'pet_id' => $pet_id, 'parent_id' => $parent_id,'status'=> $status ])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('admin/assets/js/pet.js') }}"></script>
@endsection
