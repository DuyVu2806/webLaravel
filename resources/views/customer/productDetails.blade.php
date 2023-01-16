@extends('layouts.home')

@section('content')
<div  class="mb-4 ms-3 pt-2">
    <label><a class="text-uppercase" style="color: #000;text-decoration: none" href="{{route('home')}}">Trang Chủ </a></label>
    <label for="">-></label>
    <label ><a class="text-uppercase" style="color: #000;text-decoration: none" href="{{route('products')}}">Sản phẩm</a></label>
    <label for="">-></label>
    <label ><a class="text-uppercase" style="color: #000;text-decoration: none" href="#">{{$title}}</a></label>
</div>

    @if (!empty($productdetails))
        <div class="row product_data" style="margin-bottom: 100px">
            <div class=" col-5" >
                <div class="card" >
                    <img width="500px" height="500px" src="{{ url('assets/img/'.$productdetails->image) }}" alt="">
                </div>
            </div>
            <div class="card col-4" >
                @foreach ($category as $item)
                    @if ($productdetails->category_id == $item->id)
                        <h6 style="color: #9EA4A9" class="mb-4 mt-1">{{$item->name}}</h6>
                    @endif
                @endforeach
                
                <h5 class="text-uppercase">{{$productdetails->name}}</h5>
                <label for=""><strong>Tên Sản Phẩm: </strong>{{$productdetails->name}}</label><br>
                <div class="ms-4 mt-2">
                    <label for=""><strong>Mô tả sản phẩm: </strong></label><br>
                    <p>{{$productdetails->description}}</p>
                </div>
                
            </div>
            <div class="col-3"  >
                <div class="card position-relative" style=" padding: 0 0 160px;">
                    <div class="" style="text-align: center; margin-top: 50px">
                        <h3>Giá Tiền</h3>
                        <h1 style="color: #BF081F">{{number_format($productdetails->price)}}đ</h1>
                    </div>
                    
                    <div class="position-absolute" style="left: 30% ; top: 58%">
                        {{-- <label for="">Số Lượng </label>
                        <input class="form-control" type="number" min="1" value="1" name="number"> --}}
                        <input type="hidden" name="" value="{{$productdetails->id}}" class="prod_id">
                        <div class="input-group text-center" style="width: 130px">
                            <button class="input-group-text minus">-</button>
                                <input type="text" name="quantily" class="form-control text-center qty-input quantity" value="1">
                            <button class="input-group-text plus">+</button>
                        </div>
                    </div>

                    <div class="position-absolute" style="left: 15% ; top: 80%">
                        <button style="padding: 6px 50px; font-size: 20px" 
                        class="btn btn-info addToCartBtn" ><i class="fa-solid fa-cart-arrow-down"></i> Đặt Hàng</button>
                    </div>
                    
                </div>
                <div style="margin-top: 5%">
                    <p><strong>Địa chỉ: </strong> Đại học cần thơ Khu 2 quận Ninh Kiều Thành Phố Cần Thơ</p>
                    <p><strong>Thời gian: </strong>Thứ 2 - Thứ 7: 9h30 - 20h30</p>
                    <p><Strong>Hotline: 0984 xxx xxx</Strong> </p>
                </div>
            </div>
        </div>

        {{-- comment --}}
        <div class="container">
            <h3>Bình luận sản phẩm này:</h3>
            @if (Auth::guard('cus')->check())
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label for="">Nội dung bình luận</label>
                        <input type="hidden" name="product_id" value="{{$productdetails->id}}">
                        <textarea id="comment_content" id="" rows="3" class="form-control"  placeholder="Nhập nội dung"></textarea>
                        <small style="color: red" id="comment_error" class="help-blog"></small>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" id="btn-comment">Bình luận</button>
                    </div>
                </form>
            @else
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Vui lòng đăng nhập
                </button>
            @endif

            <h3 class="mt-3">Các bình luận</h3>

            <div class="" id="comment">
                @include('customer.listComment', ['comments' => $productdetails->comments])
            </div>

        </div>
    @endif
    

  
  <!-- Modal login-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đăng Nhập Ngay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error">

                    </div>
                    <form action="" method="POST" role="form">
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Mật khẩu</label>
                            <input type="password" id="password" class="form-control">
                        </div>
                        
                        <div class="mb-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="btn-login">Đăng Nhập</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
   

