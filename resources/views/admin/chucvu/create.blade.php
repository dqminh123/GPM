<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm chức vụ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul id="thongbaoloi"></ul>
          <div class="form-group mb-3">
              <label for="tenchucvu" style="color: black">Tên chức vụ</label>
              <input type="text"  class="form-control" id="tenchucvu">
          </div>
          <div class="form-group mb-3">
            <label for="quyen" style="color: black">Quyền</label>
            <input type="text"  class="form-control" id="quyen">
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="add-cv">Save</button>
        </div>
         
      </div>
    </div>
  </div>