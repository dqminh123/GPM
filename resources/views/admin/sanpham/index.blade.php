@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('main')
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add">
        Thêm
    </button>


    <div class="card-body" id="show_all_sp">
        {{-- <table class="table table-bordered" style="color: black" id="sanphamtbl">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Xuất xứ</th>
                    <th scope="col">Nhà cung cấp</th>
                    <th scope="col">Bảo Hành</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giảm giá</th>
                    <th scope="col">Giá nhập</th>
                    <th scope="col">Giá xuất</th>
                    <th scope="col">Ảnh</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table> --}}

    </div>

    {{-- <div class="modal fade" id="modal-dle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <ul id="DLthongbaoloi"></ul>
                <div class="modal-body">
                    <h4>Bạn có chắc muốn xóa không ?</h4>
                    <input type="hidden" id="id-dle">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_sp">Đồng ý</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateSPForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                        <ul id="UDthongbaoloi"></ul>

                        <input type="hidden" id="id" />
                        <div class="form-group mb-3">
                            <label for="tensp" class="form-label">Nhập tên sản phẩm</label>
                            <input name="tensp" type="text" class="form-control " id="tensp1" aria-describedby="tensp">
                        </div>
                        <div class="form-group">
                            <label for="xuatxu_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="xuatxu_id1" class="form-control custom-select" name="xuatxu_id">
                                <option value="">-- Chọn xuất xứ --</option>
                                @foreach ($xx as $value)
                                    <option value="{{ $value->id }}">{{ $value->tenxuatxu }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="nhacungcap_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="nhacungcap_id1" class="form-control custom-select " name="nhacungcap_id">
                                <option value="">-- Chọn nhà cung cấp --</option>
                                @foreach ($ncc as $value)
                                    <option value="{{ $value->id }}">{{ $value->nhacungcap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="danhmuc_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="danhmuc_id1" class="form-control custom-select " name="danhmuc_id">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($dm as $value)
                                    <option value="{{ $value->id }}">{{ $value->tendanhmuc }}</option>
                                @endforeach
                            </select>



                        </div>
                        <div class="form-group">
                            <label for="baohanh_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="baohanh_id1" class="form-control custom-select " name="baohanh_id">
                                <option value="">-- Chọn bảo hành --</option>
                                @foreach ($bh as $value)
                                    <option value="{{ $value->id }}">{{ $value->baohanh }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="soluong">Số lượng <span class="text-danger font-weight-bold">*</span></label>
                            <input id="soluong1" type="number" min="0" class="form-control " name="soluong" />
                            {{ $errors->first('soluong') }}
                        </div>
                        <div class="form-group">
                            <label for="giamgia">Giảm giá <span class="text-danger font-weight-bold">*</span></label>
                            <input id="giamgia1" type="number" min="0" class="form-control " name="giamgia" />
                            {{ $errors->first('soluong') }}
                        </div>

                        <div class="form-group">
                            <label for="gianhap">Giá nhập <span class="text-danger font-weight-bold">*</span></label>
                            <input id="gianhap1" type="number" min="0" class="form-control " name="gianhap"
                                value="{{ old('gianhap') }}" />
                            {{ $errors->first('gianhap') }}
                        </div>

                        <div class="form-group">
                            <label for="giaxuat">Giá xuất <span class="text-danger font-weight-bold">*</span></label>
                            <input id="giaxuat1" type="number" min="0" class="form-control " name="giaxuat"
                                value="{{ old('giaxuat') }}" />
                            {{ $errors->first('giaxuat') }}
                        </div>

                        <div class="mb-3">
                            <label for="file_uploads" class="form-label">Ảnh</label>
                            <input name="file_uploads" type="file" class="form-control " id="file_uploads"
                                value="{{ old('file_uploads') }}" aria-describedby="file_uploads">
                        </div>
                        <div class="form-group">
                            <label for="chitiet" class="form-label">Chi tiết</label>
                            <textarea class="form-control ckeditor" name="chitiet" id="ct1" cols="10" rows="1"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="moi">Trạng thái <span class="text-danger font-weight-bold">*</span></label>
                            <select class="custom-select form-control" id="moi1" name="moi">
                                <option value="">-- Choose --</option>
                                <option value="0">Không hiển thị</option>
                                <option value="1" selected="selected">Hiển thị</option>
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="noibat">Nổi bật <span class="text-danger font-weight-bold">*</span></label>
                            <select class="custom-select form-control " id="noibat1" name="noibat">
                                <option value="">-- Choose --</option>
                                <option value="0">Không hiển thị</option>
                                <option value="1" selected="selected">Hiển thị</option>
                            </select>


                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_sp_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="hidden" name="emp_avatar" id="emp_avatar">
                    <div class="modal-body">

                        <ul id="UDthongbaoloi"></ul>

                        <input type="hidden" id="id">
                        <div class="form-group mb-3">
                            <label for="tensp" class="form-label">Nhập tên sản phẩm</label>
                            <input name="tensp" type="text" class="form-control " id="tensp1" aria-describedby="tensp">
                        </div>
                        <div class="form-group">
                            <label for="xuatxu_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="xuatxu_id1" class="form-control custom-select" name="xuatxu_id">
                                <option value="">-- Chọn xuất xứ --</option>
                                @foreach ($xx as $value)
                                    <option value="{{ $value->id }}">{{ $value->tenxuatxu }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="nhacungcap_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="nhacungcap_id1" class="form-control custom-select " name="nhacungcap_id">
                                <option value="">-- Chọn nhà cung cấp --</option>
                                @foreach ($ncc as $value)
                                    <option value="{{ $value->id }}">{{ $value->nhacungcap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="danhmuc_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="danhmuc_id1" class="form-control custom-select " name="danhmuc_id">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($dm as $value)
                                    <option value="{{ $value->id }}">{{ $value->tendanhmuc }}</option>
                                @endforeach
                            </select>



                        </div>
                        <div class="form-group">
                            <label for="baohanh_id"><span class="text-danger font-weight-bold">*</span></label>
                            <select id="baohanh_id1" class="form-control custom-select " name="baohanh_id">
                                <option value="">-- Chọn bảo hành --</option>
                                @foreach ($bh as $value)
                                    <option value="{{ $value->id }}">{{ $value->baohanh }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="soluong">Số lượng <span class="text-danger font-weight-bold">*</span></label>
                            <input id="soluong1" type="number" min="0" class="form-control " name="soluong" />
                            {{ $errors->first('soluong') }}
                        </div>
                        <div class="form-group">
                            <label for="giamgia">Giảm giá <span class="text-danger font-weight-bold">*</span></label>
                            <input id="giamgia1" type="number" min="0" class="form-control " name="giamgia" />
                            {{ $errors->first('soluong') }}
                        </div>

                        <div class="form-group">
                            <label for="gianhap">Giá nhập <span class="text-danger font-weight-bold">*</span></label>
                            <input id="gianhap1" type="number" min="0" class="form-control " name="gianhap"
                                value="{{ old('gianhap') }}" />
                            {{ $errors->first('gianhap') }}
                        </div>

                        <div class="form-group">
                            <label for="giaxuat">Giá xuất <span class="text-danger font-weight-bold">*</span></label>
                            <input id="giaxuat1" type="number" min="0" class="form-control " name="giaxuat"
                                value="{{ old('giaxuat') }}" />
                            {{ $errors->first('giaxuat') }}
                        </div>

                        <div class="mb-3">
                            <label for="file_uploads" class="form-label">Ảnh</label>
                            <input name="avatar" type="file" class="form-control " value="{{ old('file_uploads') }}"
                                aria-describedby="file_uploads">
                        </div>
                        <div class="mt-2" id="avatar">

                        </div>
                        <div class="form-group">
                            <label for="chitiet" class="form-label">Chi tiết</label>
                            <textarea class="form-control ckeditor" name="chitiet" id="ct1" cols="10" rows="1"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="moi">Trạng thái <span class="text-danger font-weight-bold">*</span></label>
                            <select class="custom-select form-control" id="moi1" name="moi">
                                <option value="">-- Choose --</option>
                                <option value="0">Không hiển thị</option>
                                <option value="1" selected="selected">Hiển thị</option>
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="noibat">Nổi bật <span class="text-danger font-weight-bold">*</span></label>
                            <select class="custom-select form-control " id="noibat1" name="noibat">
                                <option value="">-- Choose --</option>
                                <option value="0">Không hiển thị</option>
                                <option value="1" selected="selected">Hiển thị</option>
                            </select>


                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="edit_employee_btn" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @include('admin.sanpham.create')

    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
@endsection

@section('js')
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        function ds() {
            $.ajax({
                url: '{{ route('sanpham.ds') }}',
                method: 'get',

                success: function(response) {
                    $("#show_all_sp").html(response);
                    

                }
            });
        }
        ds();


        $(document).on('click', '.deletebtn', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "http://localhost/GPM/admin/sanpham/destroy/",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            // console.log(response);
                            if (response.code == 200) {
                                Swal.fire(
                                    'Xóa thành công!',
                                    'Sản phẩm của bạn đã được xóa.',
                                    'success'
                                )
                                ds();
                            } else {
                                Swal.fire(
                                    'Xóa không thành công!',
                                    'Sản phẩm của bạn hiện có trong đơn hàng nên không thể xóa.',
                                    'error'
                                )

                            }

                        }
                    });
                }
            })
        });


        $(document).on('click', '.editbtn', function(e) {
            e.preventDefault();

            let id = $(this).attr('id');
            // alert(stud_id);

            $.ajax({
                url: "http://localhost/GPM/admin/sanpham/edit",
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#tensp1').val(response.tensp);
                    $('#danhmuc_id').val(response.danhmuc_id);
                    $('#xuatxu_id').val(response.xuatxu_id);
                    $('#nhacungcap_id').val(response.nhacungcap_id);
                    $('#baohanh_id').val(response.baohanh_id);
                    $('#soluong1').val(response.soluong);
                    $('#gianhap1').val(response.gianhap);
                    $('#giamgia1').val(response.giamgia);
                    $('#giaxuat1').val(response.giaxuat);
                    $("#avatar").html(
                        `<img src="/GPM/public/sanpham/${response.anh}" width="100" class="img-fluid img-thumbnail">`
                    );
                    $('#ct1').val(response.chitiet);
                    $("#moi1").val(response.moi);
                    $("#noibat1").val(response.noibat);
                    $("#emp_id").val(response.id);
                    $("#emp_avatar").val(response.anh);
                }
            });


        });


        $("#edit_sp_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: "http://localhost/GPM/admin/sanpham/update",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if (response.code == 200) {
                        $('#UDthongbaoloi').html('');
                        const Msg = Swal.mixin({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Cập nhật thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        //end
                        Msg.fire({

                            type: 'success',
                            title: 'Cập nhật thành công',

                        });


                        $("#edit_sp_form")[0].reset();
                        $("#modal-edit").modal('hide');
                        ds();
                    } else {
                        let mess = '';
                        for (let error of response.error) {
                            mess += '';
                            mess +=
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            mess += '<strong>' + error + '';

                            mess += ' </div>';
                            mess += '';
                        }
                        $('#UDthongbaoloi').html(mess);



                    }
                }
            });
        });




        function clear() {
            $('#tensp').val('');

        }
        $(document).ready(function() {
            $(document).on('submit', '#addSPForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('sanpham.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        if (response.code == 200) {
                            $('#thongbaoloi').html('');
                            const Msg = Swal.mixin({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Thêm mới thành công',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            //end
                            Msg.fire({

                                type: 'success',
                                title: 'Thêm mới thành công',

                            });


                            $("#modal-add .close").click();
                            clear();
                            ds();
                        } else {
                            let mess = '';
                            for (let error of response.error) {
                                mess += '';
                                mess +=
                                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                mess += '<strong>' + error + '';

                                mess += ' </div>';
                                mess += '';
                            }
                            $('#thongbaoloi').html(mess);



                        }



                    }
                });
            });
        });

        $('#modal-file').on('hide.bs.modal', function() {
            var _imgs = $('input#list_anh').val();
            var img_list = $.parseJSON(_imgs);
            var _html = '';
            for (var i = 0; i < img_list.length; i++) {
                _html += '<div class="col-md-3 thumbnail">';
                _html += '<img src="' + img_list[i] + '" alt="" style="width:50px">';
                _html += '</div>';
            }
            $('#image_show_list').html(_html);

        });
    </script>
@endsection
