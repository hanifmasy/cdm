@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="card">
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
        <div class="col-10">
            <div class="table-responsive">
                <table id="order-listing" class="table table-hover table-bordered datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Witel</th>
                            <th>Datel</th>
                            <th>Speed</th>
                            <th>Usage Inet</th>
                            <th>Update Date</th>
                        </tr>
                    </thead>
                </table>
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
            columns:[
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'id', name: 'id', orderable: false},
                {data: 'nama_plggn', name: 'nama_plggn'},
                {data: 'no_hp', name: 'no_hp'},
                {data: 'alamat', name: 'alamat'},
                {data: 'email', name: 'email'},
                {data: 'witel_str', name: 'witel_str'},
                {data: 'datel_str', name: 'datel_str'},
                {data: 'speed_pcrf', name: 'speed_pcrf'},
                {data: 'usage_inet', name: 'usage_inet'},
                {data: 'update_date', name: 'update_date', orderable: true},
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