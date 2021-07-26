@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="card">
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
                        <table id="order-listing" class="table table-hover table-bordered datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID</th>
                                    <th>Customer ID</th>
                                    <th>Seller ID</th>
                                    <th>Package</th>
                                    <th>Price</th>
                                    <th>Offer Type</th>
                                    <th>Offer Subtype</th>
                                    <th>Offer Price</th>
                                    <th>Status</th>
                                    <th>Order Status</th>
                                    <th>SC Number</th>
                                    <th>Message</th>
                                    <th>Source</th>
                                    <th>Source Phone</th>
                                    <th>Attachment</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Update Time</th>
                                    <th>Primary Key</th>
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
    $(function() {
        let url = window.location.html;
        let dtOverrideGlobals = {
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: url,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'customer_id',
                    name: 'customer_id'
                },
                {
                    data: 'seller_id',
                    name: 'seller_id'
                },
                {
                    data: 'from_package',
                    name: 'from_package'
                },
                {
                    data: 'from_price',
                    name: 'from_price'
                },
                {
                    data: 'offer_type',
                    name: 'offer_type'
                },
                {
                    data: 'offer_subtype',
                    name: 'offer_subtype'
                },
                {
                    data: 'offer_price',
                    name: 'offer_price'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'order_status',
                    name: 'order_status'

                },
                {
                    data: 'sc_number',
                    name: 'sc_number'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'source',
                    name: 'source'
                },
                {
                    data: 'source_phone',
                    name: 'source_phone'
                },
                {
                    data: 'attachment',
                    name: 'attachment'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'updatetime',
                    name: 'updatetime'
                },
                {
                    data: 'primarykey',
                    name: 'primarykey'
                },
            ],
            orderCellsTop: true,
            order: [
                [1, 'desc']
            ],
            pageLength: 50,
        };
        $('#kt_datatable_search').keyup(function() {
            table.search($(this).val()).draw();
        });
        let table = $('#order-listing').DataTable(dtOverrideGlobals);
    });
</script>
@endsection