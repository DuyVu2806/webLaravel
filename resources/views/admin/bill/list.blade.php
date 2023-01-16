@extends('layouts.index')

@section('main')
    <div class="card">
        <div class="card-header">
            <h4>Đơn hàng</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">STT</th>
                        <th width="8%">Mã Đơn</th>
                        <th width="10%">Người Đặt</th>
                        <th width="18%">Địa chỉ</th>
                        <th width="12%">Số điện thoại</th>
                        <th width="12%">Tổng số tiền</th>
                        <th>Tình trạng</th>
                        <th>Ngày đặt</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>

                <tbody>
                    @if (!empty($bill))
                        @foreach ($bill as $key => $item)
                        <tr>
                            <th>{{$key+1}}</th>
                            <th>{{$item->stracking_no}}</th>
                            <th>{{$item->name}}</th>
                            <th>{{$item->address}} Tỉnh {{$item->province}}</th>
                            <th>{{$item->phone}}</th>
                            <th>{{number_format($item->total_price)}} VNĐ</th>
                            <th>
                                <h5 class="text-{{nameStatus($item->status)['color']}}">{{nameStatus($item->status)['name']}}</h5>
                            </th>
                            <th>{{$item->created_at}}</th>
                            <th>
                                @if ($item->status === 0 || $item->status === 1)
                                    <a href="{{route('bill.billedit',$item->id)}}" class="btn btn-outline-warning w-100 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
                                        Tình trạng
                                    </a>                                    
                                @endif
                                


                                {{-- Modal --}}
                                <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{route('bill.billedit',$item->id)}}" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thay Đổi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="">Mã Đơn hàng</label>
                                                        <input class="form-control" readonly type="text" value="{{$item->stracking_no}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Tình trạng</label>
                                                        <select name="status" class="form-select" aria-label="Default select example">
                                                            @if ($item->status === 0 || $item->status === 3)
                                                                <option value="0" selected>Đang chuẩn bị hàng</option>
                                                                <option value="1">Đang giao hàng</option>
                                                                <option value="2">Giao hàng thành công</option>
                                                            @endif
                                                            @if ($item->status === 1)
                                                                <option value="1" selected>Đang giao hàng</option>
                                                                <option value="2">Giao hàng thành công</option>
                                                            @endif
                                                        </select>
                                                        @error('status')
                                                        <span style="color: red" >{{$message}}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- End Modal --}}
                                
                                <a href="{{route('bill.billDetail',$item->id)}}" class="btn btn-outline-primary w-100" >Chi tiết</a>

                                @if ($item->status === 3)
                                    <a href="{{route('bill.billDeleted',$item->id)}}" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không ?')" class="btn btn-outline-danger w-100 mt-1"><i class="fa-solid fa-xmark"></i></a>
                                @endif

                            </th>
                        </tr>                        
                        @endforeach
                    @endif


                </tbody>
            </table>
        </div>
    </div>
@endsection