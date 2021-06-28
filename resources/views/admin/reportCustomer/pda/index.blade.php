@extends('layouts.admin')
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>PDA</h4>
                    </div>                
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <div class="row">                                    
                                        <div class="col-md-5 mt-1">
                                            <label for="years" style="font-size:14px">Tahun PS</label>
                                            <select class="form-control" name="years" id="years">
                                                @foreach($years as $row)
                                                    <option value={{ $row }} selected>{{ $row }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <button type="button" class="btn btn-info mr-2" id="applyBtn" style="margin-top: 10px">Filter</button>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>                                    
                    </div> 
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-md table-bordered" id="reportPda" style="font-size: 12px;font-weight:bold;color:black;">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle text-center" id="headerName">WITEL</th>
                                                    <th colspan="12" class="align-middle text-center">REPORT PDA</th>
                                                    <tr>
                                                        <th class="align-middle text-center">JANUARI</th>
                                                        <th class="align-middle text-center">FEBRUARI</th>
                                                        <th class="align-middle text-center">MARET</th>
                                                        <th class="align-middle text-center">APRIL</th>
                                                        <th class="align-middle text-center">MEI</th>
                                                        <th class="align-middle text-center">JUNI</th>
                                                        <th class="align-middle text-center">JULI</th>
                                                        <th class="align-middle text-center">AGUSTUS</th>
                                                        <th class="align-middle text-center">SEPTEMBER</th>
                                                        <th class="align-middle text-center">OKTOBER</th>
                                                        <th class="align-middle text-center">NOVEMBER</th>
                                                        <th class="align-middle text-center">DESEMBER</th>
                                                    </tr>
                                                </tr>
                                            </thead>
                                            <tbody id="sumreportPda"></tbody>
                                            <tfoot id="totalSumPed"></tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    var tahun = $('#years').val();
    var link = "{{ route('admin.performance.pda') }}"
    load_content(tahun);

    function load_content(tahun=''){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url     : link,
            type    : "GET",
            data    : {
                tahun : tahun,
            },
            success : function(response) {
                $('#sumreportPda').empty();
                $('#totalSumPed').empty();
                var total_bln1 = 0;var total_bln2 = 0;var total_bln3 = 0;var total_bln4 = 0;var total_bln5 = 0;var total_bln6 = 0;var total_bln7 = 0;var total_bln8 = 0;var total_bln9 = 0;var total_bln10 = 0;var total_bln11 = 0;var total_bln12 = 0;
                $(response).each(function(index,val){
                    total_bln1 = total_bln1 + val.bln_1;total_bln2 = total_bln2 + val.bln_2;total_bln3 = total_bln3 + val.bln_3;total_bln4 = total_bln4 + val.bln_4;total_bln5 = total_bln5 + val.bln_5;total_bln6 = total_bln6 + val.bln_6;
                    total_bln7 = total_bln7 + val.bln_7;total_bln8 = total_bln8 + val.bln_8;total_bln9 = total_bln9 + val.bln_9;total_bln10 = total_bln10 + val.bln_10; total_bln11 = total_bln11 + val.bln_11;total_bln12 = total_bln12 + val.bln_12;
                    $('#sumreportPda').append(`
                        <tr>
                            <td style="font-weight:bold;">`+val.witel_master+`</td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=01&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_1+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=02&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_2+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=03&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_3+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=04&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_4+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=05&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_5+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=06&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_6+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=07&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_7+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=08&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_8+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=09&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_9+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=10&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_10+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=11&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_11+`</a></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=12&witel=`+val.witel_master+`" style="font-weight:bold;" >`+val.bln_12+`</a></td>
                        </tr>
                    `);
                });
                $('#totalSumPed').append(`
                    <tr>
                        <th style="font-weight:bold;">Total</th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=01" style="font-weight:bold;" >`+total_bln1+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=02" style="font-weight:bold;" >`+total_bln2+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=03" style="font-weight:bold;" >`+total_bln3+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=04" style="font-weight:bold;" >`+total_bln4+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=05" style="font-weight:bold;" >`+total_bln5+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=06" style="font-weight:bold;" >`+total_bln6+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=07" style="font-weight:bold;" >`+total_bln7+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=08" style="font-weight:bold;" >`+total_bln8+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=09" style="font-weight:bold;" >`+total_bln9+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=10" style="font-weight:bold;" >`+total_bln10+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=11" style="font-weight:bold;" >`+total_bln11+`</a></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=12" style="font-weight:bold;" >`+total_bln12+`</a></th>
                    </tr>
                `);
            },
        });
    }

    $('#applyBtn').click(function(){
        tahun = $('#years').val();
        load_content(tahun);
    });

})
</script>
@endsection