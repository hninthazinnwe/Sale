<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        @stop
        @section('content')
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                All UOMs
            </h1>
            <button type="button" id="btnCreate" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create UOM
            </button>
        </div>
        <div class ="notification">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
        </div>
        <div class="pb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Uuid</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Symbol</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="modal modal-default" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <x-create-modal>
                    @section('create-modal-title')
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Create UOM</h5>
                    @stop
                    @section('create-modal-body')
                    <form method="POST"action="{{route('uoms.store')}}" tabindex="1">
                    @csrf
                    {{method_field('POST')}}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-form-label">Name:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group  {{ $errors->has('symbol') ? 'has-error' : '' }}">
                            <label class="col-form-label">Symbol:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="symbol">
                        </div>
                        <div class="form-group  {{ $errors->has('unit') ? 'has-error' : '' }}">
                            <label class="col-form-label">Unit:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="unit">
                        </div>
                    @stop
                    @section('create-modal-footer')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    @stop
                    </form>
                </x-create-modal>
            </div>


            <div class="modal modal-default" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <x-edit-modal>
                    @section('edit-modal-title')
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit UOM</h5>
                    @stop
                    @section('edit-modal-body')
                    <div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-form-label">Hello:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editName">
                        </div>
                        <div class="form-group  {{ $errors->has('symbol') ? 'has-error' : '' }}">
                            <label class="col-form-label">Symbol:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editSymbol">
                        </div>
                        <div class="form-group  {{ $errors->has('unit') ? 'has-error' : '' }}">
                            <label class="col-form-label">Unit:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editUnit">
                        </div>
                     </div>
                    @stop
                    @section('edit-modal-footer')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnEditSave">Save</button>
                    @stop
                </x-edit-modal>
            </div> 




            <div class="modal modal-default" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <x-delete-modal>
                    @section('delete-modal-title')
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Delete UOM</h5>
                    @stop
                    @section('delete-modal-body')
                    <p>Are you sure to delete?</p>
                    @stop
                    @section('delete-modal-footer')
                    <form action="" method="GET" class="deleteForm">
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                        <button type="button" id="btnDelete" class="btn btn-danger">DELETE</button>
                    </form>
                    @stop
                </x-delete-modal>
            </div> 
        </div>
      

        @stop
        
        @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
            let uuid= '';
            $(document).ready(function() {
                
                window.deleteData = function(a) {
                    
                    var url = "{{ route('uoms.destroy', ':uuid') }}";
                    url = url.replace(':uuid', uuid);
                    console.log(url, 'url -------------------hello')
                    // $(".deleteForm").attr('action', url);
                }

                // {{route('uoms.destroy', 'a65c8a0735611f')}}

                var table = $('#myTable').DataTable({
                    "columnDefs": [
                            { "width": "250px", "targets": 6 },
                            {
                                "targets": 1,
                                "visible": false,
                                "searchable": false
                            },
                        ],
                    processing: false,
                    serverSide: false,
                    autoWidth: false,
                    ajax: "{{ route('uoms.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'uuid',
                            name: 'uuid'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'symbol',
                            name: 'symbol'
                        },
                        {
                            data: 'unit',
                            name: 'unit'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className:'text-center'
                        },
                    ],
                    "bDestroy": true
                });
                $('#myTable').show();

                $('#myTable tbody').on('click', '.btnDelete', function () {
                    var data = table.row($(this).closest('tr')).data();
                    console.log('uuid---', data);
                    uuid = data['uuid'];
                   
                });

                $('#myTable tbody').on('click', '.btnEdit', function () {
                    var data = table.row($(this).closest('tr')).data();
                    uuid = data['uuid'];
                    var url = "{{ route('uoms.edit', ':uuid') }}";
                    url = url.replace(':uuid', uuid);

                    $.ajax({
                        url: url,
                        type: "GET",
                        data:{}, //id:rowId
                        success: function (data) {
                            console.log('Data------:', data);
                            $('#editName').val(data.name);
                            $('#editSymbol').val(data.symbol);
                            $('#editUnit').val(data.unit);
                        },
                        error: function (data) {
                            console.log('Error------:', data);

                        }                
                    })
                })

                $('#btnDelete').on('click', function () {
                    var url = "{{ route('uoms.destroy', ':uuid') }}";
                    url = url.replace(':uuid', uuid);
                    console.log('Url------:', url);
                    var data = {
                        _token: '{{csrf_token()}}'
                    }
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: data,
                        success: function (data) {
                            console.log('Success------:');
                            toastr.success('Delete Successfully');
                            var w=window.open('uoms', '_self', '');
                            w.close();
                            
                            console.log('Success----1--:');
                        },
                        error: function (data) {
                            console.log('Error------:', data);

                        }                
                    })
                })

                $('#btnEditSave').click(function(e){
                    var url = "{{ route('uoms.update', ':uuid') }}";
                    url = url.replace(':uuid', uuid);
                    console.log('Url---update---:', url);
                    var data = {
                        name: $('#editName').val(),
                        symbol: $('#editSymbol').val(),
                        unit: $('#editUnit').val(),
                        _token: '{{csrf_token()}}'
                    }
                    console.log('data', data);
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: data,
                        success: function (data) {
                            debugger
                            console.log('Success------:', data);
                            var w=window.open('uoms', '_self', '');
                            w.close();

                            console.log('Success----1--:');
                        },
                        error: function (data) {
                            console.log('Error------:', data);

                        }                
                    })
                })
            });
        </script>
        @endsection
    </x-content>
</x-layout>