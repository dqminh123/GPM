@extends('layouts.admin')
@section('main')
<form action="{{route('phivanchuyen.update',$vanchuyen->id)}}" method="POST">
    @csrf @method('PUT')
<div class="mb-3">
    <label for="phi" class="form-group">Phí <span class="text-danger font-weight-bold">*</span></label>
    <input name="phi" type="number" class="form-control phi" id="phi" aria-describedby="phi" value="{{$vanchuyen->phi}}">
    {{ $errors->first('phi') }}
</div>
<button type="submit" class="btn btn-primary">Sửa</button>
</form>
@endsection