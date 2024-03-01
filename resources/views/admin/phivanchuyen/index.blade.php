@extends('layouts.admin')
@section('main')
<div class="container">
    <a href="{{route('phivanchuyen.create')}}" style="background-color: blue; color: white;" type="button" class="btn btn-secondary mb-3">Thêm mới</a>
<div class="table">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Thành phố</th>
                        <th scope="col">Huyện</th>
                        <th scope="col">Xã</th>
                        <th scope="col">Phí</th>

                    </tr>
                </thead>
                @foreach ($phivanchuyen as $item)
                    <tr>

                        <td>{{ $item->id }}</td>
                        <td>{{ $item->thanhpho->tenthanhpho }}</td>
                        <td>{{ $item->huyen->tenhuyen }}</td>
                        <td>{{ $item->xa->tenxa }}</td>
                        <td>{{ $item->phi }}</td>
                        <td><a href="{{route('phivanchuyen.edit', $item->id)}}" class="btn btn-danger">Sửa</a>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>  
    </div> 
@endsection