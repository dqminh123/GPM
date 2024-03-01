@extends('layouts.admin')
@section('main')

<h5 class="card-header">Tỉnh</h5>
<a href="" style="background-color: purple; color: white;" type="button" class="btn btn-secondary mb-3">Thêm mới</a>
<a href="#nhap" class="btn btn-warning" data-toggle="modal" data-target="#importModal"><i class="fal fa-upload"></i> Nhập từ Excel</a>
<div class="table">
  <table id="etinhmple1" class="table table-bordered mb-0">
    <thead >
      <tr>
        <th scope="col">Mã tỉnh</th>
        <th scope="col">Tên tỉnh</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($huyen as $item)
      <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->thanhpho_id}}</td>
        <td>{{$item->tenhuyen}}</td>
       
      </tr>
      @endforeach
    </tbody>
</table>
</div>

<form action="{{ route('huyen.nhap') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
 <div class="modal-body">
  <div class="mb-0">
  <label for="file_excel" class="form-label">Chọn tập tin Excel</label>
  <input type="file" class="form-control" id="file_excel" name="file_excel" required />
  </div>
  </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fal fa-times"></i> Hủy bỏ</button>
  <button type="submit" class="btn btn-danger"><i class="fal fa-upload"></i> Nhập dữ liệu</button>
  </div>
  </div>
  </div>
  </div>
  </form>
  @endsection
  {{-- @section('js')
  <script>
    $(document).ready(function () {
      $(document).on('click','.btn-sua',function(e){
        e.preventDefault();
        alert('asda');
      })
    });
  </script>
  @endsection --}}