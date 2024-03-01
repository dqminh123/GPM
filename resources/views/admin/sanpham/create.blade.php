<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addSPForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <ul id="thongbaoloi"></ul>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tensp" class="form-label">Nhập tên sản phẩm</label>
                                <input name="tensp" type="text" class="form-control " id="tensp"
                                    aria-describedby="tensp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="xuatxu_id"><span class="text-danger font-weight-bold">*</span></label>
                                <select id="xuatxu_id" class="form-control custom-select" name="xuatxu_id">
                                    <option value="">-- Chọn xuất xứ --</option>
                                    @foreach ($xx as $value)
                                        <option value="{{ $value->id }}">{{ $value->tenxuatxu }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nhacungcap_id"><span class="text-danger font-weight-bold">*</span></label>
                                <select id="nhacungcap_id" class="form-control custom-select " name="nhacungcap_id">
                                    <option value="">-- Chọn nhà cung cấp --</option>
                                    @foreach ($ncc as $value)
                                        <option value="{{ $value->id }}">{{ $value->nhacungcap }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="danhmuc_id"><span class="text-danger font-weight-bold">*</span></label>
                                <select id="danhmuc_id" class="form-control custom-select " name="danhmuc_id">
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($dm as $value)
                                        <option value="{{ $value->id }}">{{ $value->tendanhmuc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="baohanh_id"><span class="text-danger font-weight-bold">*</span></label>
                                <select id="baohanh_id" class="form-control custom-select " name="baohanh_id">
                                    <option value="">-- Chọn bảo hành --</option>
                                    @foreach ($bh as $value)
                                        <option value="{{ $value->id }}">{{ $value->baohanh }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="soluong">Số lượng <span
                                        class="text-danger font-weight-bold">*</span></label>
                                <input id="soluong" type="number" min="0" class="form-control " name="soluong" />
                                {{ $errors->first('soluong') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="giamgia">Giảm giá <span
                                        class="text-danger font-weight-bold">*</span></label>
                                <input id="giamgia" type="number" min="0" class="form-control " name="giamgia" />
                                {{ $errors->first('soluong') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gianhap">Giá nhập <span
                                        class="text-danger font-weight-bold">*</span></label>
                                <input id="gianhap" type="number" min="0" class="form-control " name="gianhap"
                                    value="{{ old('gianhap') }}" />
                                {{ $errors->first('gianhap') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="giaxuat">Giá xuất <span
                                        class="text-danger font-weight-bold">*</span></label>
                                <input id="giaxuat" type="number" min="0" class="form-control " name="giaxuat"
                                    value="{{ old('giaxuat') }}" />
                                {{ $errors->first('giaxuat') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="file_uploads" class="form-label">Ảnh</label>
                                <div class="input-group">
                                    <input name="file_uploads" type="file" class="form-control " id="file_uploads"
                                        value="{{ old('file_uploads') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="list_anh" class="form-label">Các ảnh khác </label>
                                <div class="input-group">
                                    <input name="list_anh" type="hidden" class="form-control " id="list_anh">
                                </div>
                                <a href="#modal-file" data-toggle="modal" class="btn btn-primary">Chọn</a>
                                <div class="row" id="image_show_list">

                                </div>
                            </div>
                        </div>
                        
                            <div class="form-group">
                                <label for="chitiet" class="form-label">Chi tiết</label>
                                <textarea  class="form-control ckeditor" name="chitiet" id="chitiet" cols="10" rows="1"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                       

                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="moi">Trạng thái <span class="text-danger font-weight-bold">*</span></label>
                            <select class="custom-select form-control" id="moi" name="moi">
                                <option value="">-- Choose --</option>
                                <option value="0">Không hiển thị</option>
                                <option value="1" selected="selected">Hiển thị</option>
                            </select>

                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="noibat">Nổi bật <span class="text-danger font-weight-bold">*</span></label>
                            <select class="custom-select form-control " id="noibat" name="noibat">
                                <option value="">-- Choose --</option>
                                <option value="0">Không hiển thị</option>
                                <option value="1" selected="selected">Hiển thị</option>
                            </select>
                        </div>
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

<div class="modal fade" id="modal-file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quản lý file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe
                    src="{{ url('file') }}/dialog.php?akey=jqMdmj0VlENR4TJeSIWesLRZbWMVAh9VUNrTs1tUpAE&field_id=list_anh"
                    style="width:100%;height:500px;border:0;overflow-y:auto"></iframe>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
