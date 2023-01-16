@extends('layouts.index')

@section('main')
<div class="container">
   <h3>Danh mục</h3>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>        
    @endif

    @if (session('deleted'))
        <div class="alert alert-danger">{{session('deleted')}}</div>        
    @endif

   <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary " href="{{route('category.add')}}">Thêm loại</a>
   </div>
    
   <table class="table table-bordered"> 
    <thead>
        <tr class="table-secondary">
            <th style="width: 5%; text-align: center">STT</th>
            <th style="width: 5%; text-align: center">Id</th>
            <th>Tên</th>
            <th>Trạng thái</th>
            <th colspan="2"  style="text-align: center; width: 10%">Hành Động</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($listCategory as $key => $item)
            <tr >
                <td style="text-align: center">{{$key+1}}</td>
                <td style="text-align: center">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->status}}</td>
                <td><a href="{{route('category.edit',$item['id'])}}" class="btn btn-warning">Sửa</a></td>
                <td><a onclick="return confirm('Khi xóa loại sản phẩm này thì tất cả sản phẩm của loại này sẽ bị xóa bạn có muốn không ?')" href="{{route('category.delete',$item['id'])}}" class="btn btn-danger">Xóa</a></td>
            </tr>
        @endforeach
    </tbody>
   </table>
</div>
@endsection