@extends('layouts.home')

@section('content')
    <div class="container">
        @if ($errors->all())
            
        @endif
        <div style=" margin: 40px 30% ">
            <form  method="POST" role="form">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <legend class="text-center">Đăng ký</legend>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" >
                            @error('name')
                                <span style="color: red" >{{$message}}</span>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                            @error('email')
                                <span style="color: red" >{{$message}}</span>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="number" class="form-control" name="phone" value="{{old('phone')}}">
                            @error('phone')
                                <span style="color: red" >{{$message}}</span>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" >
                            @error('password')
                                <span style="color: red" >{{$message}}</span>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="confirm_password">
                            @error('confirm_password')
                                <span style="color: red" >{{$message}}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <p><a class="text-decoration-none" href="{{route('customer.login')}}">Quay về trang đăng nhập</a></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="float-end btn btn-outline-primary">Đăng ký</button>
                    </div>
                </div>
                
            </form>
        </div>
        
    </div>
@endsection