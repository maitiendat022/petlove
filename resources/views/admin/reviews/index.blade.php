@extends('admin.layouts.app')

@section('title','Đánh giá')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header mb-3">
                        <h3 class="card-title">Danh sách đánh giá</h3>
                    </div>
                    <div class="col-12 mt-3 ml-3">
                        <form action="" method="">
                            <div class="row">
                                <div class="col-2">
                                    <select class="form-control" name="rating">
                                        <option value="">Chọn đánh giá</option>
                                        @for ($i=1; $i<=5; $i++) <option value="{{ $i }}" {{ $rating==$i ? 'selected'
                                            : '' }}>
                                            {{ $i }} sao</option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" name="status">
                                        <option value="">Chọn trạng thái</option>
                                        <option value="review" {{ $status=='review' ? 'selected' : '' }}>Chưa phản hồi
                                        </option>
                                        <option value="feedback" {{ $status=='feedback' ? 'selected' : '' }}>Đã phản hồi
                                        </option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-info">Lọc</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="col-12 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th width="1%">#</th>
                                <th width="1%">Sản phẩm</th>
                                <th>Tên sản phẩm (Kích thước/Màu sắc)</th>
                                <th>Đơn hàng</th>
                                <th>Người đánh giá</th>
                                <th>Đánh giá</th>
                                <th>Trạng thái</th>
                                <th width="1%"></th>
                            </thead>

                            <tbody>
                                @foreach ($reviews as $item)
                                <tr>
                                    <td style="padding-top: 60px">{{ $item->id }}</td>
                                    <td style="text-align: center">
                                        <a href="{{ route('products.show',$item->product_id) }}">
                                            <img height="120px" src="{{ $item->orderProduct->product->image_path }}"
                                                alt="">
                                        </a>
                                    </td>
                                    <td style="padding-top: 50px">
                                        <div class="col">
                                            <span class="row">
                                                {{ $item->orderProduct->product->name }}
                                            </span>
                                            <span class="text-center">{{ $item->orderProduct->detail->size != "null"
                                                ? $item->orderProduct->detail->size : ''}}
                                                / {{ $item->orderProduct->detail->color != "null" ?
                                                $item->orderProduct->detail->color : ''}}
                                            </span>
                                        </div>
                                    </td>
                                    <td style="padding-top: 60px">#{{ $item->orderProduct->order_id }}</td>
                                    <td style="padding-top: 60px">{{ $item->user->name }}</td>
                                    <td style="padding-top: 60px">{{ $item->rating }} sao</td>
                                    <td style="padding-top: 60px" class="{{ $item->feedback != null ? 'text-success' : 'text-danger' }}">
                                        {{ $item->feedback != null ? 'Đã phản hồi' : 'Chưa phản hồi' }}
                                    </td>
                                    <td style="padding-top: 50px">
                                        @if ($item->feedback == null)
                                        <a href="{{ route('reviews.show',['id'=>$item->id]) }}" class="btn btn-warning">Phản hồi</a>
                                        @else
                                        <a href="{{ route('reviews.show',['id'=>$item->id]) }}" class="btn btn-info">Xem</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $reviews->appends(['rating' => $rating,'status' => $status])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
