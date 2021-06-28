@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>PDA Detail</h4>
            </div>
            <div style="float: right">
                <a href="{{url('admin/performance/pda/download-pda')}}" class="btn btn-md btn-info pull-right">Download</a>                                 
            </div>  
        </div>         
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search" />                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table datatable" style="width: 100%;">
                            <thead>
                                <tr>                                    
                                    <th>No.</th>
                                    <th>Nama Customer</th>                                    
                                    <th>Kode Sales</th>                                    
                                    <th>Witel</th>                                    
                                    <th>No Inet</th>                                    
                                    <th>Segmen</th>                                    
                                    <th>Type</th>                                    
                                    <th>CCAT</th>                                    
                                    <th>ALAMAT MANUAL</th>                                    
                                    <th>ALAMAT SISTEM</th>                                    
                                    <th>TANGGAL PS</th>                                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        let url = window.location.href;           
        let dtOverrideGlobals = {
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],            
            ajax: url,
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'customer_desc', name: 'customer_desc' },               
                { data: 'create_user_id', name: 'create_user_id' },               
                { data: 'witel_master', name: 'witel_master' },               
                { data: 'internet', name: 'internet' },               
                { data: 'segmen', name: 'segmen' },               
                { data: 'plblcl_trems', name: 'plblcl_trems' },               
                { data: 'ccat', name: 'ccat' },               
                { 
                    data: 'alamat_manual', 
                    name: 'alamat_manual',                    
                    render: function ( data, type, row, meta ) {
                        return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                    }
                },              
                { 
                    data: 'alamat_sistem', 
                    name: 'alamat_sistem',                    
                    render: function ( data, type, row, meta ) {
                        return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                    }
                },              
                { data: 'update_dtm', name: 'update_dtm' },               
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 50,
        };
        $('#kt_datatable_search').keyup(function(){  
            table.search($(this).val()).draw();               
        });
        let table = $('#order-listing').DataTable(dtOverrideGlobals);
    })
</script>
@endsection