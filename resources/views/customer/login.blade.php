@extends('layouts.home')

@section('content')
    <div class="container">
        <div style=" margin: 70px 30% ">
            <form  method="POST" role="form">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary">
                        <legend class="text-center text-light">Đăng nhập</legend>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                            @error('email')
                                <span style="color: red" >{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                                <span style="color: red" >{{$message}}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="col-6">
                                <p><a class="text-decoration-none" href="{{route('customer.register')}}">Đăng ký tài khoản</a></p>
                            </div>                            
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="float-end btn btn-outline-primary">Đăng nhập</button>                      
                    </div>
                </div>
                



                
            </form>
        </div>
        
    </div>
@endsection