@extends('layouts.index')

@section('main')
<div class="container">
    <h1 class="display-5 text-center">{{$title}}</h1>
    <a href="{{route('products.add')}}" class="btn btn-primary mb-4">Thêm sản phẩm</a>
    <div class="mb-3 d-flex justify-content-end">
        <form action="{{route('products.list')}}">
            <div class="row">
                <div class="col-auto">
                    <select name="keyCate" class="form-select" aria-label="Default select example">
                        <option  value="0" selected>--Chọn Loại--</option>
                        @foreach ($listCategory as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <input name="keyword" class="form-control" type="text" placeholder="Tìm kiếm tên sản phẩm">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Tìm kiếm</button>
                </div>
            </div>
            
        </form>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr class="table-secondary" style="text-align: center">
                <th style="width: 5%;">STT</th>
                <th style="width: 15%">Tên sản phẩm</th>
                <th style="width: 70px">Hình ảnh</th>
                <th style="width: 10%">Loại</th>
                <th>Giá</th>
                <th>Trạng thái </th>
                <th style="width: 25%">Mô tả</th>
                <th style="width: 13%">Thời gian</th>
                <th colspan="2" style="width: 10%;">Thao tác</th>
                
            </tr>
        </thead>
    
        <tbody>
            @if ($count == 0)
                <tr>
                    <td colspan="10">Không có sản phẩm nào</td>
                </tr>
            @else
                @foreach ($listProducts as $key => $item)
                <tr  style="height: 70px">
                    <td style="text-align: center">{{$key+1}}</td>
                    <td>{{$item->name}}</td>
                    <td><img src="{{ url('assets/img/' .$item->image) }}" width="70px" height="70px"></td>
                    <td>{{$item->cate->name}}</td>
                    <td>{{number_format($item->price)}}Đ</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->created_at}}</td>
                    <td><a class="btn btn-warning" href="{{route('products.edit',$item['id'])}}">Sửa</a></td>
                    <td ><a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không ?')" class="btn btn-danger" href="{{route('products.delete', $item['id'])}}">Xóa</a></td>
                </tr>
                @endforeach                
            @endif

        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{$listProducts->links()}}
    </div>
</div>

    
@endsection