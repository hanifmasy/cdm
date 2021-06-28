@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>SF GoPro Detail</h4>
            </div>
            <div style="float: right">
                <a href="{{url('admin/reporting/download-sfgopro/' . Request::segment(5) . '/'. Request::segment(6) . '/' . Request::segment(7) . '/' . Request::segment(8))}}" class="btn btn-md btn-info pull-right">Download</a>                                 
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
                                    <th>Seller ID</th>                                    
                                    <td>Nama Pelanggan</td>
                                    <td>Witel</td>
                                    <td>Datel</td>
                                    <td>Current Total Price</td>                                    
                                    <th>Current Package</th>
                                    <th>Usee TV</th>
                                    <th>Promo</th>
                                    <th>Subscription Month</th>
                                    <th>Channel</th>
                                    <th>Offer Type</th>
                                    <th>Follow Up Time</th>
                                    <th>Nama Seller</th>                                    
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
                { data: 'seller_id', name: 'seller_id' },                
                { data: 'name', name: 'name' },                
                { data: 'witel_str', name: 'witel_str' }, 
                { data: 'datel', name: 'datel' },                               
                { data: 'current_total_price', name: 'current_total_price', class: 'text-right' },                                             
                { data: 'current_package', name: 'current_package', class: 'text-center' },
                { data: 'usee_tv', name: 'usee_tv', class: 'text-center' },
                { data: 'promo', name: 'promo', class: 'text-center' },
                { data: 'subscription_month', name: 'subscription_month', class: 'text-center' },
                { data: 'channel', name: 'channel', class: 'text-center' },
                { data: 'offer_type', name: 'offer_type', class: 'text-center' },                
                { data: 'followup_time', name: 'followup_time' },
                { data: 'nama_seller', name: 'nama_seller' },                
                { data: 'created_at', name: 'created_at' },    
                { data: 'updated_time', name: 'updated_time' },                
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