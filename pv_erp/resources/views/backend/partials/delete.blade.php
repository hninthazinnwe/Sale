<div class="modal modal-default" id="deleteModal" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Delete Action</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure to delete?
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post" id="deleteForm">
                                {{ csrf_field() }}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" id="btnDelete">DELETE</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>