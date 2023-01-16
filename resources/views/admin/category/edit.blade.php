@extends('layouts.index')

@section('main')
<div class="container">
    <h1 class="display-5 text-center">{{$title}}</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="margin: 70px 25%">
            <div class="mb-3">
                <div class="row">
                    <div class="col-3">
                        <label class="col-form-label">Tên loại sản phẩm:</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" name="name" value="{{$listCategory->name}}">
                    </div>
                </div>
                @error('name')
                    <span style="color: red; margin-left: 25.5%" >{{$message}}</span>
                @enderror
            </div>
            
            <div class="mb-3">
                <div class="row">
                    <div class="col-3">
                        <label class="col-form-label">Trạng thái:</label>
                    </div>
                    <div class="col-9">
                        <input type="number" class="form-control" name="status" value="{{$listCategory->status}}">
                    </div>
                </div>
                @error('status')
                    <span style="color: red; margin-left: 25.5%" >{{$message}}</span>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1">Xác Nhận</button>
                <a href="{{route('category.list')}}" class="btn btn-info ">Quay lại</a>
            </div>
            
        </div>
    </form>
</div>
@endsection