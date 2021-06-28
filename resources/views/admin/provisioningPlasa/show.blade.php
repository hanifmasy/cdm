@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>Provisioning Plasa Detail</h4>
            </div>
            <div style="float: right">
                <a href="{{url('admin/performance/download-provisioning-plasa/' . Request::segment(6) . '/'. Request::segment(7) . '/' . Request::segment(8) . '/' . Request::segment(9))}}" class="btn btn-md btn-info pull-right">Download</a>                                 
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
                                    <td>Create User ID</td>
                                    <td>Nama Pelanggan</td>                                    
                                    <th>Witel</th>
                                    <th>STO</th>
                                    <th>Item</th>
                                    <th>Status Order</th>
                                    <th>KContact</th>
                                    <th>LCAT</th>
                                    <th>Order Type</th>
                                    <th>Durasi</th>                                    
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
                { data: 'create_user_id', name: 'create_user_id' },                               
                { data: 'nama_pelanggan', name: 'nama_pelanggan' },                                             
                { data: 'witel_str', name: 'witel_str' },
                { data: 'sto', name: 'sto' },
                { data: 'item', name: 'item' },
                { data: 'status_order', name: 'status_order' },
                { 
                    data: 'kcontact', 
                    name: 'kcontact',                    
                    render: function ( data, type, row, meta ) {
                        return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                    }
                },
                { data: 'lcat', name: 'lcat' },
                { data: 'order_type_id', name: 'order_type_id', class: 'text-center' },                
                { data: 'durasijam', name: 'durasijam' },
                { data: 'create_dtm', name: 'create_dtm' },                
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
    });
</script>
@endsection