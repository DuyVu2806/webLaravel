@foreach ($comments as $comm)
@php
    $img = Auth::guard('cus')->user()->image;
@endphp
    <div class="">
        @if ($comm->reply_id == 0)
        <div class="d-flex">
            <!-- Image -->
            @if ($img == null)
                <img
                src="{{ url('assets/img/logo/avatarclassic.png') }}"
                class="me-3 mt-2 rounded-circle "
                style="width: 65px; height: 65px; border: solid 1px"
                />
            @else
                <img
                src="{{ url('assets/img/avatar/'.$comm->cus->image) }}"
                class="me-3 mt-2 rounded-circle "
                style="width: 65px; height: 65px; border: solid 1px"
                />
            @endif
            
            <!-- Body -->
            <div class="form-control">
                <h5 class="fw-bold">
                    {{$comm->cus->name}}
                </h5>
                <p>
                    {{$comm->content}}
                </p>
            </div>
        </div>
        <div class="mt-2" style="margin-left: 80px">
            @if (Auth::guard('cus')->check())
                <button class="btn btn-info btn-show-reply-form mb-2" data-id="{{$comm->id}}">Trả lời</button>
            @else
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Vui lòng đăng nhập
                </button>
            @endif
        </div>

        <form action="" method="POST" style="display: none" class="formReply form-reply-{{$comm->id}}">
            <div class="form-group mb-3">
                <label for="">Nội dung bình luận</label>
                <textarea id="content-reply-{{$comm->id}}" class="form-control" rows="3"
                placeholder="Nhập nội dung"></textarea>
                
            </div>
            <div class="mb-3">
                <button type="submit" data-id="{{$comm->id}}" class="btn btn-primary btn-send-comment-reply" >
                    Bình Luận
                </button>
            </div>
            
        </form>
        @endif
    </div>
    <!--Bình Luận Con-->
    @foreach ($comm->replies as $child)
        <div class="container mb-4" style="padding: 0 0 0 10%">
            <div class="d-flex">
                <!-- Image -->
                <img src="{{ url('assets/img/avatar/'.$child->cus->image) }}"
                class="me-3 mt-2 rounded-circle"
                style="width: 60px; height: 60px;border: solid 1px"
                />
                <!-- Body -->
                <div class="form-control">
                    <h5 class="fw-bold">{{$child->cus->name}}</h5>
                    <p>{{$child->content}}</p>
                </div>
            </div>
        </div>
        
    @endforeach                 
@endforeach



