@extends('layouts.index')

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="d-flex justify-content-center">Bình luận</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="fw-bold">
                        <th>STT</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($count != 0)
                        @foreach ($comm as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->cust->name}}</td>
                            <td>{{$item->prod->name}}</td>
                            <td>{{$item->content}}</td>
                            <td>{{($item->created_at)}}</td>
                        </tr>                        
                        @endforeach  
                    @else
                        <tr>
                            <td colspan="5">Không có bình luận nào</td>
                        </tr>  
                    @endif
                    

                </tbody>
            </table>            
        </div>
    </div>

@endsection