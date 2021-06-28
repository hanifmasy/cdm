@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Ticket Normal Ongoing
    </div>

    <div class="card-body">
        <form id="filterPerform" type="POST" action="{{route('admin.rewardKaubis.index')}}"
            enctype="multipart/form-data">
            <div class="form-group row">
                <label for="report_month" class="col-md-2 col-form-label">Select Date Range</label>
                <div class="col-sm-3 controls">
                    <input class="form-control" type="text" name="startDate" id="startDate" placeholder="Start Date">
                </div>
                <span style="position: relative; top: 10px"> - </span>
                <div class="col-sm-3 controls">
                    <input class="form-control" type="text" name="endDate" id="endDate" placeholder="End Date">
                </div>
            </div>         


            <div class="col-md-12 offset-2">
                <div class="float-left">
                    <button style="position: relative; right: 5px;" name="searchBtn" id="searchBtn" type="submit"
                        class="btn btn-primary">Filter</button>
                </div>
            </div>
            <br><br>
        </form>

        <hr class="dashed" style="border-top: 3px dashed #bbb">
        <table id="performOrderTable"
            class="table table-bordered table-striped table-hover ajaxTable datatable datatable-rewardKubis"
            width="100%">
            <thead>
                <tr>
                    {{-- <th width="10">

                    </th> --}}
                    <th>
                        Ticket Ongoing
                    </th>
                    <th>
                        Pelanggan Normal
                    </th>                   
                </tr>
            </thead>            
                <tr>
                    <td>Tiket Internet</td>
                    <td>99</td>
                </tr>
                <tr>
                    <td>Tiket Voice</td>
                    <td>99</td>
                </tr>
                <tr>
                    <td>Tiket UseeTV</td>
                    <td>99</td>
                </tr>
                <tfoot>
                    <tr>
                        <th colspan="1" style="text-align:right">Total:</th>
                        <th>99</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent

<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
@endsection