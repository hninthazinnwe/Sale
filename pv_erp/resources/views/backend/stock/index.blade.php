<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        @stop
        @section('content')
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                All Stocks
            </h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create Stock
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
                                    <th>Barcode</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Wholesale Price</th>
                                    <th>UOM</th>
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
                <form method="POST"action="{{route('stocks.store')}}" tabindex="1">
                @csrf
                {{method_field('POST')}}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-form-label">Name:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group {{ $errors->has('barcode') ? 'has-error' : '' }}">
                        <label class="col-form-label">Barcode:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="barcode">
                    </div>
                    <div class="form-group  {{ $errors->has('buying_price') ? 'has-error' : '' }}">
                        <label class="col-form-label">Buying Price:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="buying_price">
                    </div>
                    <div class="form-group  {{ $errors->has('selling_price') ? 'has-error' : '' }}">
                        <label class="col-form-label">Selling Price:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="selling_price">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Wholesale Price:</label>
                        <input type="text" class="form-control" name="wholesale_price">
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-form-label">UOM<span class="text-danger">*</span></label>
                        <select class="form-control col-md-8" name="uom_id">
                            @foreach ($uoms as $uom)
                            <option value="{{$uom->id}}">{{$uom->name}}</option>
                            @endforeach
                        </select>
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
                    ajax: "{{ route('stocks.index') }}",
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
                            data: 'barcode',
                            name: 'barcode'
                        },
                        {
                            data: 'buying_price',
                            name: 'buying_price'
                        },
                        {
                            data: 'selling_price',
                            name: 'selling_price'
                        },
                        {
                            data: 'wholesale_price',
                            name: 'wholesale_price'
                        },
                        {
                            data: 'uom',
                            name: 'uom'
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
                $('#myTable').show()
            });
        </script>
        @endsection
    </x-content>
</x-layout>