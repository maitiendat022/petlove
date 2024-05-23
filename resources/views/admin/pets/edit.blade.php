@extends('admin.layouts.app')

@section('title','Thú cưng')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h3 class="card-title">Cập nhật thú cưng</h3>
                    </div>
                    <hr>
                    <div class="col-6 mt-3">
                        <div class="card-body">
                            <form action="{{ route('pets.update',$pet->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row ml-1">
                                    <div class="col-md-12">
                                        <div class="form-group pr-4">
                                            <label>Tên thú cưng</label>
                                            <input type="text" class="form-control" name = "name" placeholder="Nhập tên thú cưng" value="{{ old('name') ?? $pet->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill mb-4">Cập nhật</button>
                                <a href="{{ route('pets.index') }}" class="btn btn-danger btn-fill pull-right mb-4">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

