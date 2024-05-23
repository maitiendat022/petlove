@extends('admin.layouts.app')

@section('title','Người dùng')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Danh sách người dùng</h3>
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
                                    <select class="form-control" name="role_id">
                                        <option value="0">Chọn quyền</option>
                                        @foreach ($roles as $item)
                                        <option value="{{ $item->id }}" {{ $role_id==$item->id ? 'selected' : '' }}>{{
                                            $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <select class="form-control" name="status" id="status">
                                        <option value="">Trạng thái</option>
                                        <option {{ $status == 'active' ? 'selected' : '' }} value="active">Hoạt động</option>
                                        <option {{ $status == 'inactive' ? 'selected' : '' }}  value="inactive">Đã khóa</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="col-3 mt-3">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm người dùng</a>
                    </div>
                    <div class="col-12 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%">#</th>
                                <th width="15%">Tên</th>
                                <th width="15%">Email</th>
                                <th width="10%">Số điện thoại</th>
                                <th width="15%">Quyền</th>
                                <th width="10%">Trạng thái</th>
                                <th width="1%"></th>
                                <th width="1%"></th>
                            </thead>

                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td><a class="text-primary" href="{{ route('users.show',$item->id) }}">{{ $item->id }}</a></td>
                                    <td><a class="text-primary" href="{{ route('users.show',$item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->role->name }}</td>
                                    <td
                                        class="{{ ($item->status)=='active'?'text-success':'text-danger' }}"
                                        >
                                        {{ ($item->status)=='active'?'Hoạt động':'Đã khóa' }}
                                    </td>
                                    @include('admin.layouts.includes.status',['status'=>$item->status,'name'=>'users'])
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->appends(['name' => $name, 'role_id' => $role_id,'status'=> $status])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
