<!-- Default Modal -->

  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        @yield('edit-modal-title')
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @yield('edit-modal-body')
      </div>
      <div class="modal-footer">
        @yield('edit-modal-footer')
      </div>
    </div>
  </div>
