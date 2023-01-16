@extends('layouts.home')

@section('content')
@include('blocks.shortcut')
<div class="row">
    <div class="col-6">
        <h3>Liên Hệ</h3>
        <h4>Mọi Chi tiết xin liên hệ chúng tôi</h4>
        <hr>
        <form action="">

            <div class="row mb-3">
                <div class="col-6">
                    <label for="">Họ tên</label>
                    <input  class="form-control" type="text">
                </div>
                <div class="col-6">
                    <label for="">Số Điện thoại</label>
                    <input  class="form-control" type="number">
                </div>
            </div>

            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" class="form-control" >
            </div>

            <div class="mb-3">
                <label for="">Nội Dung</label>
                <textarea name="" id="" cols="30" rows="8" class="form-control"></textarea>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Gửi</button>
            </div>
        </form>
    </div>

    <div class="col-6">
        <div class="mb-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15715.73357121595!2d105.77034015000001!3d10.0223554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1666801400891!5m2!1svi!2s" width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div>
            <div class="mb-5">
                <h3>Địa chỉ</h3>
                <p>Đại học cần thơ Khu 2 quận Ninh Kiều Thành Phố Cần Thơ</p>
                <p>Email:Nguyenhuyduyvu@gmail.com</p>
                <p>Website:www.</p>    
            </div>
            
            <div>
                <h6><strong>Giờ mở cửa</strong></h6>
                <p>Thứ 2 - Thứ 7: 9h30 - 20h30</p>
                <p>Chủ nhật: 9h30 - 17h30</p>
            </div>
        </div>
        

    </div>
</div>
    
@endsection