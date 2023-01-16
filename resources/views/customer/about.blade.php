@extends('layouts.home')

@section('content')
    <div class="card shadow mt-5">
        <div class="card-header">
        Thông báo
        </div>
        <div class="card-body">
        <p class="card-text fs-3">Trang hiện đang được phát triển</p>
        <a href="{{route('home')}}" class="btn btn-primary">Quay về trang chủ</a>
        </div>
    </div>
@endsection