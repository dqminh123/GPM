@extends('layouts.admin')
@section('css')
    z
@endsection
@section('main')
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add">
        Thêm
    </button>


    <div class="card-body" id="cvtbl">
        <table class="table table-bordered" style="color: black" id="cvtbl">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Quyền</th>

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>

    {{-- <div class="modal fade" id="modal-dle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa chức vụ</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Bạn có chắc muốn xóa không ?</h4>
                    <input type="hidden" id="id-dle">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_cv">Đồng ý</button>
                </div>
            </div>
        </div>
    </div> --}}

    @include('admin.chucvu.create')
    @include('admin.chucvu.edit')
@endsection

@section('js')
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        function ds() {
            $.ajax({
                url: '{{ route('chucvu.ds') }}',
                method: 'get',

                success: function(response) {
                    $('tbody').html("");
                    $.each(response.chucvu, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                            <td>' + item.id + '</td>\
                                            <td>' + item.tenchucvu + '</td>\
                                            <td>' + item.quyen + '</td>\
                                            <td><button type="button" value="' + item.id +
                            '" class="editbtn btn btn-primary">Sửa</button> <button type="button" id="' +
                            item.id + '" class="deletebtn btn btn-danger">xoá</button></td>\
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
                        url: "http://localhost/GPM/admin/chucvu/destroy/",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            // console.log(response);

                            Swal.fire(
                                'Xóa thành công!',
                                'Chức vụ của bạn đã được xóa.',
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
            let url = "http://localhost/GPM/admin/chucvu/edit/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {

                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#modal-edit').modal('hide');
                    } else {

                        $('#tencv').val(response.chucvu.tenchucvu);
                        $('#qye').val(response.chucvu.quyen);
                        $('#id').val(id);
                        $('#modal-edit').modal('show');

                    }
                }
            });


        });

        $(document).on('click', '.update_cv', function(e) {
            e.preventDefault();

            $(this).text('Updating..');
            var id = $('#id').val();
            // alert(id);

            var data = {
                'tenchucvu': $('#tencv').val(),
                'quyen': $('#qye').val(),

            }
            let url = "http://localhost/GPM/admin/chucvu/update/" + id;


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
                success: function(response) {
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
            $('#tenchucvu').val('');
            $('#quyen').val('');
        }
        $(document).ready(function() {
            $(document).on('click', '#add-cv', function(e) {
                e.preventDefault();
                var data = {
                    'tenchucvu': $('#tenchucvu').val(),
                    'quyen': $('#quyen').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('chucvu.store') }}",
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
    </script>
@endsection
