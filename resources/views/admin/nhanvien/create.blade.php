<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addNVForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <ul id="thongbaoloi"></ul>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">Họ và tên</label>
                        <input type="text" class="form-control" name="hovaten">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">Điện thoại</label>
                        <input type="text" class="form-control" name="dienthoai">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">Địa chỉ</label>
                        <input type="text" class="form-control" name="diachi">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">CMND</label>
                        <input type="text" class="form-control" name="cmnd">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">Ngày sinh</label>
                        <input type="date" class="form-control" name="ngaysinh">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Giới tính</label>
                        <select name="gioitinh" class="form-control" required="required">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Chức vụ</label>
                        <select name="chucvu_id" class="form-control" required="required">
                            @foreach ($chucvu as $value)
                                <option value="{{ $value->id }}">{{ $value->tenchucvu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="tendangnhap">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" style="color: black">Mật khẩu</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="file_uploads" class="form-label">Ảnh</label>
                        <input name="file_uploads" type="file" class="form-control "
                            value="{{ old('file_uploads') }}" aria-describedby="file_uploads">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
