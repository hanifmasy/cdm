@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>Performansi CSR Plasa</h4>
            </div>
            <div style="float: right">
                <a href="{{url('admin/performance/plasa/download-rekap/' . Request::segment(5) . '/'. Request::segment(6) . '/' . Request::segment(7))}}" class="btn btn-md btn-info pull-right">Download</a>                                 
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
                                    <th>Kode Sales</th>                                    
                                    <td>Nama</td>
                                    <td>Witel</td>
                                    <td>Plasa</td>
                                    <td>Status</td>                                    
                                    <th>Mig2P3P</th>
                                    <th>Minipack</th>
                                    <th>STB</th>
                                    <th>Upgrade</th>
                                    <th>OTT</th>
                                    <th>PSB 2P</th>
                                    <th>PSB 3P</th>
                                    <th>Total</th>                                                                                                    
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
                { data: 'kode_sales_v2', name: 'kode_sales_v2', orderable: false},                
                { data: 'nama', name: 'nama' },                
                { data: 'witel', name: 'witel' }, 
                { data: 'plasa', name: 'plasa' },                                                                                         
                { data: 'status', name: 'status' },
                { data: 'mig2p3p', name: 'mig2p3p', class: 'text-center' },
                { data: 'minipack', name: 'minipack', class: 'text-center' },
                { data: 'stb_tambahan', name: 'stb_tambahan', class: 'text-center' },
                { data: 'upgrade_speed', name: 'upgrade_speed', class: 'text-center' },               
                { data: 'ott', name: 'ott', class: 'text-center'},
                { data: 'psb_2p', name: 'psb_2p', class: 'text-center' },                
                { data: 'psb_3p', name: 'psb_3p', class: 'text-center'},
                { data: 'total', name: 'total', class: 'text-center', orderable: true},                                               
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