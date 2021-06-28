@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>Racing SVM Detail</h4>
            </div>
            <div style="float: right">
                <a href="{{url('admin/performance/download-racingsvm/' . Request::segment(5) . '/'. Request::segment(6) . '/' . Request::segment(7))}}" class="btn btn-md btn-info pull-right">Download</a>                                 
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
                                    <th>ND Speedy</th>                                    
                                    <td>Inet Telp</td>
                                    <td>Nama</td>
                                    <td>No HP</td>
                                    <td>HP KContact</td>
                                    <td>Email</td>
                                    <th>Witel</th>
                                    <th>Agency</th>
                                    <th>Channel</th>
                                    <th>Status Demand</th>
                                    <th>Citem Speedy</th>
                                    <th>Desc Pack Speedy</th>
                                    <th>Reg Date</th>
                                    <th>Tgl PS</th>
                                    <th>Status SVM</th>
                                    <th>Channel KContact</th>
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
                { data: 'nd_speedy', name: 'nd_speedy' },                
                { data: 'inet_telp', name: 'inet_telp' },                
                { data: 'nama', name: 'nama' },                
                { data: 'hape', name: 'hape' },                
                { data: 'hp_kcontact', name: 'hp_kcontact' },   
                { data: 'email', name: 'email' },                
                { data: 'witel', name: 'witel' },
                { data: 'agency', name: 'agency' },
                { data: 'chanel', name: 'chanel' },
                { data: 'status_demand', name: 'status_demand' },
                { data: 'citem_speedy', name: 'citem_speedy' },
                { data: 'desc_pack_speedy', name: 'desc_pack_speedy' },
                { data: 'reg_date', name: 'reg_date' },
                { data: 'tgl_ps', name: 'tgl_ps' },
                { data: 'status_svm', name: 'status_svm', class: 'text-center' },
                { data: 'channel_kcontack', name: 'channel_kcontack' },
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