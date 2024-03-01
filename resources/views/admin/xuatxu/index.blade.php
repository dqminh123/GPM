@extends('layouts.admin')
@section('main')
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add">
        Thêm
    </button>


    <div class="card-body">
        <table class="table table-bordered" style="color: black">
            <thead>
                <tr>
                    <th width="10%" scope="col">ID</th>
                    <th width="20%" scope="col">Tên xuất xứ</th>
                    

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>

    

    @include('admin.xuatxu.create')
    @include('admin.xuatxu.edit')
    
@endsection

@section('js')
    <script>
        function ds() {
            $.ajax({
                type: "GET",
                url: "{{ route('xuatxu.ds') }}",

                success: function(response) {
                    $('tbody').html("");
                    $.each(response.xuatxu, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                    <td>' + item.id + '</td>\
                                    <td>' + item.tenxuatxu + '</td>\
                                    <td><button type="button" value="' + item.id + '" class="editbtn btn btn-primary">Sửa</button> <button type="button" id="' + item.id + '" class="deletebtn btn btn-danger">xoá</button></td>\
                                    <td></td>\
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
                        url: "http://localhost/GPM/admin/xuatxu/destroy/",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            // console.log(response);

                            Swal.fire(
                                'Xóa thành công!',
                                'Xuất xứ của bạn đã được xóa.',
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
            let url = "http://localhost/GPM/admin/xuatxu/edit/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {

                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#modal-edit').modal('hide');
                    } else {
                       
                        $('#tenxx').val(response.xuatxu.tenxuatxu);
                       
                        $('#id').val(id);
                        $('#modal-edit').modal('show');

                    }
                }
            });
           

        });
        
        $(document).on('click', '.update_xx', function (e) {
            e.preventDefault();

            $(this).text('Updating..');
            var id = $('#id').val();
            // alert(id);

            var data = {
                'tenxuatxu': $('#tenxx').val(),
               
                
            }
            let url = "http://localhost/GPM/admin/xuatxu/update/" + id;


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
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
            $('#tenxuatxu').val('');
            
        }
        $(document).ready(function() {
            $(document).on('click', '#add-xx', function(e) {
                e.preventDefault();
                var data = {
                    'tenxuatxu': $('#tenxuatxu').val(),
                    
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('xuatxu.store') }}",
                    data: data,

                    success: function(response) {

                        //console.log('them moi thanh cong');
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
