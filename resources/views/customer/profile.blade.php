@extends('layouts.home')

@section('content')
    <div style="margin-top: 75px">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row ">
                <div class="col-3 position-relative">
                    @if ($customer->image == null)
                        <img class="mt-2" width="100%" src="{{ url('assets/img/logo/avatarclassic.png') }}" alt="">
                        <h4 style="color: red;text-align: center">Chưa có avatar</h4>
                    @else
                        <img class="mt-2" width="100%" src="{{ url('assets/img/avatar/'.$customer->image) }}" alt="">
                    @endif
                    
                    <div class="file-upload">
                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" />
                            <div class="drag-text">
                            <h3>Thêm avatar</h3>
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">Xóa </button>
                            </div>
                        </div>                        

                    </div>
                </div>
                <div class="col-9">
                    <h1 style="text-align: center" class="display-5 ">{{ $title }}</h1>
                    <div>
                        <div class="mb-3 row">
                            <div class="col-2">
                                <label for="">Tên Khách Hàng:</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control" type="text" name="name" value="{{ $customer->name }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-2">
                                <label for="">Email:</label>
                            </div>
                            <div class="col-10">
                                <fieldset disabled>
                                    <input class="form-control disabled" type="text" name="email"
                                        value="{{ $customer->email }}">
                                </fieldset>

                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-2">
                                <label for="">Số Điện Thoại</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control" type="text" name="phone" value="{{ $customer->phone }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-2">
                                <label for="">Địa chỉ:</label>
                            </div>
                            <div class="col-10">
                                <textarea class="form-control" name="address" id="" cols="30" rows="6" name="address"
                                    value="{{ $customer->address }}">{{ $customer->address }}</textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                </div>
            </div>
        </form>        
    </div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
            $('.image-upload-wrap').hide();

            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();

            $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }

</script>
    
@endsection


