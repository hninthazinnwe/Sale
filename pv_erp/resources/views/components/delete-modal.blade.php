<!-- Default Modal -->

<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        @yield('delete-modal-title')
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @yield('delete-modal-body')
      </div>
      <div class="modal-footer">
        @yield('delete-modal-footer')
      </div>
    </div>
  </div>
