@extends('dashboard.app')
@section('activeMenu')
@php
    $activeMenu="transaction";
@endphp
@endsection
@section('customLink')
{{-- <link href="{{url('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"> --}}
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<style>
    /*Form fields*/
    .dataTables_wrapper select,
    .dataTables_wrapper .dataTables_filter input {
        color: #4a5568; 			/*text-gray-700*/
        padding-left: 1rem; 		/*pl-4*/
        padding-right: 1rem; 		/*pl-4*/
        padding-top: .5rem; 		/*pl-2*/
        padding-bottom: .5rem; 		/*pl-2*/
        line-height: 1.25; 			/*leading-tight*/
        border-width: 2px; 			/*border-2*/
        border-radius: .25rem; 		
        border-color: #edf2f7; 		/*border-gray-200*/
        background-color: #edf2f7; 	/*bg-gray-200*/
    }

    /*Row Hover*/
    table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
        background-color: #ebf4ff;	/*bg-indigo-100*/
    }
    
    /*Pagination Buttons*/
    .dataTables_wrapper .dataTables_paginate .paginate_button		{
        font-weight: 700;				/*font-bold*/
        border-radius: .25rem;			/*rounded*/
        border: 1px solid transparent;	/*border border-transparent*/
    }
    
    /*Pagination Buttons - Current selected */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current	{
        color: #fff !important;				/*text-white*/
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); 	/*shadow*/
        font-weight: 700;					/*font-bold*/
        border-radius: .25rem;				/*rounded*/
        background: #667eea !important;		/*bg-indigo-500*/
        border: 1px solid transparent;		/*border border-transparent*/
    }

    /*Pagination Buttons - Hover */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
        color: #fff !important;				/*text-white*/
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 /*shadow*/
        font-weight: 700;					/*font-bold*/
        border-radius: .25rem;				/*rounded*/
        background: #667eea !important;		/*bg-indigo-500*/
        border: 1px solid transparent;		/*border border-transparent*/
    }
    
    /*Add padding to bottom border */
    table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;	/*border-b-1 border-gray-300*/
        margin-top: 0.75em;
        margin-bottom: 0.75em;
    }
    
    /*Change colour of responsive icon*/
    table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
        background-color: #667eea !important; /*bg-indigo-500*/
    }

</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
@endsection

@section('pageheading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{route('transaction.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><h1 class="h3 mb-0 text-white-800">Back</h1></a>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
</div>
@endsection

@section('script')
{{-- <script>
    var datatable=$('#dataTable').DataTable( {
        ajax:{
            url:'{!!url()->current()!!}',
        },
        columns:[
            {data: 'DT_RowIndex', orderable: false, searchable: false },
            {data:'id', name:'id', render: function ( data, type, row, meta ) {
                return '<a href="'+route('transaction.detail',data)+'"><i class="fas fa-eye"></i></a>';
            }},
            {data:'trx_no', name:'trx_no'},
            {data:'payment_status', name:'payment_status'},
            {data:'payment_method_name', name:'payment_method_name'},
            {data:'payment_reff', name:'payment_reff'},
            {data:'total_price', name:'total_price'},
            {data:'payment_date', name:'payment_date'},
            {data:'created_at', name:'created_at'},
        ],
    } );
</script> --}}
@endsection

@section('content')
    {{-- header detail --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary ">Transaction Header</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    {{-- <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>QTY</th>
                            <th>Product Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        <tr>
                            <td>No Reff Transaction</td><td>{{$header[0]->trx_no}}</td>
                        </tr><tr>
                            <td>Payment Status</td><td><button type="button" class="btn btn-{{$header[0]->payment_status=="00" ? 'success':'warning'}} btn-sm">Success</button></td>
                        </tr><tr>
                            <td>Payment Method</td><td>{{$header[0]->payment_method_name}}</td>
                        </tr><tr>
                            <td>Payment Reff</td><td>{{$header[0]->payment_reff}}</td>
                        </tr><tr>
                            <td>Payment Date</td><td>{{$header[0]->payment_date}}</td>
                        </tr><tr>
                            <td>Total Price</td><td>{{$header[0]->total_price}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary ">Transaction Detail</h6>
        </div>
        @if (Session::get('fail'))
        {{Session::get('fail')}}
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>QTY</th>
                            <th>Product Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($detail as $d)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$d->product_name}}</td>
                            <td>{{$d->qty}}</td>
                            <td>{{$d->product_price}}</td>
                            <td>{{$d->product_price*$d->qty}}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
