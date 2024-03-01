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
                    <th width="20%" scope="col">Tên danh mục</th>
                    <th width="15%" scope="col">Trạng thái</th>
                    <th width="20%" scope="col">Ảnh</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($dm as $item)
          <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->tendanhmuc}}</td>
            <td>{{$item->slug}}</td>
            <td>
              @if ($item->trangthai==0)
                  Không hiển thị
              @else 
                  Hiển thị
               @endif   
            </td>
            <td><img src="{{url('public/danhmuc')}}/{{$item->anh}}" width="30px"></td>
            <td>
                <a href="" class="editbtn btn btn-danger"><i class="fa fa-edit"></i></a> 
                <a  href="" class="deletebtn btn btn-warning "><i class="fa fa-trash"></i></a>
            </td>
            
            </tr>
          @endforeach --}}
            </tbody>
        </table>

    </div>

    

    @include('admin.danhmuc.create')
    @include('admin.danhmuc.edit')
    
@endsection

@section('js')
    <script>
        function ds() {
            $.ajax({
                type: "GET",
                url: "{{ route('danhmuc.ds') }}",
                dataType:"json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.danhmuc,  function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                    <td>' + item.id + '</td>\
                                    <td>' + item.tendanhmuc + '</td>\
                                    <td>' +item.trangthai+'</td>\
                                    <td><img src={{url('public/danhmuc')}}/' +item.anh+' width="50px" height="50px" alt="Image"></td>\
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
                        url: "http://localhost/GPM/admin/danhmuc/destroy/",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            // console.log(response);

                            Swal.fire(
                                'Xóa thành công!',
                                'Danh mục của bạn đã được xóa.',
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
            let url = "http://localhost/GPM/admin/danhmuc/edit/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {

                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#modal-edit').modal('hide');
                    } else {
                       
                        $('#tendm').val(response.danhmuc.tendanhmuc);
                        $('#trangthai-edit').val(response.danhmuc.trangthai);
                       
                        
                       
                        $('#id').val(id);
                        $('#modal-edit').modal('show');

                    }
                }
            });
           

        });
        
        $(document).on('submit', '#updateDMForm', function (e) {
            e.preventDefault();
           
            var id = $('#id').val();
            // alert(id);
            let EditformData= new FormData(this);
            
            let url = "http://localhost/GPM/admin/danhmuc/update/" + id;
            
            

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
            $('#tendanhmuc').val('');
           
            
        }
        $(document).ready(function() {
            $(document).on('submit', '#addDMForm', function(e) {
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
                    url: "{{ route('danhmuc.store') }}",
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
