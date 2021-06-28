@extends('layouts.admin')
@section('content')
<link href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css" rel="stylesheet" />
<style>
    .search-input {
        border-right: 0;
        border-top: 0;
        border-left: 0;
    }
</style>
<style>
    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 13px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Filters</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="display: inline-block; overflow-y: scroll; max-height: 450px;">
                            <input class="form-control search-input" type="text" placeholder="Search Category">
                            <div class="list-group" style="border: 0px">
                                <a href="#" name="WITEL" onclick="getWitel()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">WITEL</a>
                                <a href="#" name="INDIHOME" onclick="getIndihome()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">JENIS PELANGGAN</a>
                                <a href="#" name="CUSTOMER" onclick="getCustomer()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">SEGMEN PELANGGAN</a>
                                <a href="#" name="REVENUE" onclick="getRevenue()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">KATEGORI PELANGGAN (REVENUE)</a>
                                <a href="#" name="LCAT" onclick="getLcat()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">KATEGORI PELANGGAN (LCAT)</a>
                                <a href="#" name="USIA" onclick="getUsia()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">USIA BERLANGGANAN</a>
                                <a href="#" name="JENIS_USEETV" onclick="getUseetv()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">JENIS USEETV</a>
                                <a href="#" name="MINIPACK" onclick="getMinipack()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">MINIPACK</a>
                                <a href="#" name="IHSMART" onclick="getIHsmart()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">INDIHOME SMART</a>
                                <a href="#" name="SPEED" onclick="getSpeed()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">SPEED INET</a>
                                <a href="#" name="USAGEINET" onclick="getUsageInet()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">USAGE INET</a>
                                {{-- <a href="#" name="USAGETV" onclick="getUsageTv()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">USAGE TV</a> --}}
                                <a href="#" name="ORDERACTIVITY" onclick="getOrderActivity()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">ORDER ACTIVITY</a>                                
                                <a href="#" name="UNSCPEC" onclick="getUnspec()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">UNSPEC</a>
                                <a href="#" name="GANGGAUN" onclick="getGangguan()" class="list-group-item list-group-item-action" style="border: 0px; font-weight: bold;">STATUS GANGGUAN</a>                                
                            </div>
                        </div>
                        <div class="col-md-6" style="display: inline-block; overflow-y: scroll; max-height: 450px;">
                            <input class="form-control search-input" type="text" placeholder="Search Value">
                            <div class="list-group checkbox-list-group" style="border: 0px" id="filter_value">
                                <div id="witel_section" style="display:none;">
                                    @foreach($witels as $id => $witel)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ $witel->nama_witel }}
                                        <input type="checkbox" id="checkbox_{{ $witel->nama_witel }}" name="witel" value="{{ $witel->nama_witel }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="indihome_section" style="display:none;">
                                    @foreach($indihome as $id => $indihome)                                    
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($indihome->indihome) ? "$indihome->indihome" : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ $indihome->indihome }}" name="indihome" value="{{ ($indihome->indihome) ? "$indihome->indihome" : null }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="customer_section" style="display:none;">
                                    @foreach($customer as $id => $customer)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($customer->plblcl_trems) ? "$customer->plblcl_trems" : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ $customer->plblcl_trems }}" name="customer" value="{{ $customer->plblcl_trems }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="revenue_section" style="display:none;">
                                    @foreach($revenue as $id => $revenue)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($revenue->cluster_rev) ? substr($revenue->cluster_rev, strpos($revenue->cluster_rev, "_") + 1) : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{substr($revenue->cluster_rev, strpos($revenue->cluster_rev, "_") + 1)}}" name="revenue" value="{{substr($revenue->cluster_rev, strpos($revenue->cluster_rev, "_") + 1)}}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>                        
                                <div id="lcat_section" style="display:none;">
                                    @foreach($lcat as $id => $lcat)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ 
                                                ($lcat->linecats_item_id == '100') ? "Residensial (100)" :
                                                (($lcat->linecats_item_id == '201') ? "Prime Cluster (201)" :
                                                (($lcat->linecats_item_id == '202') ? "Apartment (202)" :                                    
                                                (($lcat->linecats_item_id == '203') ? "Rusunawa (203)" : "Kost/Rent (204)"))) 
                                            }}
                                        <input type="checkbox" id="checkbox_{{ $lcat->linecats_item_id }}" name="lcat" value="{{ $lcat->linecats_item_id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="useetv_section" style="display:none;">
                                    @foreach($useetv as $id => $useetv)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($useetv->jenis_useetv) ? "$useetv->jenis_useetv" : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $useetv->jenis_useetv) }}" name="useetv" value="{{ $useetv->jenis_useetv }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="gangguan_section" style="display:none;">
                                    @foreach($gangguan as $id => $gangguan)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($gangguan->status_gangguan) ? "$gangguan->status_gangguan" : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ $gangguan->status_gangguan }}" name="gangguan" value="{{ $gangguan->status_gangguan }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="minipack_section" style="display:none;">
                                    @foreach($minipack as $id => $minipack)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($minipack) ? "$minipack" : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ $minipack }}" name="minipack" value="{{ $minipack }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="orderActivity_section" style="display:none;">
                                    @foreach($orderActivity as $id => $orderActivity)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($orderActivity->cluster_group) ? "$orderActivity->cluster_group" : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $orderActivity->cluster_group) }}" name="orderActivity" value="{{ $orderActivity->cluster_group }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>  
                                <div id="speed_section" style="display:none;">
                                    @foreach($speedpcrf as $id => $speedpcrf)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($speedpcrf->cluster_speed_pcrf) ? "$speedpcrf->cluster_speed_pcrf" : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $speedpcrf->cluster_speed_pcrf) }}" name="speed" value="{{ $speedpcrf->cluster_speed_pcrf }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="usia_section" style="display:none;">
                                    @foreach($usia_ps as $id => $usia)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($usia->cluster_usia_ps) ? str_replace('sampai', '-', $usia->cluster_usia_ps) : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $usia->cluster_usia_ps) }}" name="usia" value="{{ $usia->cluster_usia_ps }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="ihsmart_section" style="display:none;">
                                    @foreach($ihsmart as $id => $ihsmart)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($ihsmart->cluster_ih_smart) ? $ihsmart->cluster_ih_smart : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $ihsmart->cluster_ih_smart) }}" name="ihsmart" value="{{ $ihsmart->cluster_ih_smart }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>  
                                <div id="unspec_section" style="display:none;">
                                    @foreach($unspec as $id => $unspec)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($unspec->cluster_unspec) ? $unspec->cluster_unspec : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $unspec->cluster_unspec) }}" name="unspec" value="{{ $unspec->cluster_unspec }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="usageinet_section" style="display:none;">
                                    @foreach($usageinet as $id => $usageinet)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($usageinet->cluster_usage_group) ? str_replace('sampai', '-', $usageinet->cluster_usage_group) : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $usageinet->cluster_usage_group) }}" name="usageinet" value="{{ $usageinet->cluster_usage_group }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>  
                                <div id="usagetv_section" style="display:none;">
                                    @foreach($usagetv as $id => $usagetv)
                                    <div class="list-group-item" style="border: 0px;">
                                    <label class="container">{{ ($usagetv->cluster_usage_tv) ? str_replace('sampai', '-', $usagetv->cluster_usage_tv) : "NULL" }}
                                        <input type="checkbox" id="checkbox_{{ str_replace(' ', '_', $usagetv->cluster_usage_tv) }}" name="usagetv" value="{{ $usagetv->cluster_usage_tv }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    </div>
                                    @endforeach
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Selected Filters</h3>
                </div>
                <div class="card-body" style="display: inline-block; overflow-y: scroll; max-height: 490px;">
                    <div class="list-group" style="border: 0px" id="selected_value">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="content" id="result_value">
                    </div>
                    {{-- <br><br><br> --}}
                    <div class="d-flex justify-content-center button">
                        <a href="{{route('admin.prospect.getexcel')}}" class="btn btn-primary">
                            <h5>Download</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data per Cluster</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">Witel</th>
                            <th colspan="4">Segmen Pelanggan</th>
                            <th colspan="5">Usia Berlangganan</th>
                        </tr>
                        <tr>
                            <th>PL</th>
                            <th>BL</th>
                            <th>CL</th>
                            <th>GL</th>
                            <th>1 - 3 Bln</th>
                            <th>4 - 6 Bln</th>
                            <th>7 - 12 Bln</th>
                            <th>1 - 2 Thn</th>
                            <th>> 2 Thn</th>
                        </tr>
                        <tbody id="manajemen">
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    var witelSelected_val = [];
    var indihomeSelected_val = [];
    var customerSelected_val = [];
    var useetvSelected_val = [];
    var gangguanSelected_val = [];
    var minipackSelected_val = [];
    var orderActivitySelected_val = [];
    var revenueSelected_val = [];
    var lcatSelected_val = [];
    var speedSelected_val = [];
    var usiaSelected_val = [];
    var ihsmartSelected_val = [];
    var unspecSelected_val = [];
    var usageinetSelected_val = [];
    var usagetvSelected_val = [];
    function getWitel() {
        if($('#witel_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "block");  
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");            
            $("#useetv_section").css("display", "none"); 
            $("#gangguan_section").css("display", "none"); 
            $("#minipack_section").css("display", "none");
            $("#orderActivity_section").css("display", "none");
            $("#revenue_section").css("display", "none");
            $("#lcat_section").css("display", "none");
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#witel_section").css("display", "none");
        }
    }
    function getIndihome() {
        if($('#indihome_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");            
            $("#indihome_section").css("display", "block");
            $("#useetv_section").css("display", "none");  
            $("#customer_section").css("display", "none");
            $("#gangguan_section").css("display", "none");
            $("#minipack_section").css("display", "none");
            $("#orderActivity_section").css("display", "none");
            $("#revenue_section").css("display", "none");
            $("#lcat_section").css("display", "none");
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#indihome_section").css("display", "none");
        }
    }
    function getCustomer() {
        if($('#customer_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "block");
            $("#useetv_section").css("display", "none"); 
            $("#gangguan_section").css("display", "none"); 
            $("#minipack_section").css("display", "none");
            $("#orderActivity_section").css("display", "none");
            $("#revenue_section").css("display", "none");
            $("#lcat_section").css("display", "none");
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#customer_section").css("display", "none");
        }
    }
    function getUseetv() {
        if($('#useetv_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "block");  
            $("#gangguan_section").css("display", "none"); 
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");
            $("#revenue_section").css("display", "none");
            $("#lcat_section").css("display", "none");
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#useetv_section").css("display", "none");
        }
    }
    function getGangguan() {
        if($('#gangguan_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "block");  
            $("#minipack_section").css("display", "none");
            $("#orderActivity_section").css("display", "none");
            $("#revenue_section").css("display", "none");
            $("#lcat_section").css("display", "none");
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#gangguan_section").css("display", "none");
        }
    }
    function getMinipack() {
        if($('#minipack_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "block");
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none");
            $("#lcat_section").css("display", "none");
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#minipack_section").css("display", "none");
        }
    }
    function getOrderActivity() {
        if($('#orderActivity_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "block");  
            $("#revenue_section").css("display", "none");
            $("#lcat_section").css("display", "none");
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#orderActivity_section").css("display", "none");
        }
    }
    function getRevenue() {
        if($('#revenue_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "block"); 
            $("#lcat_section").css("display", "none"); 
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#revenue_section").css("display", "none");
        }
    }
    function getLcat() {
        if($('#lcat_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none"); 
            $("#lcat_section").css("display", "block");  
            $("#speed_section").css("display", "none");
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#lcat_section").css("display", "none");
        }
    }
    function getSpeed() {
        if($('#speed_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none"); 
            $("#lcat_section").css("display", "none");  
            $("#speed_section").css("display", "block");  
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#speed_section").css("display", "none");
        }
    }
    function getUsia() {
        if($('#usia_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none"); 
            $("#lcat_section").css("display", "none");  
            $("#speed_section").css("display", "none");  
            $("#usia_section").css("display", "block");  
            $("#ihsmart_section").css("display", "none");
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#usia_section").css("display", "none");
        }
    }
    function getIHsmart() {
        if($('#ihsmart_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none"); 
            $("#lcat_section").css("display", "none");  
            $("#speed_section").css("display", "none");  
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "block");  
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#ihsmart_section").css("display", "none");
        }
    }
    function getUnspec() {
        if($('#unspec_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none"); 
            $("#lcat_section").css("display", "none");  
            $("#speed_section").css("display", "none");  
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none"); 
            $("#unspec_section").css("display", "block"); 
            $("#usageinet_section").css("display", "none"); 
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#unspec_section").css("display", "none");
        }
    }
    function getUsageInet() {
        if($('#usageinet_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none"); 
            $("#lcat_section").css("display", "none");  
            $("#speed_section").css("display", "none");  
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none"); 
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "block");  
            $("#usagetv_section").css("display", "none");
        }
        else{
            $("#usageinet_section").css("display", "none");
        }
    }
    function getUsageTv() {
        if($('#usagetv_section').css('display') == 'none')
        {
            $("#witel_section").css("display", "none");
            $("#indihome_section").css("display", "none");
            $("#customer_section").css("display", "none");
            $("#useetv_section").css("display", "none");  
            $("#gangguan_section").css("display", "none");  
            $("#minipack_section").css("display", "none"); 
            $("#orderActivity_section").css("display", "none");  
            $("#revenue_section").css("display", "none"); 
            $("#lcat_section").css("display", "none");  
            $("#speed_section").css("display", "none");  
            $("#usia_section").css("display", "none");
            $("#ihsmart_section").css("display", "none"); 
            $("#unspec_section").css("display", "none");
            $("#usageinet_section").css("display", "none");  
            $("#usagetv_section").css("display", "block");  
        }
        else{
            $("#usagetv_section").css("display", "none");
        }
    }
    
    function deleteValue(nama_item) {
        $('#checkbox_'+nama_item+'').prop('checked', false);
        $('#item_'+nama_item+'').remove();
        var cleanIndex = '';        
        if(witelSelected_val.includes(nama_item))
        {
            const index = witelSelected_val.indexOf(nama_item);
            if (index > -1) {
                witelSelected_val.splice(index, 1);
            }
        }
        if(nama_item !== null)
        {
            cleanIndex = nama_item+":";
        }
        else{
            cleanIndex = nama_item;
        }
        if(indihomeSelected_val.includes(nama_item))
        {           

            const index = indihomeSelected_val.indexOf(nama_item);
            if (index > -1) {
                indihomeSelected_val.splice(index, 1);
            }
        }
        if(customerSelected_val.includes(nama_item))
        {
            const index = customerSelected_val.indexOf(nama_item);
            if (index > -1) {
                customerSelected_val.splice(index, 1);
            }
        }      
        if(useetvSelected_val.includes(nama_item) == false) {
            useetv_item = nama_item.replace(/_/g, ' ');            
            if (useetvSelected_val.includes(useetv_item)) {
                useetvSelected_val.splice($.inArray(useetv_item, useetvSelected_val),1); 
            }
        } 
        if(gangguanSelected_val.includes(nama_item))
        {
            const index = gangguanSelected_val.indexOf(nama_item);
            if (index > -1) {
                gangguanSelected_val.splice(index, 1);
            }
        }  
        if(minipackSelected_val.includes(nama_item))
        {
            const index = minipackSelected_val.indexOf(nama_item);
            if (index > -1) {
                minipackSelected_val.splice(index, 1);
            }
        }  
        if(orderActivitySelected_val.includes(nama_item) == false) {
            orderActivity_item = nama_item.replace(/_/g, ' ');            
            if (orderActivitySelected_val.includes(orderActivity_item)) {
                orderActivitySelected_val.splice($.inArray(orderActivity_item, orderActivitySelected_val),1); 
            } 
        } else {
            const index = orderActivitySelected_val.indexOf(nama_item);
            if (index > -1) {
                orderActivitySelected_val.splice(index, 1);
            }
        }
        if(revenueSelected_val.includes(nama_item))
        {
            const index = revenueSelected_val.indexOf(nama_item);
            if (index > -1) {
                revenueSelected_val.splice(index, 1);
            }
        }  
        if(lcatSelected_val.includes(nama_item))
        {
            const index = lcatSelected_val.indexOf(nama_item);
            if (index > -1) {
                lcatSelected_val.splice(index, 1);
            }
        }  
        if(speedSelected_val.includes(nama_item) == false) {
            speed_item = nama_item.replace(/_/g, ' ');            
            if (speedSelected_val.includes(speed_item)) {
                speedSelected_val.splice($.inArray(speed_item, speedSelected_val),1); 
            } 
        } else {
            const index = speedSelected_val.indexOf(nama_item);
            if (index > -1) {
                speedSelected_val.splice(index, 1);
            }
        }
        if(usiaSelected_val.includes(nama_item) == false) {
            usia_item = nama_item.replace(/_/g, ' ');            
            if (usiaSelected_val.includes(usia_item)) {
                usiaSelected_val.splice($.inArray(usia_item, usiaSelected_val),1); 
            } 
        } else {
            const index = usiaSelected_val.indexOf(nama_item);
            if (index > -1) {
                usiaSelected_val.splice(index, 1);
            }
        }
        if(ihsmartSelected_val.includes(nama_item) == false) {
            ihsmart_item = nama_item.replace(/_/g, ' ');            
            if (ihsmartSelected_val.includes(ihsmart_item)) {
                ihsmartSelected_val.splice($.inArray(ihsmart_item, ihsmartSelected_val),1); 
            } 
        } else {
            const index = ihsmartSelected_val.indexOf(nama_item);
            if (index > -1) {
                ihsmartSelected_val.splice(index, 1);
            }
        }
        if(unspecSelected_val.includes(nama_item) == false) {
            unspec_item = nama_item.replace(/_/g, ' ');            
            if (unspecSelected_val.includes(unspec_item)) {
                unspecSelected_val.splice($.inArray(unspec_item, unspecSelected_val),1); 
            } 
        } else {
            const index = unspecSelected_val.indexOf(nama_item);
            if (index > -1) {
                unspecSelected_val.splice(index, 1);
            }
        }
        if(usageinetSelected_val.includes(nama_item) == false) {
            usageinet = nama_item.replace(/_/g, ' ');            
            if (usageinetSelected_val.includes(usageinet)) {
                usageinetSelected_val.splice($.inArray(usageinet, usageinetSelected_val),1); 
            } 
        } else {
            const index = usageinetSelected_val.indexOf(nama_item);
            if (index > -1) {
                usageinetSelected_val.splice(index, 1);
            }
        }
        if(usagetvSelected_val.includes(nama_item) == false) {
            usagetv = nama_item.replace(/_/g, ' ');            
            if (usagetvSelected_val.includes(usagetv)) {
                usagetvSelected_val.splice($.inArray(usagetv, usagetvSelected_val),1); 
            } 
        } else {
            const index = usagetvSelected_val.indexOf(nama_item);
            if (index > -1) {
                usagetvSelected_val.splice(index, 1);
            }
        }
        $('#result_value').html(make_skeleton());
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.prospect.index') }}',
            'data': {
                witel: witelSelected_val,
                indihome: indihomeSelected_val,
                customer: customerSelected_val,
                useetv: useetvSelected_val,
                gangguan: gangguanSelected_val,
                minipack: minipackSelected_val,
                orderActivity: orderActivitySelected_val,
                revenue: revenueSelected_val,
                lcat: lcatSelected_val,
                speed: speedSelected_val,
                usia: usiaSelected_val,
                ihsmart: ihsmartSelected_val,
                unspec: unspecSelected_val,
                usageinet: usageinetSelected_val,
                usagetv: usagetvSelected_val
            },
            'success': function(data) {
                $('#result_value').empty();
                $('#result_value')
                    .append(`<br><br><p style="font-size: 43px; font-weight: bold;" class="text-center">` + getNumber(data.customers) + `</p>                    
                        <h5 class="text-center">Customer</h5>                    
                        <br><br><br>           
                        <p style="font-size: 30px; font-weight: bold;" class="text-center">` + getNumber(data.mobiles) + `</p>   
                        <h5 class="text-center">Telephone</h5>                                                 
                        <br><br><br>               
                        <p style="font-size: 30px; font-weight: bold;" class="text-center">` + getNumber(data.email) + `</p>   
                        <h5 class="text-center">Email</h5>
                        <br><br><br>`);
                $('#manajemen').empty();
                $.each(data.manajemen, function(index,value){                    
                    $('#manajemen').append(`
                    <tr>
                        <td>`+getNumber(value.nama_witel)+`</td>
                        <td>`+getNumber(value.pl)+`</td>
                        <td>`+getNumber(value.bl)+`</td>
                        <td>`+getNumber(value.cl)+`</td>
                        <td>`+getNumber(value.gl)+`</td>
                        <td>`+getNumber(value.ub1)+`</td>
                        <td>`+getNumber(value.ub2)+`</td>
                        <td>`+getNumber(value.ub3)+`</td>
                        <td>`+getNumber(value.ub4)+`</td>
                        <td>`+getNumber(value.ub5)+`</td>
                    </tr>`)
                });
            }
        })
    }
    $(document).ready(function() {
        $('#result_value').html(make_skeleton());

        setTimeout(function() {
            load_content();
        }, 3000);

        function load_content(witelSelected_val='',indihomeSelected_val='',customerSelected_val='',useetvSelected_val='',gangguanelected_val='',minipackSelected_val='',orderActivitySelected_val='',revenueSelected_val='',lcatSelected_val='',speedSelected_val='',usiaSelected_val='',ihsmartSelected_val='',unspecSelected_val='',usageinetSelected_val='',usagetvSelected_val='') {
            $.ajax({
                'type': "GET",
                'dataType': "JSON",
                'url': '{{ route('admin.prospect.index') }}',
                'data': {
                    witel: witelSelected_val,
                    indihome: indihomeSelected_val,
                    customer: customerSelected_val,
                    useetv: useetvSelected_val,
                    gangguan: gangguanSelected_val,
                    minipack: minipackSelected_val,
                    orderActivity: orderActivitySelected_val,
                    revenue: revenueSelected_val,
                    lcat: lcatSelected_val,
                    speed: speedSelected_val,
                    usia: usiaSelected_val,
                    ihsmart: ihsmartSelected_val,
                    unspec: unspecSelected_val,
                    usageinet: usageinetSelected_val,
                    usagetv: usagetvSelected_val
                },
                'success': function(data) {
                    $('#result_value').empty();
                    $('#result_value')
                        .append(`<br><br><p style="font-size: 43px; font-weight: bold;" class="text-center">` + getNumber(data.customers) + `</p>                    
                            <h5 class="text-center">Customer</h5>                    
                            <br><br><br>           
                            <p style="font-size: 30px; font-weight: bold;" class="text-center">` + getNumber(data.mobiles) + `</p>   
                            <h5 class="text-center">Telephone</h5>                                                 
                            <br><br><br>             
                            <p style="font-size: 30px; font-weight: bold;" class="text-center">` + getNumber(data.email) + `</p>   
                            <h5 class="text-center">Email</h5>
                            <br><br><br>`);
                    $('#manajemen').empty();                    
                    $.each(data.manajemen, function(index,value){
                        $('#manajemen').append(`
                        <tr>
                            <td>`+getNumber(value.nama_witel)+`</td>
                            <td>`+getNumber(value.pl)+`</td>
                            <td>`+getNumber(value.bl)+`</td>
                            <td>`+getNumber(value.cl)+`</td>
                            <td>`+getNumber(value.gl)+`</td>
                            <td>`+getNumber(value.ub1)+`</td>
                            <td>`+getNumber(value.ub2)+`</td>
                            <td>`+getNumber(value.ub3)+`</td>
                            <td>`+getNumber(value.ub4)+`</td>
                            <td>`+getNumber(value.ub5)+`</td>
                        </tr>`)
                    });
                }
            })
        }
        // witel
        $("input[name='witel']").change(function() {
            var nama_witel = $(this).val();
            if ($(this).is(':checked')) {
                witelSelected_val.push(nama_witel);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+nama_witel+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>WITEL</span>
                            <a onclick="deleteValue('`+nama_witel+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+nama_witel+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    witelSelected_val.splice($.inArray(nama_witel, witelSelected_val),1);
                    $('#item_'+nama_witel+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000); 
            }
        });
        // indihome
        $("input[name='indihome']").change(function() {
            var indihome = $(this).val();                     
            var str = indihome;                  
            if ($(this).is(':checked')) {
                indihomeSelected_val.push(indihome);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>JENIS INDIHOME</span>
                            <a onclick="deleteValue('`+str+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+indihome+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    indihomeSelected_val.splice($.inArray(indihome, indihomeSelected_val),1);
                    $('#item_'+str+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000); 
            }
        });
        // customer
        $("input[name='customer']").change(function() {
            var customer = $(this).val();
            if ($(this).is(':checked')) {
                customerSelected_val.push(customer);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+customer+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>SEGMEN</span>
                            <a onclick="deleteValue('`+customer+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+customer+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    customerSelected_val.splice($.inArray(customer, customerSelected_val),1);
                    $('#item_'+customer+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // useetv
        $("input[name='useetv']").change(function() {
            var useetv = $(this).val();
            var str_useetv = useetv.replace(/ /g,"_");            
            if ($(this).is(':checked')) {
                useetvSelected_val.push(useetv);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_useetv+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>JENIS</span>
                            <a onclick="deleteValue('`+str_useetv+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+useetv+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    useetvSelected_val.splice($.inArray(useetv, useetvSelected_val),1);
                    $('#item_'+str_useetv+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // status gangguan
        $("input[name='gangguan']").change(function() {
            var gangguan = $(this).val();
            if ($(this).is(':checked')) {
                gangguanSelected_val.push(gangguan);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+gangguan+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>STATUS GANGGUAN</span>
                            <a onclick="deleteValue('`+gangguan+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+gangguan+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    gangguanSelected_val.splice($.inArray(gangguan, gangguanSelected_val),1);
                    $('#item_'+gangguan+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // minipack
        $("input[name='minipack']").change(function() {
            var minipack = $(this).val();
            if ($(this).is(':checked')) {
                minipackSelected_val.push(minipack);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+minipack+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>MINIPACK</span>
                            <a onclick="deleteValue('`+minipack+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+minipack+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    minipackSelected_val.splice($.inArray(minipack, minipackSelected_val),1);
                    $('#item_'+minipack+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // order activity
        $("input[name='orderActivity']").change(function() {
            var orderActivity = $(this).val();
            var str_orderActivity = orderActivity.replace(/ /g,"_");            
            if ($(this).is(':checked')) {
                orderActivitySelected_val.push(orderActivity);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_orderActivity+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>ORDER ACTIVITY</span>
                            <a onclick="deleteValue('`+str_orderActivity+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+orderActivity+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    orderActivitySelected_val.splice($.inArray(orderActivity, orderActivitySelected_val),1);
                    $('#item_'+str_orderActivity+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000); 
            }
        });
        // revenue
        $("input[name='revenue']").change(function() {
            var revenue = $(this).val();
            if ($(this).is(':checked')) {
                revenueSelected_val.push(revenue);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+revenue+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>KATEGORI (REVENUE)</span>
                            <a onclick="deleteValue('`+revenue+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+revenue+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    revenueSelected_val.splice($.inArray(revenue, revenueSelected_val),1);
                    $('#item_'+revenue+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // lcat     
        $("input[name='lcat']").change(function() {
            var lcat = $(this).val();
            var str_lcat = lcat == '100' 
                                ? "Residensial" 
                                : lcat == '201' ? "Prime Cluster"
                                : lcat == '202' ? "Apartment"
                                : lcat == '203' ? "Rusunawa" : "Kost/Rent";
            if ($(this).is(':checked')) {
                lcatSelected_val.push(lcat);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+lcat+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>KATEGORI (LCAT)</span>
                            <a onclick="deleteValue('`+lcat+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+str_lcat+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    lcatSelected_val.splice($.inArray(lcat, lcatSelected_val),1);
                    $('#item_'+lcat+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // speed     
        $("input[name='speed']").change(function() {
            var speed = $(this).val();  
            var str_speed = speed.replace(/ /g,"_");                                
            if ($(this).is(':checked')) {
                speedSelected_val.push(speed);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_speed+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>SPEED INET</span>
                            <a onclick="deleteValue('`+str_speed+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+speed+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    speedSelected_val.splice($.inArray(speed, speedSelected_val),1);
                    $('#item_'+str_speed+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // usia     
        $("input[name='usia']").change(function() {
            var usia = $(this).val();  
            var str_usia = usia.replace(/ /g,"_");                               
            if ($(this).is(':checked')) {
                usiaSelected_val.push(usia);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_usia+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>USIA BERLANGGANAN</span>
                            <a onclick="deleteValue('`+str_usia+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+usia+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    usiaSelected_val.splice($.inArray(usia, usiaSelected_val),1);
                    $('#item_'+str_usia+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // ihsmart     
        $("input[name='ihsmart']").change(function() {
            var ihsmart = $(this).val();  
            var str_ihsmart = ihsmart.replace(/ /g,"_");                        
            if ($(this).is(':checked')) {
                ihsmartSelected_val.push(ihsmart);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_ihsmart+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>INDIHOME SMART</span>
                            <a onclick="deleteValue('`+str_ihsmart+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+ihsmart+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    ihsmartSelected_val.splice($.inArray(ihsmart, ihsmartSelected_val),1);
                    $('#item_'+str_ihsmart+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // unspec     
        $("input[name='unspec']").change(function() {
            var unspec = $(this).val();  
            var str_unspec = unspec.replace(/ /g,"_");                        
            if ($(this).is(':checked')) {
                unspecSelected_val.push(unspec);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_unspec+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>UNSPEC</span>
                            <a onclick="deleteValue('`+str_unspec+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+unspec+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    unspecSelected_val.splice($.inArray(unspec, unspecSelected_val),1);
                    $('#item_'+str_unspec+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // usage inet    
        $("input[name='usageinet']").change(function() {
            var usageinet = $(this).val();  
            var str_usageinet = usageinet.replace(/ /g,"_");  
            var str_inet = usageinet.replace(/sampai/g,"-");              
            if ($(this).is(':checked')) {
                usageinetSelected_val.push(usageinet);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_usageinet+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>USAGE INET</span>
                            <a onclick="deleteValue('`+str_usageinet+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+str_inet+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    usageinetSelected_val.splice($.inArray(usageinet, usageinetSelected_val),1);
                    $('#item_'+str_usageinet+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
        // usage tv    
        $("input[name='usagetv']").change(function() {
            var usagetv = $(this).val();  
            var str_usagetv = usagetv.replace(/ /g,"_");  
            var str_tv = usagetv.replace(/sampai/g,"-");              
            if ($(this).is(':checked')) {
                usagetvSelected_val.push(usagetv);
                $('#selected_value')
                .append(`<div class="list-group-item list-group-item-action" id="item_`+str_usagetv+`" style="border: 0px; font-weight: bold;">
                    <div class="content">
                        <span>USAGE TV</span>
                            <a onclick="deleteValue('`+str_usagetv+`')" style="float: right; color: red; cursor: pointer">
                                <i class="mdi mdi-delete"></i>
                            </a>
                            <br>
                            <span class="text-secondary" style="font-size: 12px">`+str_tv+`</span>
                    </div>
                </div>`);
                $('#result_value').html(make_skeleton());

                setTimeout(function() {
                    load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                }, 3000);
                }else{
                    usagetvSelected_val.splice($.inArray(usageinet, usagetvSelected_val),1);
                    $('#item_'+str_usagetv+'').remove();
                    $('#result_value').html(make_skeleton());
                    setTimeout(function() {
                        load_content(witelSelected_val,indihomeSelected_val,customerSelected_val,useetvSelected_val,gangguanSelected_val,minipackSelected_val,orderActivitySelected_val,revenueSelected_val,lcatSelected_val,speedSelected_val,usiaSelected_val,ihsmartSelected_val,unspecSelected_val,usageinetSelected_val,usagetvSelected_val);
                    }, 
                    3000);  
            }
        });
    });
    function make_skeleton() {
        var output = '';
        for (var count = 0; count < 1; count++) {
            output += '<div class="ph-item" style="border:0px;">';
            output += '<div class="ph-col-12">';
            output += '<div class="ph-row">';
            output += '<div class="ph-col-12 big"></div>';
            output += '<div class="ph-col-8 text-center"></div>';
            output += '</div>';
            output += '<br>';
            output += '<br>';
            output += '<div class="ph-row">';
            output += '<div class="ph-col-12 big"></div>';
            output += '<div class="ph-col-8"></div>';
            output += '</div>';
            output += '<br>';
            output += '<br>';
            output += '<div class="ph-row">';
            output += '<div class="ph-col-12 big"></div>';
            output += '<div class="ph-col-8"></div>';
            output += '</div>';
            output += '</div>';
        }
        return output;
    }
    function getNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endsection