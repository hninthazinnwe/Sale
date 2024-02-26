<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        @stop
        @section('content')
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                All Users
            </h1>
            <button type="button" id="btnCreate" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create User
            </button>
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
                                    <th>Role</th>
                                    <th>Location</th>
                                    <th>Email</th>
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
        @include('backend.user.create')

        @include('backend.user.edit')

        @include('backend.partials.delete')

        </div>      

        @stop
        
        @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                window.deleteData = function(uuid) {
                    var url = "{{ route('users.destroy', ':uuid') }}";
                    url = url.replace(':uuid', uuid);
                    const form = document.getElementById("deleteForm");
                    form.setAttribute("action", url);
                }

                window.editData = function(uuid) {
                    var editUrl = "{{ route('users.edit', ':uuid') }}";
                    var updateUrl = "{{ route('users.update', ':uuid') }}";
                    editUrl = editUrl.replace(':uuid', uuid);
                    updateUrl = updateUrl.replace(':uuid', uuid);
                    const form = document.getElementById("editForm");
                    form.setAttribute("action", updateUrl);

                    $.ajax({
                        url: editUrl,
                        type: "GET",
                        data:{}, //id:rowId
                        success: function (data) {
                            console.log('Data------:', data);
                            $('#editName').val(data.name);
                            $('#editRole').val(data.phone);
                            $('#editLocation').val(data.email);
                            $('#editEmail').val(data.address);
                        },
                        error: function (data) {
                            console.log('Error------:', data);

                        }                
                    })
                }

                var table = $('#myTable').DataTable({
                    "columnDefs": [
                            { "width": "250px", "targets": 7 },
                            {
                                "targets": 1,
                                "visible": false,
                                "searchable": false
                            },
                        ],
                    processing: false,
                    serverSide: false,
                    autoWidth: false,
                    ajax: "{{ route('locations.index') }}",
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
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'location',
                            name: 'location'
                        },
                        {
                            data: 'email',
                            name: 'email'
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
            });
        </script>
        @endsection
    </x-content>
</x-layout>