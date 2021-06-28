@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>Addon Detail</h4>
            </div>
            <div style="float: right">
                <a href="{{url('admin/performance/ped/download-ped')}}" class="btn btn-md btn-info pull-right">Download</a>                                 
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
                                    <th>No Inet</th>                                    
                                    <th>Addon</th>                                    
                                    <th>NDEM</th>                                    
                                    <th>Kcontact</th>                                    
                                    <th>Channel</th>                                    
                                    <th>CCAT</th>                                    
                                    <th>Tematik</th>                                    
                                    <th>Item</th>                                    
                                    <th>Cpack</th>                                    
                                    <th>Price PSB</th>                                    
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
                { data: 'ndinet', name: 'ndinet' },               
                { data: 'addon', name: 'addon' },               
                { data: 'ndem', name: 'ndem' },               
                { 
                    data: 'kcontact', 
                    name: 'kcontact',                    
                    render: function ( data, type, row, meta ) {
                        return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                    }
                },             
                { data: 'chanel', name: 'chanel' },               
                { data: 'ccat', name: 'ccat' },               
                { data: 'tematik', name: 'tematik' },               
                { data: 'item', name: 'item' },               
                { data: 'cpack', name: 'cpack' },               
                { data: 'price_psb', name: 'price_psb' },               
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