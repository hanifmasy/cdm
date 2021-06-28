@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>CSR Plasa Detail</h4>
            </div>
            <div style="float: right">
                @if(Request::segment(10) != '')
                    <a href="{{url('admin/performance/plasa/download-rekap/csr/' . Request::segment(6) . '/'. Request::segment(7) . '/' . Request::segment(8) . '/' . Request::segment(9) . '/' . Request::segment(10))}}" class="btn btn-md btn-info pull-right">Download</a>       
                @else
                    <a href="{{url('admin/performance/plasa/download-rekap/detail/' . Request::segment(6) . '/'. Request::segment(7) . '/' . Request::segment(8) . '/' . Request::segment(9))}}" class="btn btn-md btn-info pull-right">Download</a>       
                @endif                          
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
                                    <th>Periode</th>                                    
                                    <td>No Inet</td>
                                    <td>Kode Sales</td>
                                    <td>Nama Sales</td>
                                    <td>Witel</td>                                    
                                    <th>Plasa</th>
                                    <th>STO</th>
                                    <th>Addon</th>
                                    <th>CCAT</th>
                                    <th>COPER</th>
                                    <th>KContact</th>
                                    <th>Tgl PS</th>                                                                                                 
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
                { data: 'report_month', name: 'report_month'},                
                { data: 'nd_speedy', name: 'nd_speedy'},                
                { data: 'kode_sales_v2', name: 'kode_sales_v2', orderable: false},                
                { data: 'nama', name: 'nama' },                
                { data: 'witel', name: 'witel' }, 
                { data: 'plasa', name: 'plasa' },                                                                                         
                { data: 'sto', name: 'sto' },
                { data: 'addon', name: 'addon', class: 'text-center' },
                { data: 'ccat', name: 'ccat', class: 'text-center' },
                { data: 'coper', name: 'coper', class: 'text-center' },
                { 
                    data: 'kcontact', 
                    name: 'kcontact',                    
                    render: function ( data, type, row, meta ) {
                        return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                    }
                },
                { data: 'tgl_ps', name: 'tgl_ps', orderable: true},       
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