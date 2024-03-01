@extends('layouts.admin')
@section('main')
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add">
        Thêm
    </button>


    <div class="card-body">
        <table class="table table-bordered" style="color: black">
            <thead>
                <tr>
                    <th width="5%" scope="col">ID</th>
                    <th width="20%" scope="col">Họ và tên</th>
                    <th width="15%" scope="col">Điện thoại</th>
                    <th width="15%" scope="col">Địa chỉ</th>
                    <th width="15%" scope="col">Giới tính</th>
                    <th width="20%" scope="col">Email</th>
                    <th width="20%" scope="col">Tên đăng nhập</th>
                   
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>

    

    @include('admin.khachhang.create')
    @include('admin.khachhang.edit')
    
@endsection

@section('js')
    <script>
        function ds() {
            $.ajax({
                type: "GET",
                url: "{{ route('khachhang.ds') }}",
                dataType:"json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.khachhang, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                    <td>' + item.id + '</td>\
                                    <td>' + item.hovaten + '</td>\
                                    <td>' + item.dienthoai + '</td>\
                                    <td>' + item.diachi +'</td>\
                                    <td>' + item.gioitinh +'</td>\
                                    <td>' + item.email +'</td>\
                                    <td>' + item.tendangnhap +'</td>\
                                    <td><button type="button" value="' + item.id + '" class="editbtn btn btn-primary">Sửa</button></td>\
                                    <td><button type="button" id="' + item.id + '" class="deletebtn btn btn-danger">xoá</button></td>\
                                </tr>');
                    });
                   
                   
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
                        url: "http://localhost/GPM/admin/khachhang/destroy/",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            // console.log(response);

                            Swal.fire(
                                'Xóa thành công!',
                                'Khách hàng của bạn đã được xóa.',
                                'success'
                            )
                            ds();



                        }
                    });
                }
            })
        });
        
       
        $(document).on('click', '.editbtn', function(e) {
            e.preventDefault();

            var id = $(this).val();
            // alert(stud_id);
            let url = "http://localhost/GPM/admin/khachhang/edit/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {

                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#modal-edit').modal('hide');
                    } else {
                       
                        $('#hovaten').val(response.khachhang.hovaten);
                        $('#dienthoai').val(response.khachhang.dienthoai);
                        $('#diachi').val(response.khachhang.diachi);
                        $('#gioitinh').val(response.khachhang.gioitinh);
                        $('#chucvu_id').val(response.khachhang.chucvu_id);
                        $('#email').val(response.khachhang.email);
                        $('#tendangnhap').val(response.khachhang.tendangnhap);
                        
                       
                        $('#id').val(id);
                        $('#modal-edit').modal('show');

                    }
                }
            });
           

        });
        
        $(document).on('submit', '#updateKHForm', function (e) {
            e.preventDefault();
           
            var id = $('#id').val();
            // alert(id);
            let EditformData= new FormData(this);
            
            let url = "http://localhost/GPM/admin/khachhang/update/" + id;
            
            

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: url,
                data: EditformData,
                contentType:false,
                processData:false,
                success: function (response) {
                     //console.log(response);
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


                            $("#modal-edit .close").click();
                            clear();
                            ds();
                        }

                     else {
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
            $('#hovaten').val('');
            
        }
        $(document).ready(function() {
            $(document).on('submit', '#addKHForm', function(e) {
                e.preventDefault();
                let formData= new FormData(this);
                    console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('khachhang.store') }}",
                    data: formData,
                    contentType:false,
                    processData:false,

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
                        }

                     else {
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
    </script>
@endsection
