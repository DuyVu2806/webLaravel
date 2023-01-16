@extends('layouts.index')

@section('main')
<h1 class="display-5 text-center">{{$title}}</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" style="margin: 40px 25%">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                    @error('name')
                        <span style="color: red" >{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label  for="">Nhóm sản phẩm</label>
                    <select name="category_id" class="form-select">
                        <option selected value="a">--Chọn--</option>
                        @if (!empty($listCategory))
                            @foreach ($listCategory as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('category_id')
                        <span style="color: red" >{{$message}}</span>
                    @enderror
                </div>
               
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá Sản phẩm</label>
                    <input class="form-control" type="number" name="price" value="{{old('price')}}">
                    @error('price')
                        <span style="color: red" >{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label  for="">Trạng thái</label>
                    <input class="form-control" readonly type="number" name="status" value="0">
                    @error('status')
                        <span style="color: red" >{{$message}}</span>
                    @enderror
                </div>
                
            </div>

            <div class="mb-3">
                <label  for="">Hình Ảnh</label>
                <input class="form-control" type="file" name="image" value="{{old('image')}}">
                @error('image')
                    <span style="color: red" >{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label  for="">Mô tả</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{old('description')}}</textarea>
                @error('description')
                    <span style="color: red" >{{$message}}</span> 
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-20 me-2">Thêm Sản phẩm</button>
                <a href="{{route('products.list')}}" class="btn btn-info w-20 ">Quay lại</a>
            </div>
            
        </div>

    </form>
@endsection