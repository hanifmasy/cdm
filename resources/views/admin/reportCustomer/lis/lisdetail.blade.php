@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>Lis Kwadran Detail</h4>
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
                        <table id="order-listing" class="table table-bordered table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>                                    
                                    <th>No.</th>
                                    <th>No Inet</th>                                    
                                    <td>ND Reference</td>
                                    <td>Plblcl Trems</td>
                                    <td>Nama Pelanggan</td>
                                    <td>Revenue Trems</td>                                    
                                    <th>Rev Trems Ncli</th>
                                    <th>Speed Inet</th>
                                    <th>Speed Pcrf</th>
                                    <th>Kuota Speed Ncx</th>
                                    <th>Usage Inet Current Month</th>
                                    <th>Usage Inet Last Month</th>
                                    <th>Alpro RXPowerOnu</th>                                                                                          
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
    $(function () {
        let url = window.location.href;           
        let dtOverrideGlobals = {
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],            
            ajax: url,
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'notel', name: 'notel'},
                { data: 'nd_reference', name: 'nd_reference'},
                { data: 'plblcl_trems', name: 'plblcl_trems'},
                { data: 'nama_plggn', name: 'nama_plggn'},
                { data: 'revenue_trems', name: 'revenue_trems'},
                { data: 'rev_trems_ncli', name: 'rev_trems_ncli'},
                { data: 'speed_inet', name: 'speed_inet'},
                { data: 'speed_pcrf', name: 'speed_pcrf'},
                { data: 'kuota_speed_ncx', name: 'kuota_speed_ncx'},
                { data: 'usage_inet_current_month', name: 'usage_inet_current_month'},
                { data: 'usage_inet_last_month', name: 'usage_inet_last_month'},
                { data: 'alpro_rxpoweronu', name: 'alpro_rxpoweronu'},
            ],       
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 50,
        };
        $('#kt_datatable_search').keyup(function(){  
            table.search($(this).val()).draw();               
        });
        let table = $('#order-listing').DataTable(dtOverrideGlobals);
    });
</script>
@endsection