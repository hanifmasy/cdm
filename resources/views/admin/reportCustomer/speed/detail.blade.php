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
                                    <th>No Inet</th>
                                    <th>Nama Pelanggan</th>
                                    <th>ND Reference</th>
                                    <th>Plblcl Trems</th>
                                    <th>Revenue Trems</th>
                                    <th>Speed Inet</th>
                                    <th>Usage Inet Current Month</th>
                                    <th>Usage Inet Last Month</th>
                                    <th>Alpro RXPoweronu</th>
                                </tr>
                            </thead>
                        </table>
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
                        data: 'notel',
                        name: 'notel',
                        orderable: false
                    },
                    {
                        data: 'nama_plggn',
                        name: 'nama_plggn',
                        orderable: false
                    },
                    {
                        data: 'nd_reference',
                        name: 'nd_reference'
                    },
                    {
                        data: 'plblcl_trems',
                        name: 'plblcl_trems'
                    },
                    {
                        data: 'revenue_trems',
                        name: 'revenue_trems'
                    },
                    {
                        data: 'speed_inet',
                        name: 'speed_inet'
                    },
                    {
                        data: 'usage_inet_current_month',
                        name: 'usage_inet_current_month',
                        orderable: true
                    },
                    {
                        data: 'usage_inet_last_month',
                        name: 'usage_inet_last_month',
                        orderable: true
                    },
                    {
                        data: 'alpro_rxpoweronu',
                        name: 'alpro_rxpoweronu'
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