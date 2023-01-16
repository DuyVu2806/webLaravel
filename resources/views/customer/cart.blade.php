@extends('layouts.home')

@section('content')
    <div class="card shadow" style="margin-top: 40px">
        <div class="card-header" >
            <h2 class="text-uppercase">Giỏ hàng</h2>
        </div>
        <div class="card-body">
            @php
                $total = 0;
            @endphp
            @if ( Countcart(Auth::guard('cus')->user()->id) !=0)
            @foreach ($cartItems as $item)
                    <div class="row product_data">
                        <div class="col-md-1 my-auto">
                            <img src="{{asset('assets/img/'.$item->products->image)}}" alt="" style="width: 50px;height: 50px;">
                        </div>
                        <div class="col-md-3 my-auto">
                            <h3>{{$item->products->name}}</h3>
                        </div>
                        <div class="col-md-2 my-auto ">
                            <h5 >{{number_format($item->products->price)}}VNĐ</h5>
                        </div>
                        <div  class="d-flex justify-content-center col-md-2 my-auto">
                            <input type="hidden" name="" class="prod_id" value="{{$item->prod_id}}">
                            <div class="input-group text-center mb-3" style="width: 120px;margin-top: 18px">
                                <button class="input-group-text minus changeQuantity">-</button>
                                    <input type="text" name="quantily" class="form-control text-center qty-input quantity" value="{{$item->prod_qty}}">
                                <button class="input-group-text plus changeQuantity">+</button>
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <h5 class="ms-5">{{number_format($item->products->price * $item->prod_qty)}} VNĐ</h5>
                        </div>
                        
                        <div class="col-md-2 my-auto d-flex justify-content-center">
                            <button class="btn btn-danger delete-cart-item "><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div> 
                    @php
                        $total += $item->products->price * $item->prod_qty;
                    @endphp                                  
            @endforeach
            @else
                <div class="product_data">
                    <h5>Không có sản phẩm nào</h5>
                </div>
            @endif

        </div>
        <div class="card-footer">
            <h4>Tổng tiền: {{number_format($total)}}VNĐ</h4>
            @if ($total === 0)
                <a href="{{route('products')}}" class="btn btn-outline-primary float-end">Trang sản phẩm</a>
            @else
                <a href="{{route('list')}}" class="btn btn-outline-success float-end">Thanh toán</a>
            @endif
            
        </div>

    </div>
@endsection

@section('js')
    <script>$(document).ready(function () {
        // event increase and decrease in value
            $('.plus').click(function(e){
                e.preventDefault();

                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value,10);
                value = isNaN(value) ? 0 : value;

                if (value < 100) {
                    value++;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }

            });

            $('.minus').click(function(e){
                e.preventDefault();

                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value,10);
                value = isNaN(value) ? 0 : value;

                if (value <= 100) {
                    value--;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
                if(value<1){
                    value = 1;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });
            // delete product in cart
            $('.delete-cart-item').click(function(e){
                e.preventDefault();

                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var urlDelete = "{{route('detele')}}";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: urlDelete,
                    data: {
                    'prod_id': prod_id,

                    },
                    success: function (response) { 
                        swal("", response.status, "success");
                        // window.location.reload();

                        setTimeout(function(){
                            window.location.reload(1);
                        }, 600);
                    
                    }
                });

            });
            $('.changeQuantity').click(function(e){
                e.preventDefault(e);
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var qty = $(this).closest('.product_data').find('.qty-input').val();
                var urlChangeQuantity = '{{route("updateCart")}}' ;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: urlChangeQuantity,
                    data: {
                        'prod_id':prod_id,
                        'prod_qty':qty,
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection