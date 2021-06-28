@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.permission.title_singular') }} {{ trans('global.list') }}
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

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission" style="text-align:center;">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">Tiket Ongoing</th>
                        <th rowspan="2" class="align-middle">Billing OK, Jaringan NOK</th>
                        <th colspan="3" class="align-middle">Billing NOK, Jaringan OK</th>
                        <th colspan="2" class="align-middle">Billing NOK, Jaringan NOK</th>
                    </tr>
                    <tr>
                        <th>Anomali Billing</th>
                        <th>Pra-CT0</th>
                        <th>CT0</th>
                        <th>Pra-CT0</th>
                        <th>CT0</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiket Internet</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                    </tr>
                    <tr>
                        <td>Tiket Voice</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                    </tr>
                    <tr>
                        <td>Tiket UseeTV</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                        <td>99</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection