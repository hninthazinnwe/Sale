<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        @stop
        @section('content')
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                All Brands
            </h1>
            <button type="button" id="btnCreate" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create Brand
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
        @include('backend.brand.create')

        @include('backend.brand.edit')

        @include('backend.partials.delete')

        </div>      

        @stop
        
        @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
            let g_uuid= '';
            $(document).ready(function() {
                window.deleteData = function(uuid) {
                    var url = "{{ route('brands.destroy', ':uuid') }}";
                    url = url.replace(':uuid', uuid);
                    console.log(url, 'url -------------------delete')
                    const form = document.getElementById("deleteForm");
                    form.setAttribute("action", url);
                }

                window.editData = function(uuid) {
                    var editUrl = "{{ route('brands.edit', ':uuid') }}";
                    var updateUrl = "{{ route('brands.update', ':uuid') }}";
                    editUrl = editUrl.replace(':uuid', uuid);
                    updateUrl = updateUrl.replace(':uuid', uuid);
                    // console.log(url, 'url -------------------edit')
                    const form = document.getElementById("editForm");
                    form.setAttribute("action", updateUrl);

                    $.ajax({
                        url: editUrl,
                        type: "GET",
                        data:{}, //id:rowId
                        success: function (data) {
                            console.log('Data------:', data);
                            $('#editName').val(data.name);
                        },
                        error: function (data) {
                            console.log('Error------:', data);

                        }                
                    })
                }

                $('#btnDelete').on('click',function(){
                    // debugger
                    const div1 = document.getElementById("deleteForm");
                    console.log('00000000000000000', div1.getAttribute('action'));
                })

                $('#btnEditSave').on('click',function(){
                    // debugger
                    const div1 = document.getElementById("editForm");
                    console.log('00000000000000000', div1.getAttribute('action'));
                })

                var table = $('#myTable').DataTable({
                    "columnDefs": [
                            { "width": "250px", "targets": 4 },
                            {
                                "targets": 1,
                                "visible": false,
                                "searchable": false
                            },
                        ],
                    processing: false,
                    serverSide: false,
                    autoWidth: false,
                    ajax: "{{ route('brands.index') }}",
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

                $('#myTable tbody').on('click', 'tr', function () {
                    var data = table.row($(this).closest('tr')).data();
                    console.log('uuid---', data);
                    uuid = data['uuid'];
                   
                });

                // $('#myTable tbody').on('click', '.btnEdit', function () {
                //     var data = table.row($(this).closest('tr')).data();
                //     var url = "{{ route('uoms.edit', ':uuid') }}";
                //     uuid = data['uuid'];
                //     url = url.replace(':uuid', uuid);

                //     $.ajax({
                //         url: url,
                //         type: "GET",
                //         data:{}, //id:rowId
                //         success: function (data) {
                //             console.log('Data------:', data);
                //             $('#editName').val(data.name);
                //         },
                //         error: function (data) {
                //             console.log('Error------:', data);

                //         }                
                //     })
                // })

                // $('#btnDelete').on('click', function () {
                //     var url = "{{ route('uoms.destroy', ':uuid') }}";
                //     url = url.replace(':uuid', uuid);
                //     console.log('Url------:', url);
                //     var data = {
                //         _token: '{{csrf_token()}}'
                //     }
                //     $.ajax({
                //         url: url,
                //         type: 'DELETE',
                //         data: data,
                //         success: function (data) {
                //             console.log('Success------:');
                //             var w=window.open('uoms', '_self', '');
                //             w.close();
                            
                //             console.log('Success----1--:');
                //         },
                //         error: function (data) {
                //             console.log('Error------:', data);

                //         }                
                //     })
                // })

                // $('#btnEditSave').click(function(e){
                //     var uuid = uuid;
                //     var url = "{{ route('uoms.update', ':uuid') }}";
                //     url = url.replace(':uuid', uuid);
                //     console.log('Url------:', url);
                //     var data = {
                //         name: $('#editName').val(),
                //         symbol: $('#editSymbol').val(),
                //         unit: $('#editUnit').val(),
                //         _token: '{{csrf_token()}}'
                //     }
                //     $.ajax({
                //         url: url,
                //         type: 'PUT',
                //         data: data,
                //         success: function (data) {
                //             console.log('Success------:');
                //             var w=window.open('uoms', '_self', '');
                //             w.close();

                //             console.log('Success----1--:');
                //         },
                //         error: function (data) {
                //             console.log('Error------:', data);

                //         }                
                //     })
                // })
            });
        </script>
        @endsection
    </x-content>
</x-layout>