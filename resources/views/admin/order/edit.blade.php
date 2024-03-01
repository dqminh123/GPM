@extends('layouts.admin')
@section('main')
<div class="card">
    <div class="card-body">
        <form action="{{route('danhmuc.update',$data->id)}}" method="POST">
            @csrf  @method('PUT')
        
               
            <label for="tendanhmuc" class="form-label">Tên khách hàng</label>
              <input value="{{$data->khachhang->hovaten}}" type="text" class="form-control" name="tendanhmuc" id="tendanhmuc" >
            </div>
            <label for="tendanhmuc" class="form-label">nhập tên danh mục</label>
            <input value="{{$data->tendanhmuc}}" type="text" class="form-control" name="tendanhmuc" id="tendanhmuc" >
            </div>
            <label for="tendanhmuc" class="form-label">nhập tên danh mục</label>
            <input value="{{$data->tendanhmuc}}" type="text" class="form-control" name="tendanhmuc" id="tendanhmuc" >
           </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>

@endsection