@endsection 

@section('js')
    <script>
        var _csrf = '{{csrf_token()}}';
        let _commentUrl = '{{route("ajax.comment", $productdetails->id)}}';
            /*Login to comment*/
            $('#btn-login').click(function(e){
                e.preventDefault();
                
                var _loginUrl = '{{route("ajax.login")}}';
                var email = $('#email').val();
                var password = $('#password').val();
                
                $.ajax({
                    url: _loginUrl,
                    type: 'POST',
                    data:{
                        email: email,
                        password: password,
                        _token: _csrf
                    },
                    success:function(res){
                        console.log(res)
                        if(res.error){
                            let html_error = '<div class="alert alert-danger">'
                            for(let error of res.error){
                                html_error += `
                                <li>${error}</li>`
                            }
                            html_error += '</div>'

                            $('#error').html(html_error);
                        }
                        else{
                            alert('Đăng nhập thành công');
                            location.reload();
                        }
                    }
                });
            });
            /*show comment and comment*/
            $('#btn-comment').click(function(ex){
                ex.preventDefault();
                let content = $('#comment_content').val();

                $.ajax({
                    url: _commentUrl,
                    type: 'POST',
                    data:{
                        content: content,
                        _token: _csrf
                    },
                    success:function(res){
                        if(res.error){
                            $('#comment_error').html(res.error)
                        }
                        else{
                            $('#comment_error').html('');
                            $('#comment_content').val('');
                            $('#comment').html(res);
                            
                        }
                    }
                });

            });

            $(document).on('click','.btn-show-reply-form',function(ev){
                ev.preventDefault();
                var id = $(this).data('id');
                var comment_reply_id = '#content-reply-'+ id;
                let contentReply = $(comment_reply_id).val();
                var form_reply = '.form-reply-'+ id;
                $('.formReply').slideUp();
                $(form_reply).slideDown()
            })
            /**/
            $(document).on('click','.btn-send-comment-reply',function(ev){
                ev.preventDefault();
                var id = $(this).data('id');
                var comment_reply_id = '#content-reply-'+ id;
                let contentReply = $(comment_reply_id).val();
                var form_reply = '.form-reply-'+ id;
                $.ajax({
                    url: _commentUrl,
                    type: 'POST',
                    data:{
                        content: contentReply,
                        reply_id: id,
                        _token: _csrf
                    },
                    success:function(res){
                        if(res.error){
                            $('#comment_error').html(res.error)
                        }
                        else{
                            $('#comment_error').html('');
                            $('#comment_content').val('');
                            $('#comment').html(res);
                            
                        }
                    }
                });
            })
    </script>


    <script>
        //event add to Cart
        $('.addToCartBtn').click(function(e){
            e.preventDefault();
            let urlCart = '{{route("add")}}';
            var product_id  = $(this).closest('.product_data').find('.prod_id').val();
            var product_qty  = $(this).closest('.product_data').find('.qty-input').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: urlCart,
                data: {
                    'product_id': product_id,
                    'product_qty': product_qty
                },
                success: function (response) {
                    swal(response.status);
                    setTimeout(function(){
                            window.location.reload(1);
                    }, 800);
                }
            });
        });

        $(document).ready(function () {
        // event increase and decrease in value
            $('.plus').click(function(e){
                e.preventDefault();

                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value,10);
                value = isNaN(value) ? 0 : value;

                if (value < 10) {
                    value++;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }

            });

            $('.minus').click(function(e){
                e.preventDefault();

                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value,10);
                value = isNaN(value) ? 0 : value;

                if (value <= 10) {
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

                console.log(urlDelete);

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
                    success: function (data) {
                        swal("", response.status, "success");
                    }
                });

            });

        });
    </script>
@endsection
