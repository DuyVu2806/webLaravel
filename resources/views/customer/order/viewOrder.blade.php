@extends('layouts.home')

@section('content')
    <div class="py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white text-uppercase">Chi tiết đơn hàng
                            <a class=" float-end btn btn-outline-light" href="{{route('myOrder')}}">Quay lại</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                    <label for="">Tên</label>
                                    <div class="border p-2">{{$orders->name}}</div> 

                                    <label for="">Email</label>
                                    <div class="border p-2">{{$orders->email}}</div>

                                    <label for="">Số điện thoại liên hệ</label>
                                    <div class="border p-2">{{$orders->phone}}</div>                           

                                    <label for="">Địa chỉ giao hàng</label>
                                    <div class="border p-2">{{$orders->address}} Tỉnh(Thành phố) {{$orders->province}}</div>
                            </div>


                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên </th>
                                            <th>Số lượng</th>
                                            <th>Giá tiền</th>
                                            <th>Hình ảnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderItems as $item)
                                        <tr>
                                            <td>{{$item->products->name}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{number_format($item->price)}}</td>
                                            <td class="text-center"><img width="50px" height="50px" src="{{url('assets/img/'.$item->products->image)}}" alt=""></td>
                                        </tr>                                            
                                        @endforeach

                                    </tbody>
                                </table>
                                <h4 class="float-end">Tổng tiền: {{number_format($orders->total_price)}} VNĐ</h4>
                            </div>                                                         

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection