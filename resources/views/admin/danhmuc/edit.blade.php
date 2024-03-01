<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateDMForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <ul id="UDthongbaoloi"></ul>

                    <input type="hidden" id="id" />

                    <div class="form-group mb-3">
                        <label for="" style="color: black">Tên danh mục</label>
                        <input type="text" class="form-control" name="tendanhmuc" id="tendm">
                    </div>
                    <div class="mb-3">
                        <label for="noibat">Trạng thái <span class="text-danger font-weight-bold">*</span></label>
                        <select class="custom-select form-control " id="trangthai-edit" name="trangthai">
                            <option value="">-- Choose --</option>
                            <option value="0">Không hiển thị</option>
                            <option value="1" selected="selected">Hiển thị</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="file_uploads" class="form-label">Ảnh</label>
                        <input name="file_uploads" type="file" class="form-control "
                            value="{{ old('file_uploads') }}" aria-describedby="file_uploads">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
