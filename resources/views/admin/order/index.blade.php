@extends('layouts.admin')
@section('main')
<form action="" method="GET" class="form-inline">
  <div class="form-group ">
    <input class="form-control mb-3" name="tukhoa" placeholder="Nhập mã đơn">
   </div>
  <button type="submit" class="btn btn-primary mb-3">Tìm Kiếm</button>
</form>

<div class="card" >
 
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th class="product-thumbnail">Mã đơn hàng</th>
            <th class="product-name">Khách hàng</th>
            <th class="product-price">Nhân viên</th>
            <th class="product-quantity">Ngày đặt hàng</th>
            <th class="product-subtotal">Tổng tiền</th>
            <th class="product-remove">Tình trạng</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($od as $value)
            <tr>
    
              <td  >{{$value->id}}</td>
              <td  >{{$value->khachhang->hovaten}}</td>

              @if(isset($value->nhanvien_id))
                <td>{{$value->nhanvien->hovaten}}</td>
              @else
              <td>
                  <a class="btn btn-primary" onclick="return confirm('Bạn có đồng ý nhận đơn hàng {{$value->id}}')" href="{{route('order.nhandon',$value->id)}}">Nhận đơn</a>
              </td>
              @endif

              <td  >{{$value->ngaydathang}}</td>
              <td  >{{number_format($value->tongtien)}} ₫</td>
              <td  >{{$value->tinhtrang->tinhtrang}}</td>
              <td  ><a class="btn btn-primary" href="{{route('order.show',$value->id)}}">Xem</a></td>
              
              @if($value->tinhtrang_id!=5)
              <td>
                <a onclick="return confirm('Bạn có muốn xóa đơn hàng số {{$value->id}} này không?')" href="{{route('order.destroy',$value->id)}}" class="btn btn-danger ">Xóa</a>
             </td>
              @endif
             
             @if($value->tinhtrang_id!=5)
             <td>
                 <div class="btn-group">
                  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                     Tình trạng
                   </button>
                   <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     @foreach ($cdt as $tt)
                     <li><a class="dropdown-item" href="{{route('order.tinhtrang',['id'=>$value->id,'tt'=>$tt->id])}}">{{$tt->tinhtrang}}</a></li>
                     @endforeach
                   </ul>
                 </div>
             </td>
             @endif
             
            </tr>
          @endforeach
        </tbody>
      </table>
      
      <form method="POST" action="" id="form-delete">
        @csrf @method('DELETE')
      <form>
        <hr>
        <div class="">{{$od->appends(request()->all())->links()}}</div>
    </div>
</div>

@endsection
@section('js')
<script>
  $('.btndelete').click(function(ev){
    ev.preventDefault();
    var _href=$(this).attr('href');
    $('form#form-delete').attr('action',_href);
   if(confirm('bạn có chắc muốn xóa nó không?')){
      $('form#form-delete').submit();
   }
    
  })


</script>

@endsection
