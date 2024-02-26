<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        @stop
        @section('content')
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                All Customers
            </h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create Customer
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
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Address</th>
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
            <x-modal>
                @section('modal-title')
                <h5 class="modal-title" id="exampleModalScrollableTitle">Create Customer</h5>
                @stop
                @section('modal-body')
                <form method="POST"action="{{route('customers.store')}}" tabindex="1">
                @csrf
                {{method_field('POST')}}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-form-label">Name:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group  {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label class="col-form-label">Phone:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group  {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label class="col-form-label">Address:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Contact Person:</label>
                        <input type="text" class="form-control" name="contact_person">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email:</label>
                        <input type="text" class="form-control" name="email">
                    </div>
            
                @stop
                @section('modal-footer')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                @endsection
                </form>
            </x-modal>
            </div>
        </div>
        @stop
        
        @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
 
            $(document).ready(function() {
                var table = $('#myTable').DataTable({
                    "columnDefs": [
                            { "width": "150px", "targets": 7 }
                        ],
                    processing: false,
                    serverSide: false,
                    autoWidth: false,
                    ajax: "{{ route('customers.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
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
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'contact_person',
                            name: 'contact_person'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'address',
                            name: 'address'
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