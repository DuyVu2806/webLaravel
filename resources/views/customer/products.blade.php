@extends('layouts.home')

@section('content')
@include('blocks.shortcut')
<div class="row">
     <div class="col-3" >
        <h3>Tìm kiếm</h3><hr>
        <form action="{{route('products')}}" method="get">
            <div class="mb-4">
                <h4>Giá Tiền</h4>
                <div>
                    <input type="checkbox" name="price1">
                    <label for="">Dưới 500.000đ</label>
                </div>

                <div>
                    <input type="checkbox" name="price2">
                    <label for="">Từ 500.000đ đến 2.000.000đ</label>
                </div>

                <div>
                    <input type="checkbox" name="price3">
                    <label for="">Từ 2.000.000đ đến 5.000.000đ</label>
                </div>

                <div>
                    <input type="checkbox" name="price4">
                    <label for="">Trên 5.000.000đ</label>
                </div>
            </div>
            <div>
                <hr>
                <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
            </div>            
        </form>

    </div>
    <div class="col-9">
        <h2>
            @if ($key == null)
                Tất cả sản phẩm:
            @else
                Sản phẩm liên quan đến:{{$key}}
            @endif
        </h2>
        <hr>
        <div class="row product_data">
            @if ($count != 0)
                @foreach ($listProducts as $item)
                <div class="col-4 mb-5">
                    <div class="d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            {{-- <a href="{{route('productDetails',$item->id)}}"><img class="card-img-top" width="268px" height="268px" src="{{ url('assets/img/' .$item->image) }}" alt=""></a> --}}
                            <div class="">
                                <a href="{{ route('productDetails', $item->id) }}" class="hover-2">
                                    <img class="card-img-top" width="100%" height="268px"
                                        src="{{ url('assets/img/' . $item->image) }}" alt="">
                                    <div class="hover-overlay"></div>
                                    <div class="hover-2-content px-5">
                                        <p class="hover-2-description text-uppercase mb-0 text-light">Xem chi tiết</p>
                                        
                                    </div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <h6 class="card-text">{{number_format($item->price)}} VNĐ</h6>
                                @if (!empty($listCategory))
                                        @foreach ($listCategory as $as)
                                            @if ($as->id == $item->category_id)
                                                <label class="mb-2" for="">{{$as->name}}</label><br>
                                            @endif  
                                            
                                        @endforeach
                                @endif
                                <a href="#" data-toggle="tooltip" title="Thêm vào giỏ hàng" data-placement="right"
                                data-id="{{$item->id}}" class="cartBtn addToCartBtn">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </a>
                            </div>                         
                        </div>                        
                    </div>
                </div>
                @endforeach
            @else
            <h3>Không có sản phẩm nào</h3> 
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{$listProducts->links()}}
        </div>
    </div>

</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
        $('.addToCartBtn').click(function(e){
            e.preventDefault();
            let urlCart = '{{route("add")}}';
            var product_id  = $(this).data('id');
            var product_qty  = 1;

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
                    // swal(response.status);
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.status,
                    showConfirmButton: false,
                    timer: 800                   
                    })
                    setTimeout(function(){
                            window.location.reload(1);
                    }, 800);
                }
            });
        });


</script>

<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@endsection