<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ url('assets/img/logo/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#00a2a2">
            <div class="container ">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img style="border-radius: 5px " class="logo" width="90px" height="40px"
                        src="{{ url('assets/img/logo/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">


                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item me-3">
                            <a class="nav-link text-light" href="{{route('home')}}"><i class="fa-solid fa-house"></i>Trang chủ</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link text-light" href="{{route('products')}}"><i class="fa-solid fa-border-all"></i>Sản phẩm</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link text-light" href="{{route('contact')}}"><i class="fa-regular fa-address-book"></i>Liên hệ</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link text-light" href="{{route('about')}}"><i class="fa-solid fa-map-location-dot"></i>Giới thiệu</a>
                        </li>

                    </ul>

                    <form action="{{ route('products') }}" class="d-flex me-4 ">
                        <input class="form-control me-2 " id="search_product" name="keyword" type="search"
                            placeholder="Nhập tên sản phẩm..." aria-label="Search">
                        <button class="btn btn-primary" type="submit">Tìm</button>
                    </form>

                    <ul class="navbar-nav mb-lg-0">
                        <li class="nav-item ms-2 me-3">
                            @if (Auth::guard('cus')->check())
                            @php
                                $fullName = Auth::guard('cus')->user()->name;
                                $arrName = explode(" ", $fullName);
                                $lastName = array_pop($arrName); 
                                $img = Auth::guard('cus')->user()->image;
                            @endphp
                                <div class="dropdown">
                                    <a class="nav-link text-light" onclick="hamDropdown()" class="nut_dropdown">
                                        @if ($img == null)
                                            <span ><img style="border-radius: 50%;border: solid 1px"  width="30px" height="30px" src="{{ url('assets/img/logo/avatarclassic.png') }}" alt=""></span>
                                        @else
                                            <span ><img style="border-radius: 50%;border: solid 1px"  width="30px" height="30px" src="{{ url('assets/img/avatar/'.$img) }}" alt=""></span>
                                        @endif
                                        {{$lastName}}</a>
                                    <div class="noidung_dropdown">
                                        <a class="nav-link" href="{{route('customer.profile')}}">Thông tin cá nhân</a>
                                        <a class="nav-link" href="{{route('myOrder')}}">Đơn hàng
                                            <span class="text-primary ms-2" >
                                                {{CountMyOrder(Auth::guard('cus')->user()->id)}}
                                            </span>
                                        </a>
                                        <a class="nav-link" href="{{route('customer.logout')}}">Đăng xuất</a>
                                    </div>
                                  </div>
                            @else
                                <a class="nav-link text-light" href="{{route('customer.login')}}"><i class="fa-regular fa-user"></i>Đăng Nhập</a>
                            @endif
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light position-relative" href="{{route('viewCart')}}"><i class="fa-brands fa-opencart"></i>
                                Giỏ hàng
                                <span style="position: absolute;top: 0;right: -15%; 
                                border: solid 1px #788086; padding: 0 7px;border-radius: 50%" 
                                class="text-light card-count">
                                @if (Auth::guard('cus')->user() == null)
                                    0
                                @else
                                    {{Countcart(Auth::guard('cus')->user()->id)}}
                                @endif
                            </span>
                            </a>
                        </li>
                    </ul>


                </div>
            </div>
        </nav>




    </header>

    <div class="position-fixed " style="top: 70%; left: 95%;">
        <a style="font-size: 60px" href=""><i class="fa-brands fa-facebook-messenger"></i></a>
    </div>

    <div class="position-fixed " style="top: 90%; left: 96%;">
        <a style="font-size: 45px;color: #fb3131c3" href="#"><i class="fa-solid fa-circle-arrow-up"></i></a>
    </div>

    
    <main class="container ">
        @yield('content')
    </main>
    @include('blocks.footer')
    @yield('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>

    <script>
        function hamDropdown() {
            document.querySelector(".noidung_dropdown").classList.toggle("hienThi");
        }
    </script>

    <script>
        $(function() {
            var urlSearch = '{{ route('productListAjax') }}'
            var availableTags = [];
            $.ajax({
                type: "GET",
                url: urlSearch,
                success: function(data) {
                    startAutoCompelete(data)
                }
            });

            function startAutoCompelete(availableTags) {
                $("#search_product").autocomplete({
                    source: availableTags
                });
            }


        });
    </script>

</body>

</html>
