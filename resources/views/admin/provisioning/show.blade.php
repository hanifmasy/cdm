@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>Provisioning Detail</h4>
            </div>
            <div style="float: right">
                <a href="{{url('admin/performance/download-provisioning/' . Request::segment(5) . '/'. Request::segment(6) . '/' . Request::segment(7) . '/' . Request::segment(8))}}" class="btn btn-md btn-info pull-right">Download</a>                                 
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
                                    <th>Order ID</th>                                    
                                    <td>No Inet</td>
                                    <td>POTS</td>
                                    <td>Nama Pelanggan</td>
                                    <td>No HP</td>
                                    <th>Witel</th>
                                    <th>STO</th>
                                    <th>Item</th>
                                    <th>Status Order</th>
                                    <th>KContact</th>
                                    <th>Segmen</th>
                                    <th>LCAT</th>
                                    <th>CCAT</th>
                                    <th>Segmen Pelanggan</th>
                                    <th>Durasi</th>
                                    <th>Speed Before</th>
                                    <th>Speed Request</th>
                                    <th>Created Date</th>
                                    <th>Status Update</th>                                    
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
                { data: 'order_id', name: 'order_id' },                
                { data: 'internet', name: 'internet' },                
                { data: 'pots', name: 'pots' },                
                { data: 'nama_pelanggan', name: 'nama_pelanggan' },                
                { data: 'no_hp', name: 'no_hp' },                
                { data: 'witel_str', name: 'witel_str' },
                { data: 'sto_str', name: 'sto_str' },
                { data: 'item', name: 'item' },
                { data: 'status_order', name: 'status_order' },
                { 
                    data: 'kcontact', 
                    name: 'kcontact',                    
                    render: function ( data, type, row, meta ) {
                        return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                    }
                },
                { data: 'segmen', name: 'segmen' },
                { data: 'lcat_name', name: 'lcat_name' },
                { data: 'ccat', name: 'ccat' },
                { data: 'plclbl_trems', name: 'plclbl_trems', class: 'text-center'},
                { data: 'durasijam', name: 'durasijam' },
                { data: 'speed_before', name: 'speed_before' },
                { data: 'speed_req', name: 'speed_req' },
                { data: 'create_dtm', name: 'create_dtm' },                
                { data: 'update_dtm', name: 'update_dtm' },                
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 50,
        };
        let table = $('#order-listing').DataTable(dtOverrideGlobals);
        $('#kt_datatable_search').keyup(function(){  
            table.search($(this).val()).draw();               
        });
    });
</script>
@endsection