<div class="modal modal-default" id="createModal" tabindex="-1" role="dialog"
  aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Create Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="{{route('roles.store')}}" tabindex="1" id="createForm">
        @csrf
        {{method_field('POST')}}
        <div class="modal-body">
          <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
              <label class="col-form-label">Description:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="description">
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