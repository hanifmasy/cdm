@extends('layouts.admin')
@section('styles')
<style>
    .table-bordered, tr, th, td{
        border:1px solid black !important;
    }
</style>
@endsection
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>Performansi CSR Plasa</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Periode</label>
                                                <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="periode" id="periode">
                                                    <option value="ALL_PERIODE">{{trans('global.allPeriodeSelect')}}</option>
                                                    @foreach ($periodes as $id => $periode)
                                                    <option value="{{ $periode->report_month }}" {{ old('periode') == $periode->report_month ? 'selected' : '' }}>{{$periode->report_month}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mt-1">
                                            <label for="" style="font-size:14px">Witel</label>
                                            <select class="form-control {{ $errors->has('witel') ? 'is-invalid' : '' }}" name="witel" id="witel">
                                                <option value="ALL_WITEL">{{trans('global.treg6Select')}}</option>
                                                @foreach($witels as $id => $witel)
                                                <option value="{{ $witel->nama_witel }}" {{ old('witel') == $witel->nama_witel ? 'selected' : '' }}>{{$witel->nama_witel}}</option>
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">No.</th>
                                                    {{-- <th class="align-middle">WITEL</th> --}}
                                                    <th style="text-align: left; width: 20%">PLASA (WITEL)</th>
                                                    <th class="align-middle">MIG2P3P</th>
                                                    <th class="align-middle">MINIPACK</th>
                                                    <th class="align-middle" style="width: 10%">STB TAMBAHAN</th>
                                                    <th class="align-middle" style="width: 10%">UPGRADE SPEED</th>
                                                    <th class="align-middle">OTT</th>
                                                    <th class="align-middle">PSB NONKIOS CSR</th>
                                                    <th class="align-middle">PSB KIOS CSR</th>
                                                    <th class="align-middle">PSB KIOS MESIN</th>
                                                    <th class="align-middle" style="width: 10%">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="csr-plasa">

                                            </tbody>
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
<script src="{{ asset('public/js/custom-blockui.js') }}"></script>
<script src="{{ asset('public/js/jquery.blockui.min.js') }}"></script>
<script>
$(document).ready(function(){
    load_content();

    function load_content(periode_val='', witel_val='')
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.performance.plasa_rekapwitel') }}',
            'data': {
                periode: periode_val,
                witel: witel_val
            },
            'beforeSend': function() {
                var block = $('#csr-plasa');
                $(block).block({
                    message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i> Please Wait...</span>',
                    css: {
                        border: 'none',
                        padding: '23px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        width: '200px'
                    }
                });
            },
            'success': function(data) {
                $('#csr-plasa').empty();

                // var date = new Date();
                // var date_now = $('#periode').val() ? $('#periode').val() : date.yyyymm();
                var periode = $('#periode').val() ? $('#periode').val() : 'ALL_PERIODE';
                var witel = $('#witel').val() ? $('#witel').val() : 'ALL_WITEL';

                $.each(data.rekapwitel, function(index,value){

                    var no = index+1;
                    var plasa = value.plasa == "ALL" ? "ALL" : value.plasa + ' ' + '(' +value.witel+ ')';

                    $('#csr-plasa').append(`
                        <tr>
                            <td>`+ no +`</td>
                            <td style="text-align: left">
                                <b>
                                    <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`')}}">`+plasa+`</a>
                                </b>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'MIG2P3P')}}">`+getNumber(value.mig2p3p)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'MINIPACK')}}">`+getNumber(value.minipack)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'STB2')}}">`+getNumber(value.stb_tambahan)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'UPSPEED')}}">`+getNumber(value.upgrade_speed)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'OTT')}}">`+getNumber(value.ott)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'psb_nonkios_csr')}}">`+getNumber(value.psb_nonkios_csr)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'psb_kios_csr')}}">`+getNumber(value.psb_kios_csr)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'psb_kios_mesin')}}">`+getNumber(value.psb_kios_mesin)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/plasa/rekap/detail/' . '`+periode+`' . '/' . '`+witel+`' . '/' . '`+value.plasa+`' . '/' . 'ALL_ADDON')}}">`+getNumber(value.total)+`</a>
                            </td>
                        </tr>
                    `)
                });
            },
            'complete': function(){
                var block = $('#csr-plasa');
                $(block).unblock();
            },
        });
    }

    $('#applyBtn').click(function(e) {
        var periode = $('#periode').val();
        var witel = $('#witel').val();
        e.preventDefault();

        // $('#csr-plasa').empty();
        load_content(periode,witel);

    });
});
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection
