@extends('layouts.admin')
@section('content')
<style>
    tr,
    th,
    td {
        border: 1px solid black;
    }

    .bg-jingga {
      background-color: #e69138;
    }
    .bg-merah {
      background-color: #f44336;
    }
    .bg-biru {
      background-color: #2986cc;
    }
    .bg-hijau {
      background-color: #00ba37;
    }
    .bg-emas {
      background-color: #b8860b;
    }
</style>
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>Pra NPC</h4>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-10" style="width:60rem;">
                      <div class="row" style="margin:2% 0 0 0;">
                        <div class="col">
                          <div class="form-group">
                            <label for="">Source</label>
                            <select class="form-control select2" name="source" id="source">
                              <option value="">All</option>
                              <option value="CTB Borneo">CTB Borneo</option>
                              <option value="Non CTB Borneo">Non CTB Borneo</option>
                              <option value="Netezza">Netezza</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="">ML Prediction</label>
                            <select class="form-control select2" name="prediction" id="prediction">
                              <option value="">All</option>
                              <option value="NEW_CT0">New CT0</option>
                              <option value="NORMAL">Normal</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="">Segmen</label>
                            <select class="form-control select2" name="segmen" id="segmen">
                              <option value="">All</option>
                              <option value="PL">PL</option>
                              <option value="BL">BL</option>
                              <option value="CL">BL</option>
                              <option value="GL">BL</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="">HVC</label>
                            <select class="form-control select2" name="segmen_hvc" id="segmen_hvc">
                              <option value="">All</option>
                              <option value="HVC_REGULER">HVC REGULER</option>
                              <option value="HVC_GOLD">HVC GOLD</option>
                              <option value="HVC_PLATINUM">HVC PLATINUM</option>
                              <option value="HVC_VVIP">HVC VVIP</option>
                              <option value="HVC_SILVER">HVC SILVER</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="">Usia Tunggakan</label>
                            <select class="form-control select2" name="tunggakan" id="tunggakan">
                              <option value="">All</option>
                              <option value="0">0 Bulan</option>
                              <option value="1">1 Bulan</option>
                              <option value="2">2 Bulan</option>
                              <option value="3">3 Bulan</option>
                              <option value="4">4 Bulan</option>
                              <option value="5">5 Bulan</option>
                              <option value="6">6 Bulan</option>
                              <option value="Lebih6">> 6 Bulan</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="">Usia Langganan</label>
                            <select class="form-control select2" name="langganan" id="langganan">
                              <option value="">All</option>
                              <option value="0">0 - 1 Bulan</option>
                              <option value="2">2 - 3 Bulan</option>
                              <option value="4">4 - 6 Bulan</option>
                              <option value="7">7 - 12 Bulan</option>
                              <option value="12">> 12 Bulan</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group col col-md" style="margin-top:35px;">
                            <button type="submit" class="btn btn-info" id="btnFilter">Filter</button>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col" id="totalPraNPC">
                            <h5>Total Pra NPC : <a href="">1234</a></h5>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                  <!-- start row -->
                  <div class="row">
                    <div class="col-lg-12" style="">
                      <div class="card card-table">
                        <div class="card-header">
                          <div class="row">
                            <div>
                              <h5>Total Table 1 : </h5>
                            </div>&nbsp;
                            <div id="totalTable1">
                                <h5>1234</h5>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table datatable" id="" style="">
                              <thead class="thead align-baseline text-center">
                                <tr class="tr">
                                  <th class="th bg-jingga" rowspan="2"><b class="text-white">Witel</b></th>
                                  <th class="th bg-jingga" rowspan="2"><b class="text-white">Data Pra NPC</b></th>
                                  <th class="th bg-hijau" rowspan="2"><b class="text-white">Paid</b></th>
                                  <th class="th bg-merah" rowspan="2"><b class="text-white">Non Paid</b></th>
                                  <th class="th bg-biru" colspan="8"><b class="text-white">Caring</b></th>
                                  <th class="th bg-warning" rowspan="2"><b class="text-white">Belum Caring</b></th>
                                  <th class="th bg-merah" rowspan="2"><b class="text-white">Modem Offline</b></th>
                                </tr>
                                <tr class="tr">
                                  <th class="th bg-biru"><b class="text-white">Janji Bayar</b></th>
                                  <th class="th bg-biru"><b class="text-white">Tidak Bertemu Ybs</b></th>
                                  <th class="th bg-biru"><b class="text-white">Tidak Bertemu Penghuni</b></th>
                                  <th class="th bg-biru"><b class="text-white">Alamat Tidak Ketemu</b></th>
                                  <th class="th bg-biru"><b class="text-white">Rumah Tidak Berpenghuni</b></th>
                                  <th class="th bg-biru"><b class="text-white">Ambil Perangkat & Tidak Mau Bayar</b></th>
                                  <th class="th bg-biru"><b class="text-white">Produk Gangguan</b></th>
                                  <th class="th bg-biru"><b class="text-white">Lain-lain</b></th>
                                </tr>
                              </thead>
                              <tbody class="text-center" id="tableWitelTable1">

                              </tbody>
                              <!-- <tfoot id="tableTotalTable1">
                              </tfoot> -->
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                    <div class="col-lg-12" style="">
                      <div class="card card-table">
                        <div class="card-header">
                          <div class="row">
                            <div>
                              <h5>Total Table 2 : </h5>
                            </div>&nbsp;
                            <div id="totalTable2">
                                <h5>1234</h5>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table datatable" id="" style="">
                              <thead class="thead align-baseline text-center">
                                <tr class="tr">
                                  <th class="th bg-jingga" rowspan="3"><b class="text-white">Witel</b></th>
                                  <th class="th bg-jingga" rowspan="3"><b class="text-white">Data Pra NPC</b></th>
                                  <th class="th bg-biru" colspan="3"><b class="text-white">Zona Occupancy</b></th>
                                  <th class="th bg-hijau" colspan="3"><b class="text-white">P1 - Infra</b></th>
                                  <th class="th bg-merah" colspan="6"><b class="text-white">P2 - Customer Care</b></th>
                                  <th class="th bg-emas" colspan="1"><b class="text-white">P3 - CM Pelanggan</b></th>
                                  <th class="th bg-secondary" rowspan="3"><b class="text-white">P4 - PCF</b></th>
                                </tr>
                                <tr class="tr">
                                  <th class="th bg-biru" rowspan="2"><b class="text-white">Green</b></th>
                                  <th class="th bg-biru" rowspan="2"><b class="text-white">Yellow</b></th>
                                  <th class="th bg-biru" rowspan="2"><b class="text-white">Red</b></th>
                                  <th class="th bg-hijau" rowspan="2"><b class="text-white">Unspek</b></th>
                                  <th class="th bg-hijau" rowspan="2"><b class="text-white">Q Jaringan</b></th>
                                  <th class="th bg-hijau" rowspan="2"><b class="text-white">QC2 Not Valid</b></th>
                                  <th class="th bg-merah" rowspan="2"><b class="text-white">Ticket CC</b></th>
                                  <th class="th bg-merah" rowspan="2"><b class="text-white">Detractor CTL</b></th>
                                  <th class="th bg-merah" rowspan="2"><b class="text-white">Over Quota</b></th>
                                  <th class="th bg-merah" rowspan="2"><b class="text-white">Over Device</b></th>
                                  <th class="th bg-merah" colspan="2"><b class="text-white">No Usage</b></th>
                                  <th class="th bg-emas" rowspan="2"><b class="text-white">Usia <6 Bulan</b></th>
                                </tr>
                                <tr class="tr">
                                  <th class="th bg-merah"><b class="text-white">BI</b></th>
                                  <th class="th bg-merah"><b class="text-white">BL</b></th>
                                </tr>
                              </thead>
                              <tbody class="text-center" id="tableWitelTable2">

                              </tbody>
                              <!-- <tfoot id="tableTotalTable2">
                              </tfoot> -->
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

