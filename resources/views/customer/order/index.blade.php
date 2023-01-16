@extends('layouts.home')

@section('content')
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Đơn hàng</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng số tiền</th>
                                <th>Trạng thái</th>
                                <th width="25%">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (CountMyOrder(Auth::guard('cus')->user()->id)!=0)
                                @foreach ($orders as $item)
                                @if ($item->status != 3)
                                    <tr>
                                        <td>{{$item->stracking_no}}</td>
                                        <td>{{number_format($item->total_price)}} VNĐ</td>
                                        <td>
                                            {{nameStatus($item->status)['name']}}
                                        </td>
                                        <td>
                                            <a href="{{route('viewOrder',$item->id)}}" class="btn btn-outline-primary">Xem chi tiết</a>
                                            @if ($item->status === 0 )
                                                <a href="{{route('remove',$item->id)}}" class="btn btn-outline-danger" 
                                                onclick="return confirm('Bạn có chắc muốn hủy đơn hàng {{$item->stracking_no}} không ?')">Hủy đơn hàng</a>

                                            @endif
                                        </td>
                                    </tr>                                    
                                @endif


                                @endforeach
                            @else
                            <tr>
                                <td colspan="3">Chưa có hóa đơn nào</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection