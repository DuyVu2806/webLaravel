@extends('layouts.index')

@section('main')
    <div class="card">
        <div class="card-header">
            <h4>Chi tiết mã đơn: {{$billDetail->stracking_no}}
                <a href="{{route('bill.list')}}" class="float-end btn btn-outline-primary">Quay lại</a>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Hình ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billDetail->orderItems as $item)
                    <tr>
                        <td>{{$item->products->name}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->products->price}}</td>
                        <td><img width="50px" height="50px" src="{{url('assets/img/'.$item->products->image)}}" alt=""></td>
                    </tr>                        
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection