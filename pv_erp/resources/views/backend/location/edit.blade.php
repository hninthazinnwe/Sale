<div class="modal modal-default" id="editModal" tabindex="-1" role="dialog"
  aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Edit Location</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="" tabindex="1" id="editForm">
        @csrf
        {{method_field('PUT')}}
        <div class="modal-body">
            <div class="form-group {{ $errors->has('editName') ? 'has-error' : '' }}">
                <label class="col-form-label">Name:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="editName" name="editName">
            </div>
            <div class="form-group {{ $errors->has('editPhone') ? 'has-error' : '' }}">
                <label class="col-form-label">Phone:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="editPhone" name="editPhone">
            </div>
            <div class="form-group {{ $errors->has('editEmail') ? 'has-error' : '' }}">
                <label class="col-form-label">email:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="editEmail" name="editEmail">
            </div>
            <div class="form-group {{ $errors->has('editAddress') ? 'has-error' : '' }}">
                <label class="col-form-label">Address:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="editAddress" name="editAddress">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnEditSave" name="btnEdit">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>