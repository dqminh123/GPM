@extends('layouts.admin')
@section('main')
<h5 class="card-header">Vận chuyển</h5>
{{-- <a href="{{ route('vanchuyen.create') }}" style="background-color: purple; color: white;" type="button"
    class="btn btn-primary">Thêm mới</a> --}}

<form action="{{route('them.phivanchuyen')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="tinh">Tĩnh <span class="text-danger font-weight-bold">*</span></label>
        <select class="custom-select form-control chon thanhpho" id="thanhpho" name="thanhpho">
            <option value="">-- Chọn thành phố --</option>
            @foreach ($thanhpho as $value)
                <option value="{{ $value->mathanhpho }}">{{ $value->tenthanhpho }}</option>
            @endforeach
        </select>
        {{ $errors->first('thanhpho') }}
    </div>

    <div class="mb-3">
        <label for="huyen">Huyện <span class="text-danger font-weight-bold">*</span></label>
        <select class="custom-select form-control huyen chon" id="huyen" name="huyen">
            <option value="">-- Chọn Huyện --</option>
            {{-- @foreach ($huyen as $value)
  <option value="{{ $value->mahuyen }}">{{ $value->tenhuyen }}</option>
@endforeach --}}
        </select>
        {{ $errors->first('huyen') }}
    </div>

    <div class="mb-3">
        <label for="xa">Xã <span class="text-danger font-weight-bold">*</span></label>
        <select class="custom-select form-control xa" id="xa" name="xa">
            <option value="">-- Chọn Xã --</option>
            {{-- @foreach ($xa as $value)
  <option value="{{ $value->maxa }}">{{ $value->tenxa }}</option>
@endforeach --}}
        </select>
        {{ $errors->first('xa') }}
    </div>

    <div class="mb-3">
        <label for="phi" class="form-label">Phí <span class="text-danger font-weight-bold">*</span></label>
        <input name="phi" type="number" class="form-control phi" id="phi" aria-describedby="phi">
        {{ $errors->first('phi') }}
    </div>

    <button style="background-color: purple; color: white;" type="submit" class="btn btn-primary themvanchuyen">Thêm phí
        vận chuyển</button>
</form>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.chon').change(function() {
                var action = $(this).attr('id');
                var mathanhpho = $(this).val();
                var _token = $('input[name="_token"]').val();
                var $result = '';
                //  alert(action);
                //  alert(matinh);
                //  alert(_token);
                if (action == 'thanhpho') {
                    result = 'huyen';
                } else {
                    result = 'xa';
                }
                $.ajax({
                    url: "{{ route('chon.phivanchuyen') }}",
                    method: 'POST',
                    data: {
                        action: action,
                        mathanhpho: mathanhpho,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>
@endsection