<!-- XL Modal -->

<div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        @yield('xl-modal-title')
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @yield('modal-body')
      </div>
      <div class="modal-footer">
        @yield('modal-footer')
      </div>
    </div>
  </div>
