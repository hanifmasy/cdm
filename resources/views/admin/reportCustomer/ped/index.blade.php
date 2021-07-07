@extends('layouts.admin')
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>ADDON</h4>
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
                                        <div class="col-md-5 mt-1">
                                            <label for="" style="font-size:14px">Addon</label>
                                            <select class="form-control {{ $errors->has('addon') ? 'is-invalid' : '' }}" name="addon" id="addon">   
                                                <option value="MIGHW2P">MIG1P2P HOMEWIFI</option>
                                                <option value="MIG2P3P">MIG2P3P NONINDIBOX</option>
                                                <option value="STB2">STB TAMBAHAN</option>
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
                                        <table class="table table-md table-bordered" id="reportADDON" style="font-size: 12px;font-weight:bold;color:black;">
                                            <thead>
                                                <tr>
                                                    <th rowspan="3" class="align-middle text-center" id="headerName">WITEL</th>
                                                    <th colspan="24" class="align-middle text-center">REPORT PED</th>
                                                    <tr>
                                                        <th colspan="2" class="align-middle text-center">JANUARI</th>
                                                        <th colspan="2" class="align-middle text-center">FEBRUARI</th>
                                                        <th colspan="2" class="align-middle text-center">MARET</th>
                                                        <th colspan="2" class="align-middle text-center">APRIL</th>
                                                        <th colspan="2" class="align-middle text-center">MEI</th>
                                                        <th colspan="2" class="align-middle text-center">JUNI</th>
                                                        <th colspan="2" class="align-middle text-center">JULI</th>
                                                        <th colspan="2" class="align-middle text-center">AGUSTUS</th>
                                                        <th colspan="2" class="align-middle text-center">SEPTEMBER</th>
                                                        <th colspan="2" class="align-middle text-center">OKTOBER</th>
                                                        <th colspan="2" class="align-middle text-center">NOVEMBER</th>
                                                        <th colspan="2" class="align-middle text-center">DESEMBER</th>
                                                    </tr>
                                                    <tr>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                        <th>SS</th>
                                                        <th>Rupiah</th>
                                                    </tr>
                                                </tr>
                                            </thead>
                                            <tbody id="sumReportPed"></tbody>
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
    var addon = $('#addon').val();
    var link = "{{ route('admin.performance.ped') }}"
    load_content(tahun,addon);

    function load_content(tahun='',addon=''){
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
                addon : addon
            },
            success : function(response) {
                $('#sumReportPed').empty();
                $('#totalSumPed').empty();
                var total_bln1 = 0;var total_bln2 = 0;var total_bln3 = 0;var total_bln4 = 0;var total_bln5 = 0;var total_bln6 = 0;var total_bln7 = 0;var total_bln8 = 0;var total_bln9 = 0;var total_bln10 = 0;var total_bln11 = 0;var total_bln12 = 0;
                $(response).each(function(index,val){
                    total_bln1 = total_bln1 + val.bln_1;total_bln2 = total_bln2 + val.bln_2;total_bln3 = total_bln3 + val.bln_3;total_bln4 = total_bln4 + val.bln_4;total_bln5 = total_bln5 + val.bln_5;total_bln6 = total_bln6 + val.bln_6;
                    total_bln7 = total_bln7 + val.bln_7;total_bln8 = total_bln8 + val.bln_8;total_bln9 = total_bln9 + val.bln_9;total_bln10 = total_bln10 + val.bln_10; total_bln11 = total_bln11 + val.bln_11;total_bln12 = total_bln12 + val.bln_12;
                    $('#sumReportPed').append(`
                        <tr>
                            <td style="font-weight:bold;">`+getWitel(val.c_witel)+`</td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=01&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_1)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_1 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=02&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_2)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_2 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=03&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_3)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_3 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=04&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_4)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_4 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=05&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_5)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_5 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=06&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_6)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_6 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=07&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_7)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_7 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=08&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_8)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_8 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=09&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_9)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_9 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=10&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_10)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_10 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=11&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_11)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_11 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                            <td><a href="`+link+`/show?tahun=`+tahun+`&bln=12&addon=`+addon+`&witel=`+val.c_witel+`" style="font-weight:bold;" >`+formatNumber(val.bln_12)+`</a></td>
                            <td><span">Rp. `+formatNumber(val.bln_12 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></td>
                        </tr>
                    `);
                });
                $('#totalSumPed').append(`
                    <tr>
                        <th style="font-weight:bold;">Total</th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=01&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln1)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln1 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=02&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln2)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln2 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=03&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln3)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln3 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=04&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln4)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln4 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=05&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln5)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln5 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=06&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln6)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln6 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=07&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln7)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln7 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=08&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln8)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln8 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=09&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln9)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln9 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=10&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln10)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln10 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=11&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln11)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln11 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                        <th><a href="`+link+`/show?tahun=`+tahun+`&bln=12&addon=`+addon+`" style="font-weight:bold;" >`+formatNumber(total_bln12)+`</a></th>
                        <th><span>Rp. `+formatNumber(total_bln12 * ((addon == "MIGHW2P") ? 74632 : (addon == "MIG2P3P") ? 88805 : 93805))+`</span></th>
                    </tr>
                `);
            },
        });
    }

    $('#applyBtn').click(function(){
        tahun = $('#years').val();
        addon = $('#addon').val();
        load_content(tahun,addon);
    });

    function getWitel(witel) {
        var text;
        switch(witel) {
            case "42":
            text = "KALBAR";
            break;
            case "43":
            text = "KALTENG";
            break;
            case "44":
            text = "KALSEL";
            break;
            case "45":
            text = "BALIKPAPAN";
            break;
            case "46":
            text = "SAMARINDA";
            break;
            case "47":
            text = "KALTARA";
            break;
            default:
            text = "";
        }
        return text;
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    } 
})
</script>
@endsection