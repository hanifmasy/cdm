@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection

<!-- upper columns -->
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
                                    <th>Lokasi</th>
                                    <th>Speed Inet</th>
                                    <th>Angka</th>                                                                                                 
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

<!-- Display DataTable -->
@section('content')

<!-- Call data with Laravel for checking first, script js later
     table set location, speed inet, and ...
-->
<div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table table-bordered table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>                             
                                    <th>{{ $queries->witel }}</th>
                                    <th>{{ $queries->speed_pcrf }} </th>
                                    <th></th>                                                                                                 
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

@endsection