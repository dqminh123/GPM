@foreach ($comments as $item)
    <div class="media">
        <a href="#" class="pull-left">
            <img src="{{ url('public/khachhang') }}/{{ $item->khachhang->anh }}"
                alt="Image" width="60">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $item->khachhang->hovaten }}</h4>
            <p>{{ $item->content }}</p>
            <p>
                @if (Auth::guard('khachhang')->check())
                    <a href="#" class="btn btn-sm btn-primary btn-show-reply-form" data-id="{{ $item->id }}">Trả
                        lời</a>
                @else
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Vui lòng đăng nhập để trả lời
                    </button>
                    <br>
                @endif
            </p>
            <form action="" method="POST" style="display: none" class="formReply form-reply-{{ $item->id }}">
                <div class="form-group">
                    <label for="">Nội dung bình luận</label>

                    <textarea id="content-reply-{{ $item->id }}" class="form-control " rows="3" required="required"
                        placeholder="Nhập nội dung (*)"></textarea>
                </div>
                <button type="submit" data-id="{{ $item->id }}" class="btn btn-primary btn-send-comment-reply">Gửi
                    nội dung trả lời</button>
            </form>
            <hr>
            {{-- Các bình luận con --}}
            @foreach ($item->replies as $child)
                <div class="media">
                    <a href="#" class="pull-left">
                        <img src="{{ url('public/khachhang') }}/{{ $item->khachhang->anh }}"
                            alt="Image" width="60">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $child->khachhang->hovaten }}</h4>
                        <p>{{ $child->content }}</p>
                        
                        @foreach ($child->replies as $child1)
                            <div class="media">
                                <a href="#" class="pull-left">
                                    <img src="{{ url('public/khachhang') }}/{{ $item->khachhang->anh }}"
                                        alt="Image" width="60">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $child1->khachhang->hovaten }}</h4>
                                    <p>{{ $child1->content }}</p>
                                </div>
                            </div>
                        @endforeach
                        @if (Auth::guard('khachhang')->check())
                        <p>
                            <a href="#" class="btn btn-sm btn-primary btn-show-reply-form"
                                data-id="{{ $child->id }}">Trả lời</a>
                        </p>
                        @else
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                            Vui lòng đăng nhập để trả lời
                        </button>
                        <br>
                        @endif
                        <form action="" method="POST" style="display: none"
                            class="formReply form-reply-{{ $child->id }}">
                            <div class="form-group">
                                <label for="">Nội dung bình luận</label>

                                <textarea id="content-reply-{{ $child->id }}" class="form-control " rows="3" required="required"
                                    placeholder="Nhập nội dung (*)"></textarea>
                            </div>
                            <button type="submit" data-id="{{ $child->id }}"
                                class="btn btn-primary btn-send-comment-reply">Gửi nội dung trả lời</button>
                        </form>
                        <hr>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endforeach
