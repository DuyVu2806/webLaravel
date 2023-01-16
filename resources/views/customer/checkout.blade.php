@extends('layouts.home')

@section('content')
<form action="{{route('placeOrder')}}" method="POST">
    @csrf
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h6>Thông tin cá nhân</h6><hr>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="">Tên</label>
                            <input type="text" required name="name" class="form-control" placeholder="Nhập Tên..." value="{{Auth::guard('cus')->user()->name}}">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="">Email</label>
                            <input type="text" required name="email" class="form-control" placeholder="Nhập Email... " value="{{Auth::guard('cus')->user()->email}}">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="">Số Điện Thoại</label>
                            <input type="text" required name="phone" class="form-control" placeholder="Nhập Số điện thoại..." value="{{Auth::guard('cus')->user()->phone}}">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="">Tỉnh (Thành phố)</label>
                            <input type="text" required name="province" class="form-control" placeholder="Nhập Tỉnh(Thành phố)...">
                        </div>

                        <div class="mb-4">
                            <label for="">Địa chỉ</label>
                            <textarea type="text" required name="address" rows="4" class="form-control" placeholder="Địa chỉ...">{{Auth::guard('cus')->user()->address}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h6>Thông tin sản phẩm</h6><hr>
                    <table class="table table-borderless">
                        <thead>
                            <tr class="fw-bold">
                                <td>Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Giá</td>
                            </tr>
                        </thead>
                        @php
                        $total_price = 0    
                        @endphp
                        <tbody>
                            @foreach ($cartItem as $item)
                            <tr>
                                <td>{{$item->products->name}}</td>
                                <td>{{$item->prod_qty}}</td>
                                <td>{{number_format($item->products->price)}} VNĐ</td>
                            </tr>
                        @php
                            $total_price += $item->products->price * $item->prod_qty
                        @endphp    
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                        <h5 class="d-flex justify-content-end">Tổng tiền: {{number_format($total_price)}}VNĐ</h5>
                    <hr>
                    <button type="submit" class="btn btn-primary float-end">Thanh toán</button>
                </div>
            </div>
        </div>
    </div>    
</form>

@endsection