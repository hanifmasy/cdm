@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>Prioritas 1 Detail | CT0</h4>
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
                        <table id="order-listing-ct0" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No Inet</th>
                                    <th>NPER</th>
                                    <th>Spec</th>
                                    <th>Status Modem</th>
                                    <th>Detect Usage</th>
                                    <th>Status FUP</th>
                                    <th>Status Gangguan</th>
                                    <th>Usia PS</th>
                                    <th>Last Payment Month</th>
                                    <th>Paket Inet</th>
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
                { data: 'notel', name: 'notel' },               
                { data: 'nper', name: 'nper' },               
                { data: 'spec_text', name: 'spec_text' },               
                { data: 'status_modem_text', name: 'status_modem_text' },               
                { data: 'detect_usage', name: 'detect_usage' },               
                { data: 'status_fup', name: 'status_fup' },               
                { data: 'status_gangguan_text', name: 'status_gangguan_text' },               
                { data: 'usia_ps', name: 'usia_ps' },               
                { data: 'last_payment_month', name: 'last_payment_month' },               
                { 
                    data: 'paket_inet', 
                    name: 'paket_inet',                    
                    render: function ( data, type, row, meta ) {
                        return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                    }
                },             
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 50,
        };
        $('#kt_datatable_search').keyup(function(){  
            table.search($(this).val()).draw();               
        });
        let table = $('#order-listing-ct0').DataTable(dtOverrideGlobals);
    })
</script>
@endsection