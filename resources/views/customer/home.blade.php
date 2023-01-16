@extends('layouts.home')

@section('content')
    @include('blocks.slideshow')
    <div class="mt-3">
        <h2 class="mb-3">Sản phẩm mới nhất</h2>
        <div class="row d-flex justify-content-center product_data">
            @if (!empty($listProducts))
                @foreach ($listProducts as $item)
                    <div class="col-3 mb-5">
                        <div class="d-flex justify-content-center">
                            <div class="card" style="width: 18rem;">
                                
                                <div class="mb-2">
                                    <a href="{{ route('productDetails', $item->id) }}" class="hover-2">
                                        <img class="card-img-top" width="100%" height="268px"
                                            src="{{ url('assets/img/' . $item->image) }}" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="hover-2-content px-5">
                                            <p class="hover-2-description text-uppercase mb-0 text-info">Xem chi tiết</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #000000">{{ $item->name }}</h5>
                                    <h6 class="card-text">{{ number_format($item->price) }} VNĐ</h6>
                                    <input type="hidden" name="" value="{{ $item->id }}" class="prod_id">
                                    <input type="hidden" class="qty-input" value="1">
                                    @if (!empty($listCategory))
                                        @foreach ($listCategory as $as)
                                            @if ($as->id == $item->category_id)
                                                <label class="mb-2" for="">{{ $as->name }}</label><br>
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
            @endif

        </div>
    </div>

    <div>
        <h2 class="mb-3">Sản phẩm bán chạy nhất</h2>
        <div class="row d-flex justify-content-center product_data">
            @if (!empty($listProducts2))
                @foreach ($listProducts2 as $item)
                <div class="col-3 mb-5">
                    <div class="d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <div class="mb-2">
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
                                <h5 class="card-title" style="color: #000000">{{ $item->name }}</h5>
                                <h6 class="card-text">{{ number_format($item->price) }} VNĐ</h6>
                                <input type="hidden" name="" value="{{ $item->id }}" class="prod_id">
                                <input type="hidden" class="qty-input" value="1">
                                @if (!empty($listCategory))
                                    @foreach ($listCategory as $as)
                                        @if ($as->id == $item->category_id)
                                            <label class="mb-2" for="">{{ $as->name }}</label><br>
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
             @endif
        </div>
    </div>
{{-- Blog --}}
    <div>
        <h1 class="mb-4">Blog</h1>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img src="https://cdn.tuoitre.vn/zoom/212_132/2022/11/4/sgk-moi-1-16675240054552586592-crop-16675241853901320468354.jpg"
                        alt="">
                    <label class="mt-2" style="color:#000; height: 60px" for="">Nhà nước định giá sách giáo khoa
                        là hợp lý</label>
                    <div class="mt-3" style="color:#808080;height: 150px">
                        <p>Dù giá trị không nhiều nhưng sách giáo khoa là mặt hàng đặc biệt với đối tượng phục vụ, tác động
                            rất đông đảo, rộng rãi. Đồng thời, liên quan nhiều thành phần, gia đình trong xã hội.</p>
                    </div>

                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <img src="https://cdn.tuoitre.vn/zoom/212_132/2022/11/4/t62a9852-16675435041951012365028-crop-16675439865511287053748.jpg"
                        alt="">
                    <label class="mt-2" style="color:#000; height: 60px" for="">Khai quật khu đất 4.000m2, nơi
                        Công ty Sài Gòn Group xả bậy chất thải hầm cầu</label>
                    <div class="mt-3" style="color:#808080;height: 150px">
                        <p>Liên quan đến thông tin trong loạt bài điều tra của Tuổi Trẻ 'từ dán quảng cáo bậy đến lừa hút
                            hầm cầu', cơ quan chức năng đang khai quật khu đất nơi Công ty Sài Gòn Group xả bậy chất thải
                            hầm cầu để có cơ sở xử lý.</p>
                    </div>

                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <img src="https://cdn.tuoitre.vn/zoom/212_132/2022/11/4/giao-luu-bussi-7-166753885510217036326-crop-16675388675311090327657.jpg"
                        alt="">
                    <label class="mt-2" style="color:#000; height: 60px" for="">Michel Bussi và phương pháp phê
                        bình trinh thám trong ‘Mã 612: Ai đã giết Hoàng tử bé?’</label>
                    <div class="mt-3" style="color:#808080;height: 150px">
                        <p>Nhà văn Pháp Michel Bussi đã sử dụng phương pháp phê bình trinh thám để viết cuốn Mã 612: Ai đã
                            giết Hoàng tử bé?, mà theo dịch giả Bảo Chân, thể loại này còn ít thấy ở thị trường xuất bản
                            Việt Nam và cũng là lần đầu tiên tác giả sử dụng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener("load", () => {
            document.querySelector("")
        })
    </script>
{{-- add to card --}}
    <script>
        $('.addToCartBtn').click(function(e) {
            e.preventDefault();
            let urlCart = '{{ route('add') }}';
            var product_id = $(this).data('id');
            var product_qty = 1;

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
                success: function(response) {
                    swal(response.status);
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 800);
                }
            });
        });
    </script>
{{-- toollip --}}
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

@endsection
