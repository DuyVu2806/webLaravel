@extends('layouts.index')

@section('main')
    <div class="container">
        <h2 class="text-center text-uppercase mb-2 mt-2">{{$title}}</h2>
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary">
                    <th>STT</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Avatar</th>
                    <th>Ngày Lập</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($listCustomer))
                    @foreach ($listCustomer as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->address}}</td>
                            <td >
                                @if ($item->image == null)
                                    Chưa có avatar
                                @else
                                    <img width="50px" height="50px" src="{{url('assets/img/avatar/'.$item->image)}}" alt="">
                                @endif
                                
                            </td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                @else
                    
                @endif
            </tbody>
        </table>
    </div>
@endsection