var datapra1_val = '123';
var paid_val = '123';
var nonpaid_val = '123';
var janji_val = '123';
var ybs_val = '123';
var penghuni_val = '123';
var alamat_val = '123';
var rumah_val = '123';
var perangkat_val = '123';
var gangguan_val = '123';
var lain_val = '123';
var belumcaring_val = '123';
var offline_val = '123';

// grand total table 2
var datapra2_val = '123';
var green_val = '123';
var yellow_val = '123';
var red_val = '123';
var unspek_val = '123';
var qjaringan_val = '123';
var qc2_val = '123';
var ticket_val = '123';
var ctl_val = '123';
var quota_val = '123';
var device_val = '123';
var bi_val = '123';
var bl_val = '123';
var usia_val = '123';
var pcf_val = '123';


  $('#tableWitelTable1').append(`
      <tr>
        <td>BALIKPAPAN</td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
      </tr>
      <tr>
        <td>KALBAR</td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
      </tr>
      <tr>
        <td>KALSEL</td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
      </tr>
      <tr>
        <td>KALTARA</td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
      </tr>
      <tr>
        <td>KALTENG</td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
      </tr>
      <tr>
        <td>SAMARINDA</td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
        <td><a target="_blank" href="">123</a></td>
      </tr>
      <tr>
        <td class="bg-jingga text-white"><b>TREG VI</b></td>
        <td class="bg-jingga"><b><a target="_blank" href="" class="text-white">`+ datapra1_val +`</a></b></td>
        <td class="bg-hijau"><b><a target="_blank" href="" class="text-white">`+ paid_val +`</a></b></td>
        <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ nonpaid_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ janji_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ ybs_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ penghuni_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ alamat_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ rumah_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ perangkat_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ gangguan_val +`</a></b></td>
        <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ lain_val +`</a></b></td>
        <td class="bg-warning"><b><a target="_blank" href="" class="text-white">`+ belumcaring_val +`</a></b></td>
        <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ offline_val +`</a></b></td>
      </tr>
    `);

    $('#tableWitelTable2').append(`
    <tr>
      <td>BALIKPAPAN</td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
    </tr>
    <tr>
      <td>KALBAR</td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
    </tr>
    <tr>
      <td>KALSEL</td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
    </tr>
    <tr>
      <td>KALTARA</td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
    </tr>
    <tr>
      <td>KALTENG</td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
    </tr>
    <tr>
      <td>SAMARINDA</td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
      <td><a target="_blank" href="">123</a></td>
    </tr>
    <tr>
      <td class="bg-jingga text-white"><b>TREG VI</b></td>
      <td class="bg-jingga"><b><a target="_blank" href="" class="text-white">`+ datapra2_val +`</a></b></td>
      <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ green_val +`</a></b></td>
      <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ yellow_val +`</a></b></td>
      <td class="bg-biru"><b><a target="_blank" href="" class="text-white">`+ red_val +`</a></b></td>
      <td class="bg-hijau"><b><a target="_blank" href="" class="text-white">`+ unspek_val +`</a></b></td>
      <td class="bg-hijau"><b><a target="_blank" href="" class="text-white">`+ qjaringan_val +`</a></b></td>
      <td class="bg-hijau"><b><a target="_blank" href="" class="text-white">`+ qc2_val +`</a></b></td>
      <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ ticket_val +`</a></b></td>
      <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ ctl_val +`</a></b></td>
      <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ quota_val +`</a></b></td>
      <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ device_val +`</a></b></td>
      <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ bi_val +`</a></b></td>
      <td class="bg-merah"><b><a target="_blank" href="" class="text-white">`+ bl_val +`</a></b></td>
      <td class="bg-emas"><b><a target="_blank" href="" class="text-white">`+ usia_val +`</a></b></td>
      <td class="bg-secondary"><b><a target="_blank" href="" class="text-white">`+ pcf_val +`</a></b></td>
    </tr>
    `);


});

</script>
@endsection
