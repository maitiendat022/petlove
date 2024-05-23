@extends('admin.layouts.app')

@section('title','Thú cưng')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Danh sách thú cưng</h3>
                    </div>
                    <div class="col-12 mt-3 ml-3">
                        <form action="">
                            <div class="row">
                                <div class="col-1">
                                    <button type="submit" class="btn btn-info">Tìm kiếm</button>
                                </div>
                                <div class="col-3">
                                    <input type="search" class="form-control" placeholder="Từ khóa tìm kiếm" name = "name" value="{{ $name }}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="col-3 mt-3 ">
                        <a href="{{ route('pets.create') }}" class="btn btn-primary">Thêm loại thú cưng</a>
                    </div>
                    <div class="col-6 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%">#</th>
                                <th width="65%">Tên thú cưng</th>
                                <th width="30%">Trạng thái</th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                            </thead>

                            <tbody>
                                @foreach ($pets as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td
                                        class="{{ ($item->status)=='active'?'text-success':'text-danger' }}"
                                        >
                                        {{ ($item->status)=='active'?'Hoạt động':'Ngừng chăm sóc' }}
                                    </td>
                                    @include('admin.layouts.includes.status',['status'=>$item->status,'name'=>'pets'])
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pets->appends(['name' => $name ])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
