<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <style>
            td.accordion-toggle {
                background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
                cursor: pointer;
            }

            tr.shown td.accordion-toggle {
                background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
            }
        </style>
        @stop
        @section('content')
        <?php 
            $sales = [];
            $stocks = (object) [['code' => '0001','description' => '0001','price' => '200'], ['code' => '0002','description' => 'book','price' => '1000'], ['code' => '0003','description' => 'bag','price' => '10000']];
            
            array_push($sales,['id' => '1', 'date' => '', 'voucher_no'  =>  '00001', 'customer' =>  'Aye Aye', 'total_amount' =>  '', 'discount' =>  '', 'grand_total' =>  '',
            'details' => ['code' => '0001', 'description' => 'book', 'price' => '100', 'qty' =>  '1', 'amount' =>  '100', 'discount' => '', 'total_amount' =>  '']]);
            array_push($sales,['id' => '2', 'date' => '', 'voucher_no'  =>  '00002', 'customer' =>  'Aye Aye', 'total_amount' =>  '', 'discount' =>  '', 'grand_total' =>  '',
            'details' => ['code' => '0001', 'description' => 'apple', 'price' => '100', 'qty' =>  '1', 'amount' =>  '100', 'discount' => '', 'total_amount' =>  '']]);
        ?>
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                Sale List
            </h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                New Sale
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
                                    <th>Date</th>
                                    <th>Voucher No</th>
                                    <th>Customer</th>
                                    <th>Total Amount</th>
                                    <th>Discount</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                <tr>
                                    <td data-toggle="collapse" data-target="#demo-{{ $sale['id']}}" class="accordion-toggle"></td>
                                    <td>{{$loop->index + 1 }}</td>
                                    <td>{{$sale['date']}}</td>
                                    <td>{{$sale['voucher_no']}}</td>
                                    <td>{{$sale['customer']}}</td>
                                    <td>{{$sale['total_amount']}}</td>
                                    <td>{{$sale['discount']}}</td>
                                    <td>{{$sale['grand_total']}}</td>
                                    <td></td>
                                    
                                </tr>
                                <tr class="p">
                                    <td colspan="9" class="hiddenRow p-0">
                                        <div class="accordian-body collapse p-3" id="demo-{{ $sale['id'] }}">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Code</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Discount</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($sale['details'] as $item)
                                                        <tr>
                                                            {{ $item }}
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7">No Logs Found!</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div> 
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <div class="modal bd-example-modal-xl" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <x-modal-xl>
                @section('modal-title')
                <h5 class="modal-title" id="exampleModalScrollableTitle">New Sale</h5>
                @stop
                @section('modal-body')
                <form method="POST"action="{{route('stocks.store')}}" tabindex="1">
                @csrf
                {{method_field('POST')}}
                    <div class="row">
                        <div class="form-group col-sm">
                            <label class="col-form-label">Enter Stock:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="stock">
                        </div>
                        <div class="form-group col-sm">
                            <label class="col-form-label">Price:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-sm">
                            <label class="col-form-label">Qty:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-sm">
                            <label class="col-form-label">Total Amount:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-hover" role="grid" id="stocktable">
                            <thead>
                                <tr class="bg-dark">
                                    <th class="text-white">Code</th>
                                    <th class="text-white">Description</th>
                                    <th class="text-white">Price</th>
                                </tr>
                            </thead>
                            <tbody id="stocklist">
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" role="grid" id="saletable">
                            <thead>
                                <tr class="bg-info">
                                    <th class="text-white">Code</th>
                                    <th class="text-white">Description</th>
                                    <th class="text-white">Price</th>
                                    <th class="text-white">Qty</th>
                                    <th class="text-white">Amount</th>
                                    <th class="text-white">Discount</th>
                                    <th class="text-white">Total Amount</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody id="salelist">
                            </tbody>
                        </table>
                    </div>
            
                @stop
                @section('modal-footer')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                @endsection
                </form>
            </x-modal-xl>
            </div>
        </div>
        @stop
        
        @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
            const stocks = [[code => '0001',description => '0001',price => '200'], 
                            [code => '0002',description => 'book',price => '1000'], 
                            [code => '0003',description => 'bag',price => '10000']];
            $('.accordion-toggle').click(function(){
                $('.hiddenRow').hide();
            
                let self = $(this);
                
                self.parent().next('tr').find('.hiddenRow').show();
            
                //if shows
                let divCollapse =self.parent().next('tr').find('.collapse');
                let show = divCollapse.hasClass('show');

                //remove class show & minus-icon first in all elements
                $('.collapse').removeClass('show');
                $('tr').removeClass('shown');

                //  if elem shows => add again "show" itself
                //  if user click when elem doesn't show => add minus-icon
                if(show)
                    divCollapse.addClass('show');
                else
                    self.parent().addClass('shown');
            });
            $(document).ready(function(){
                $('#stock').on('keydown', function() {
                    var keyword = $('#stock').val();
                    
                    const stock = stocks.map(x => 
                        x.includes('book', 1)
                    );
                    console.log('+++++++++++++++', stock);
                    $('#stocklist').append(`<tr>">
                        <td>${stock[code]}</td>
                        <td>${stock[description]}</td>
                        <td>${stock[price]}</td>
                        </tr>`);
                });
            });
        </script>
        @endsection
    </x-content>
</x-layout>