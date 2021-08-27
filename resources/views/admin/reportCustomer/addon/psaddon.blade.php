@extends('layouts.admin')
@section('content')
<style>
    tr,
    th,
    td {
        border: 1px solid black;
    }
</style>
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>PS Addon Daily</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- ALL ADDON -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">ALL ADDON</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow FM</th>
                                                    <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow MTD</th>
                                                    <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YFM</th>
                                                    <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YTD</th>
                                                </tr>
                                                <tr>
                                                    <th>MTD</th>
                                                    <th>Full</th>
                                                    <th>Target FM</th>
                                                    <th>REAL</th>
                                                    <th>ACH</th>
                                                    <th>YTD</th>
                                                    <th>Full</th>
                                                    <th>Target FY</th>
                                                    <th>ACH FY</th>
                                                    <th>Target YTD</th>
                                                    <th>REAL</th>
                                                    <th>ACH YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody id="alladdon">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Minipack -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">MINIPACK</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow FM</th>
                                                    <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow MTD</th>
                                                    <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YFM</th>
                                                    <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YTD</th>
                                                </tr>
                                                <tr>
                                                    <th>MTD</th>
                                                    <th>Full</th>
                                                    <th>Target FM</th>
                                                    <th>REAL</th>
                                                    <th>ACH</th>
                                                    <th>YTD</th>
                                                    <th>Full</th>
                                                    <th>Target FY</th>
                                                    <th>ACH FY</th>
                                                    <th>Target YTD</th>
                                                    <th>REAL</th>
                                                    <th>ACH YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody id="minipack">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Upgrade Speed -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">UPGRADE SPEED</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow FM</th>
                                                    <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow MTD</th>
                                                    <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YFM</th>
                                                    <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YTD</th>
                                                </tr>
                                                <tr>
                                                    <th>MTD</th>
                                                    <th>Full</th>
                                                    <th>Target FM</th>
                                                    <th>REAL</th>
                                                    <th>ACH</th>
                                                    <th>YTD</th>
                                                    <th>Full</th>
                                                    <th>Target FY</th>
                                                    <th>ACH FY</th>
                                                    <th>Target YTD</th>
                                                    <th>REAL</th>
                                                    <th>ACH YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody id="upgrade">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- STB Tambahan -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">STB TAMBAHAN</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow FM</th>
                                                    <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow MTD</th>
                                                    <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YFM</th>
                                                    <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YTD</th>
                                                </tr>
                                                <tr>
                                                    <th>MTD</th>
                                                    <th>Full</th>
                                                    <th>Target FM</th>
                                                    <th>REAL</th>
                                                    <th>ACH</th>
                                                    <th>YTD</th>
                                                    <th>Full</th>
                                                    <th>Target FY</th>
                                                    <th>ACH FY</th>
                                                    <th>Target YTD</th>
                                                    <th>REAL</th>
                                                    <th>ACH YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody id="stbtambahan">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- OTT -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">OTT</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow FM</th>
                                                    <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow MTD</th>
                                                    <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YFM</th>
                                                    <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YTD</th>
                                                </tr>
                                                <tr>
                                                    <th>MTD</th>
                                                    <th>Full</th>
                                                    <th>Target FM</th>
                                                    <th>REAL</th>
                                                    <th>ACH</th>
                                                    <th>YTD</th>
                                                    <th>Full</th>
                                                    <th>Target FY</th>
                                                    <th>ACH FY</th>
                                                    <th>Target YTD</th>
                                                    <th>REAL</th>
                                                    <th>ACH YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ott">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Migrasi 2p3p -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">MIGRASI 3P2P</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow FM</th>
                                                    <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow MTD</th>
                                                    <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YFM</th>
                                                    <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YTD</th>
                                                </tr>
                                                <tr>
                                                    <th>MTD</th>
                                                    <th>Full</th>
                                                    <th>Target FM</th>
                                                    <th>REAL</th>
                                                    <th>ACH</th>
                                                    <th>YTD</th>
                                                    <th>Full</th>
                                                    <th>Target FY</th>
                                                    <th>ACH FY</th>
                                                    <th>Target YTD</th>
                                                    <th>REAL</th>
                                                    <th>ACH YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody id="mig2p3p">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Migrasi 1p2p -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">MIGRASI 1P2P</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow FM</th>
                                                    <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow MTD</th>
                                                    <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YFM</th>
                                                    <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Grow YTD</th>
                                                </tr>
                                                <tr>
                                                    <th>MTD</th>
                                                    <th>Full</th>
                                                    <th>Target FM</th>
                                                    <th>REAL</th>
                                                    <th>ACH</th>
                                                    <th>YTD</th>
                                                    <th>Full</th>
                                                    <th>Target FY</th>
                                                    <th>ACH FY</th>
                                                    <th>Target YTD</th>
                                                    <th>REAL</th>
                                                    <th>ACH YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody id="mig1p2p">
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
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.performance.psaddon') }}",
            success: function(data) {
                //alladdon
                $.each(data.alladdon, function(index, value) {
                    var gr_fm = value.gr_fm;
                    var ach_mtd = value.ach_mtd;
                    var gr_mtd = value.gr_mtd;
                    var gr_yfm = value.gr_yfm;
                    var ach_fy = value.ach_fy;
                    var ach_ytd = value.ach_ytd;
                    var gr_ytd = value.gr_ytd;
                    if (gr_fm > 0) {
                        var lb_gr_fm = '<text style="color: #29c0b1">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_fm = '<text style="color: #ff3366">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_mtd > 0) {
                        var lb_gr_mtd = '<text style="color: #29c0b1">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_mtd = '<text style="color: #ff3366">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_yfm > 0) {
                        var lb_gr_yfm = '<text style="color: #29c0b1">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_yfm = '<text style="color: #ff3366">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_ytd > 0) {
                        var lb_gr_ytd = '<text style="color: #29c0b1">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_ytd = '<text style="color: #ff3366">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (ach_mtd > 100) {
                        var lb_ach_mtd = '<label class="badge badge-success">' + ach_mtd + '%</label>'
                    } else {
                        var lb_ach_mtd = '<label class="badge badge-danger">' + ach_mtd + '%</label>'
                    }
                    if (ach_fy > 100) {
                        var lb_ach_fy = '<label class="badge badge-success">' + ach_fy + '%</label>'
                    } else {
                        var lb_ach_fy = '<label class="badge badge-danger">' + ach_fy + '%</label>'
                    }
                    if (ach_ytd > 100) {
                        var lb_ach_ytd = '<label class="badge badge-success">' + ach_ytd + '%</label>'
                    } else {
                        var lb_ach_ytd = '<label class="badge badge-danger">' + ach_ytd + '%</label>'
                    }
                    $('#alladdon').append(`
                      <tr>
                          <td>`+value.witel_str+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/alladdon/`+value.witel_str+`/mtd_bln_lalu') }}">`+value.mtd_bln_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/alladdon/`+value.witel_str+`/full_bln_lalu') }}">`+value.full_bln_lalu+`</a></td>
                          <td>`+lb_gr_fm+`</td>
                          <td>`+value.target_fm+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/alladdon/`+value.witel_str+`/mtd_bln_ini') }}">`+value.mtd_bln_ini+`</a></td>
                          <td>`+lb_ach_mtd+`</td>
                          <td>`+lb_gr_mtd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/alladdon/`+value.witel_str+`/ytd_thn_lalu') }}">`+value.ytd_thn_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/alladdon/`+value.witel_str+`/full_thn_lalu') }}">`+value.full_thn_lalu+`</a></td>
                          <td>`+lb_gr_yfm+`</td>
                          <td>`+value.target_fy+`</td>
                          <td>`+lb_ach_fy+`</td>
                          <td>`+value.target_ytd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/alladdon/`+value.witel_str+`/ytd_thn_ini') }}">`+value.ytd_thn_ini+`</a></td>
                          <td>`+lb_ach_ytd+`</td>
                          <td>`+lb_gr_ytd+`</td>
                      </tr>`)
                });
                // minipack
                $.each(data.minipack, function(index, value) {
                    var gr_fm = value.gr_fm;
                    var ach_mtd = value.ach_mtd;
                    var gr_mtd = value.gr_mtd;
                    var gr_yfm = value.gr_yfm;
                    var ach_fy = value.ach_fy;
                    var ach_ytd = value.ach_ytd;
                    var gr_ytd = value.gr_ytd;
                    if (gr_fm > 0) {
                        var lb_gr_fm = '<text style="color: #29c0b1">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_fm = '<text style="color: #ff3366">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_mtd > 0) {
                        var lb_gr_mtd = '<text style="color: #29c0b1">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_mtd = '<text style="color: #ff3366">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_yfm > 0) {
                        var lb_gr_yfm = '<text style="color: #29c0b1">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_yfm = '<text style="color: #ff3366">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_ytd > 0) {
                        var lb_gr_ytd = '<text style="color: #29c0b1">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_ytd = '<text style="color: #ff3366">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (ach_mtd > 100) {
                        var lb_ach_mtd = '<label class="badge badge-success">' + ach_mtd + '%</label>'
                    } else {
                        var lb_ach_mtd = '<label class="badge badge-danger">' + ach_mtd + '%</label>'
                    }
                    if (ach_fy > 100) {
                        var lb_ach_fy = '<label class="badge badge-success">' + ach_fy + '%</label>'
                    } else {
                        var lb_ach_fy = '<label class="badge badge-danger">' + ach_fy + '%</label>'
                    }
                    if (ach_ytd > 100) {
                        var lb_ach_ytd = '<label class="badge badge-success">' + ach_ytd + '%</label>'
                    } else {
                        var lb_ach_ytd = '<label class="badge badge-danger">' + ach_ytd + '%</label>'
                    }
                    $('#minipack').append(`
                      <tr>
                          <td>`+value.witel_str+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/minipack/`+value.witel_str+`/mtd_bln_lalu') }}">`+value.mtd_bln_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/minipack/`+value.witel_str+`/full_bln_lalu') }}">`+value.full_bln_lalu+`</a></td>
                          <td>`+lb_gr_fm+`</td>
                          <td>`+value.target_fm+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/minipack/`+value.witel_str+`/mtd_bln_ini') }}">`+value.mtd_bln_ini+`</a></td>
                          <td>`+lb_ach_mtd+`</td>
                          <td>`+lb_gr_mtd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/minipack/`+value.witel_str+`/ytd_thn_lalu') }}">`+value.ytd_thn_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/minipack/`+value.witel_str+`/full_thn_lalu') }}">`+value.full_thn_lalu+`</a></td>
                          <td>`+lb_gr_yfm+`</td>
                          <td>`+value.target_fy+`</td>
                          <td>`+lb_ach_fy+`</td>
                          <td>`+value.target_ytd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/minipack/`+value.witel_str+`/ytd_thn_ini') }}">`+value.ytd_thn_ini+`</a></td>
                          <td>`+lb_ach_ytd+`</td>
                          <td>`+lb_gr_ytd+`</td>
                      </tr>`)
                });
                //upgrade speed
                $.each(data.upgrade, function(index, value) {
                    var gr_fm = value.gr_fm;
                    var ach_mtd = value.ach_mtd;
                    var gr_mtd = value.gr_mtd;
                    var gr_yfm = value.gr_yfm;
                    var ach_fy = value.ach_fy;
                    var ach_ytd = value.ach_ytd;
                    var gr_ytd = value.gr_ytd;
                    if (gr_fm > 0) {
                        var lb_gr_fm = '<text style="color: #29c0b1">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_fm = '<text style="color: #ff3366">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_mtd > 0) {
                        var lb_gr_mtd = '<text style="color: #29c0b1">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_mtd = '<text style="color: #ff3366">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_yfm > 0) {
                        var lb_gr_yfm = '<text style="color: #29c0b1">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_yfm = '<text style="color: #ff3366">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_ytd > 0) {
                        var lb_gr_ytd = '<text style="color: #29c0b1">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_ytd = '<text style="color: #ff3366">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (ach_mtd > 100) {
                        var lb_ach_mtd = '<label class="badge badge-success">' + ach_mtd + '%</label>'
                    } else {
                        var lb_ach_mtd = '<label class="badge badge-danger">' + ach_mtd + '%</label>'
                    }
                    if (ach_fy > 100) {
                        var lb_ach_fy = '<label class="badge badge-success">' + ach_fy + '%</label>'
                    } else {
                        var lb_ach_fy = '<label class="badge badge-danger">' + ach_fy + '%</label>'
                    }
                    if (ach_ytd > 100) {
                        var lb_ach_ytd = '<label class="badge badge-success">' + ach_ytd + '%</label>'
                    } else {
                        var lb_ach_ytd = '<label class="badge badge-danger">' + ach_ytd + '%</label>'
                    }
                    $('#upgrade').append(`
                      <tr>
                          <td>`+value.witel_str+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/upgrade/`+value.witel_str+`/mtd_bln_lalu') }}">`+value.mtd_bln_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/upgrade/`+value.witel_str+`/full_bln_lalu') }}">`+value.full_bln_lalu+`</a></td>
                          <td>`+lb_gr_fm+`</td>
                          <td>`+value.target_fm+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/upgrade/`+value.witel_str+`/mtd_bln_ini') }}">`+value.mtd_bln_ini+`</a></td>
                          <td>`+lb_ach_mtd+`</td>
                          <td>`+lb_gr_mtd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/upgrade/`+value.witel_str+`/ytd_thn_lalu') }}">`+value.ytd_thn_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/upgrade/`+value.witel_str+`/full_thn_lalu') }}">`+value.full_thn_lalu+`</a></td>
                          <td>`+lb_gr_yfm+`</td>
                          <td>`+value.target_fy+`</td>
                          <td>`+lb_ach_fy+`</td>
                          <td>`+value.target_ytd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/upgrade/`+value.witel_str+`/ytd_thn_ini') }}">`+value.ytd_thn_ini+`</a></td>
                          <td>`+lb_ach_ytd+`</td>
                          <td>`+lb_gr_ytd+`</td>
                      </tr>`)
                });
                //stb tambahan
                $.each(data.stbtambahan, function(index, value) {
                    var gr_fm = value.gr_fm;
                    var ach_mtd = value.ach_mtd;
                    var gr_mtd = value.gr_mtd;
                    var gr_yfm = value.gr_yfm;
                    var ach_fy = value.ach_fy;
                    var ach_ytd = value.ach_ytd;
                    var gr_ytd = value.gr_ytd;
                    if (gr_fm > 0) {
                        var lb_gr_fm = '<text style="color: #29c0b1">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_fm = '<text style="color: #ff3366">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_mtd > 0) {
                        var lb_gr_mtd = '<text style="color: #29c0b1">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_mtd = '<text style="color: #ff3366">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_yfm > 0) {
                        var lb_gr_yfm = '<text style="color: #29c0b1">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_yfm = '<text style="color: #ff3366">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_ytd > 0) {
                        var lb_gr_ytd = '<text style="color: #29c0b1">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_ytd = '<text style="color: #ff3366">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (ach_mtd > 100) {
                        var lb_ach_mtd = '<label class="badge badge-success">' + ach_mtd + '%</label>'
                    } else {
                        var lb_ach_mtd = '<label class="badge badge-danger">' + ach_mtd + '%</label>'
                    }
                    if (ach_fy > 100) {
                        var lb_ach_fy = '<label class="badge badge-success">' + ach_fy + '%</label>'
                    } else {
                        var lb_ach_fy = '<label class="badge badge-danger">' + ach_fy + '%</label>'
                    }
                    if (ach_ytd > 100) {
                        var lb_ach_ytd = '<label class="badge badge-success">' + ach_ytd + '%</label>'
                    } else {
                        var lb_ach_ytd = '<label class="badge badge-danger">' + ach_ytd + '%</label>'
                    }
                    $('#stbtambahan').append(`
                      <tr>
                          <td>`+value.witel_str+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/stbtambahan/`+value.witel_str+`/mtd_bln_lalu') }}">`+value.mtd_bln_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/stbtambahan/`+value.witel_str+`/full_bln_lalu') }}">`+value.full_bln_lalu+`</a></td>
                          <td>`+lb_gr_fm+`</td>
                          <td>`+value.target_fm+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/stbtambahan/`+value.witel_str+`/mtd_bln_ini') }}">`+value.mtd_bln_ini+`</a></td>
                          <td>`+lb_ach_mtd+`</td>
                          <td>`+lb_gr_mtd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/stbtambahan/`+value.witel_str+`/ytd_thn_lalu') }}">`+value.ytd_thn_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/stbtambahan/`+value.witel_str+`/full_thn_lalu') }}">`+value.full_thn_lalu+`</a></td>
                          <td>`+lb_gr_yfm+`</td>
                          <td>`+value.target_fy+`</td>
                          <td>`+lb_ach_fy+`</td>
                          <td>`+value.target_ytd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/stbtambahan/`+value.witel_str+`/ytd_thn_ini') }}">`+value.ytd_thn_ini+`</a></td>
                          <td>`+lb_ach_ytd+`</td>
                          <td>`+lb_gr_ytd+`</td>
                      </tr>`)
                });
                //ott
                $.each(data.ott, function(index, value) {
                    var gr_fm = value.gr_fm;
                    var ach_mtd = value.ach_mtd;
                    var gr_mtd = value.gr_mtd;
                    var gr_yfm = value.gr_yfm;
                    var ach_fy = value.ach_fy;
                    var ach_ytd = value.ach_ytd;
                    var gr_ytd = value.gr_ytd;
                    if (gr_fm > 0) {
                        var lb_gr_fm = '<text style="color: #29c0b1">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_fm = '<text style="color: #ff3366">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_mtd > 0) {
                        var lb_gr_mtd = '<text style="color: #29c0b1">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_mtd = '<text style="color: #ff3366">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_yfm > 0) {
                        var lb_gr_yfm = '<text style="color: #29c0b1">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_yfm = '<text style="color: #ff3366">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_ytd > 0) {
                        var lb_gr_ytd = '<text style="color: #29c0b1">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_ytd = '<text style="color: #ff3366">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (ach_mtd > 100) {
                        var lb_ach_mtd = '<label class="badge badge-success">' + ach_mtd + '%</label>'
                    } else {
                        var lb_ach_mtd = '<label class="badge badge-danger">' + ach_mtd + '%</label>'
                    }
                    if (ach_fy > 100) {
                        var lb_ach_fy = '<label class="badge badge-success">' + ach_fy + '%</label>'
                    } else {
                        var lb_ach_fy = '<label class="badge badge-danger">' + ach_fy + '%</label>'
                    }
                    if (ach_ytd > 100) {
                        var lb_ach_ytd = '<label class="badge badge-success">' + ach_ytd + '%</label>'
                    } else {
                        var lb_ach_ytd = '<label class="badge badge-danger">' + ach_ytd + '%</label>'
                    }
                    $('#ott').append(`
                      <tr>
                          <td>`+value.witel_str+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/ott/`+value.witel_str+`/mtd_bln_lalu') }}">`+value.mtd_bln_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/ott/`+value.witel_str+`/full_bln_lalu') }}">`+value.full_bln_lalu+`</a></td>
                          <td>`+lb_gr_fm+`</td>
                          <td>`+value.target_fm+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/ott/`+value.witel_str+`/mtd_bln_ini') }}">`+value.mtd_bln_ini+`</a></td>
                          <td>`+lb_ach_mtd+`</td>
                          <td>`+lb_gr_mtd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/ott/`+value.witel_str+`/ytd_thn_lalu') }}">`+value.ytd_thn_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/ott/`+value.witel_str+`/full_thn_lalu') }}">`+value.full_thn_lalu+`</a></td>
                          <td>`+lb_gr_yfm+`</td>
                          <td>`+value.target_fy+`</td>
                          <td>`+lb_ach_fy+`</td>
                          <td>`+value.target_ytd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/ott/`+value.witel_str+`/ytd_thn_ini') }}">`+value.ytd_thn_ini+`</a></td>
                          <td>`+lb_ach_ytd+`</td>
                          <td>`+lb_gr_ytd+`</td>
                      </tr>`)
                });
                //mig2p3p
                $.each(data.mig2p3p, function(index, value) {
                    var gr_fm = value.gr_fm;
                    var ach_mtd = value.ach_mtd;
                    var gr_mtd = value.gr_mtd;
                    var gr_yfm = value.gr_yfm;
                    var ach_fy = value.ach_fy;
                    var ach_ytd = value.ach_ytd;
                    var gr_ytd = value.gr_ytd;
                    if (gr_fm > 0) {
                        var lb_gr_fm = '<text style="color: #29c0b1">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_fm = '<text style="color: #ff3366">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_mtd > 0) {
                        var lb_gr_mtd = '<text style="color: #29c0b1">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_mtd = '<text style="color: #ff3366">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_yfm > 0) {
                        var lb_gr_yfm = '<text style="color: #29c0b1">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_yfm = '<text style="color: #ff3366">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_ytd > 0) {
                        var lb_gr_ytd = '<text style="color: #29c0b1">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_ytd = '<text style="color: #ff3366">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (ach_mtd > 100) {
                        var lb_ach_mtd = '<label class="badge badge-success">' + ach_mtd + '%</label>'
                    } else {
                        var lb_ach_mtd = '<label class="badge badge-danger">' + ach_mtd + '%</label>'
                    }
                    if (ach_fy > 100) {
                        var lb_ach_fy = '<label class="badge badge-success">' + ach_fy + '%</label>'
                    } else {
                        var lb_ach_fy = '<label class="badge badge-danger">' + ach_fy + '%</label>'
                    }
                    if (ach_ytd > 100) {
                        var lb_ach_ytd = '<label class="badge badge-success">' + ach_ytd + '%</label>'
                    } else {
                        var lb_ach_ytd = '<label class="badge badge-danger">' + ach_ytd + '%</label>'
                    }
                    $('#mig2p3p').append(`
                      <tr>
                          <td>`+value.witel_str+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig2p3p/`+value.witel_str+`/mtd_bln_lalu') }}">`+value.mtd_bln_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig2p3p/`+value.witel_str+`/full_bln_lalu') }}">`+value.full_bln_lalu+`</a></td>
                          <td>`+lb_gr_fm+`</td>
                          <td>`+value.target_fm+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig2p3p/`+value.witel_str+`/mtd_bln_ini') }}">`+value.mtd_bln_ini+`</a></td>
                          <td>`+lb_ach_mtd+`</td>
                          <td>`+lb_gr_mtd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig2p3p/`+value.witel_str+`/ytd_thn_lalu') }}">`+value.ytd_thn_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig2p3p/`+value.witel_str+`/full_thn_lalu') }}">`+value.full_thn_lalu+`</a></td>
                          <td>`+lb_gr_yfm+`</td>
                          <td>`+value.target_fy+`</td>
                          <td>`+lb_ach_fy+`</td>
                          <td>`+value.target_ytd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig2p3p/`+value.witel_str+`/ytd_thn_ini') }}">`+value.ytd_thn_ini+`</a></td>
                          <td>`+lb_ach_ytd+`</td>
                          <td>`+lb_gr_ytd+`</td>
                      </tr>`)
                });
                //mig1p2p
                $.each(data.mig1p2p, function(index, value) {
                    var gr_fm = value.gr_fm;
                    var ach_mtd = value.ach_mtd;
                    var gr_mtd = value.gr_mtd;
                    var gr_yfm = value.gr_yfm;
                    var ach_fy = value.ach_fy;
                    var ach_ytd = value.ach_ytd;
                    var gr_ytd = value.gr_ytd;
                    if (gr_fm > 0) {
                        var lb_gr_fm = '<text style="color: #29c0b1">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_fm = '<text style="color: #ff3366">' + gr_fm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_mtd > 0) {
                        var lb_gr_mtd = '<text style="color: #29c0b1">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_mtd = '<text style="color: #ff3366">' + gr_mtd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_yfm > 0) {
                        var lb_gr_yfm = '<text style="color: #29c0b1">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_yfm = '<text style="color: #ff3366">' + gr_yfm + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (gr_ytd > 0) {
                        var lb_gr_ytd = '<text style="color: #29c0b1">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gr_ytd = '<text style="color: #ff3366">' + gr_ytd + '%</text>' + " " + '<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }
                    if (ach_mtd > 100) {
                        var lb_ach_mtd = '<label class="badge badge-success">' + ach_mtd + '%</label>'
                    } else {
                        var lb_ach_mtd = '<label class="badge badge-danger">' + ach_mtd + '%</label>'
                    }
                    if (ach_fy > 100) {
                        var lb_ach_fy = '<label class="badge badge-success">' + ach_fy + '%</label>'
                    } else {
                        var lb_ach_fy = '<label class="badge badge-danger">' + ach_fy + '%</label>'
                    }
                    if (ach_ytd > 100) {
                        var lb_ach_ytd = '<label class="badge badge-success">' + ach_ytd + '%</label>'
                    } else {
                        var lb_ach_ytd = '<label class="badge badge-danger">' + ach_ytd + '%</label>'
                    }
                    $('#mig1p2p').append(`
                      <tr>
                          <td>`+value.witel_str+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig1p2p/`+value.witel_str+`/mtd_bln_lalu') }}">`+value.mtd_bln_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig1p2p/`+value.witel_str+`/full_bln_lalu') }}">`+value.full_bln_lalu+`</a></td>
                          <td>`+lb_gr_fm+`</td>
                          <td>`+value.target_fm+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig1p2p/`+value.witel_str+`/mtd_bln_ini') }}">`+value.mtd_bln_ini+`</a></td>
                          <td>`+lb_ach_mtd+`</td>
                          <td>`+lb_gr_mtd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig1p2p/`+value.witel_str+`/ytd_thn_lalu') }}">`+value.ytd_thn_lalu+`</a></td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig1p2p/`+value.witel_str+`/full_thn_lalu') }}">`+value.full_thn_lalu+`</a></td>
                          <td>`+lb_gr_yfm+`</td>
                          <td>`+value.target_fy+`</td>
                          <td>`+lb_ach_fy+`</td>
                          <td>`+value.target_ytd+`</td>
                          <td><a style="color:black" target="_blank" href="{{ url('admin/performance/psaddon/detail/mig1p2p/`+value.witel_str+`/ytd_thn_ini') }}">`+value.ytd_thn_ini+`</a></td>
                          <td>`+lb_ach_ytd+`</td>
                          <td>`+lb_gr_ytd+`</td>
                      </tr>`)
                });
            },
        });
    });
</script>
@endsection
