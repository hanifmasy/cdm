@extends('layouts.admin')
@section('content')
<style>
    tr,
    th,
    td {
        border: 1px solid black;
    }
    .bg-ungu {
      background-color: #6b1e40;
    }
</style>
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>Pra Pra NPC</h4>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-8" style="width:60rem;">

                      <div class="row" style="margin:2% 0 0 0;">
                        <div class="col">
                          <div class="form-group">
                            <label for="">ML Prediction</label>
                            <select class="form-control select2" name="prediction" id="prediction">
                              <option value="">All</option>
                              <option value="NEW_CT0">NEW CT0</option>
                              <option value="NORMAL">NORMAL</option>
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
                              <option value="CL">CL</option>
                              <option value="GL">GL</option>
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
                        <div class="col" id="totalPraPraNPC">

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
                              <h5>Data Saldo Unpaid Billing : </h5>
                            </div>&nbsp;
                            <div id="totalSaldoUnpaidBill">

                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table datatable" id="" style="">
                              <thead class="thead align-baseline text-center">
                                <tr class="tr">
                                  <th class="th bg-danger" rowspan="2"><b class="text-white">Witel</b></th>
                                  <th class="th bg-secondary" colspan="3"><b class="text-white">Zona Occupancy</b></th>
                                  <th class="th bg-success" colspan="4"><b class="text-white">P1 - Infra</b></th>
                                  <th class="th bg-primary" colspan="5"><b class="text-white">P2 - Customer Care</b></th>
                                  <th class="th bg-warning" colspan="1"><b class="text-white">P3 - CM Pelanggan</b></th>
                                  <th class="th bg-ungu" colspan="1"><b class="text-white">P4 - Paycoll</b></th>
                                </tr>
                                <tr class="tr">
                                  <!-- zona occupancy -->
                                  <th class="th bg-secondary"><b class="text-white">Green</b></th>
                                  <th class="th bg-secondary"><b class="text-white">Yellow</b></th>
                                  <th class="th bg-secondary"><b class="text-white">Red</b></th>
                                  <!-- p1 infra -->
                                  <th class="th bg-success"><b class="text-white">Unspek</b></th>
                                  <th class="th bg-success"><b class="text-white">Q Jaringan</b></th>
                                  <th class="th bg-success"><b class="text-white">Modem Offline</b></th>
                                  <th class="th bg-success"><b class="text-white">QC2 Not Valid</b></th>
                                  <!-- p2 cc -->
                                  <th class="th bg-primary"><b class="text-white">Tiket CC</b></th>
                                  <th class="th bg-primary"><b class="text-white">Detractor CTL</b></th>
                                  <th class="th bg-primary"><b class="text-white">Over Quota</b></th>
                                  <th class="th bg-primary"><b class="text-white">Over Device</b></th>
                                  <th class="th bg-primary"><b class="text-white">No Usage</b></th>
                                  <!-- p3 cm -->
                                  <th class="th bg-warning"><b class="text-white">Usia < 6 Bulan</b>
                                  </th>
                                  <!-- p4 payroll -->
                                  <th class="th bg-ungu"><b class="text-white">Total Saldo</b></th>
                                </tr>
                              </thead>
                              <tbody id="tableWitelTetap">

                              </tbody>
                              <!-- <tfoot id="tableTotalTetap">
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
                              <h5>Data Paid Billing : </h5>
                            </div>&nbsp;
                            <div id="totalSaldoPaidBill">

                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table datatable" id="" style="">
                              <thead class="thead align-baseline text-center">
                                <tr class="tr">
                                  <th class="th bg-danger" rowspan="2"><b class="text-white">Witel</b></th>
                                  <th class="th bg-secondary" colspan="3"><b class="text-white">Zona Occupancy</b></th>
                                  <th class="th bg-success" colspan="4"><b class="text-white">P1 - Infra</b></th>
                                  <th class="th bg-primary" colspan="5"><b class="text-white">P2 - Customer Care</b></th>
                                  <th class="th bg-warning" colspan="1"><b class="text-white">P3 - CM Pelanggan</b></th>
                                  <th class="th bg-ungu" colspan="1"><b class="text-white">P4 - Paycoll</b></th>
                                </tr>
                                <tr class="tr">
                                  <!-- zona occupancy -->
                                  <th class="th bg-secondary"><b class="text-white">Green</b></th>
                                  <th class="th bg-secondary"><b class="text-white">Yellow</b></th>
                                  <th class="th bg-secondary"><b class="text-white">Red</b></th>
                                  <!-- p1 infra -->
                                  <th class="th bg-success"><b class="text-white">Unspek</b></th>
                                  <th class="th bg-success"><b class="text-white">Q Jaringan</b></th>
                                  <th class="th bg-success"><b class="text-white">Modem Offline</b></th>
                                  <th class="th bg-success"><b class="text-white">QC2 Not Valid</b></th>
                                  <!-- p2 cc -->
                                  <th class="th bg-primary"><b class="text-white">Tiket CC</b></th>
                                  <th class="th bg-primary"><b class="text-white">Detractor CTL</b></th>
                                  <th class="th bg-primary"><b class="text-white">Over Quota</b></th>
                                  <th class="th bg-primary"><b class="text-white">Over Device</b></th>
                                  <th class="th bg-primary"><b class="text-white">No Usage</b></th>
                                  <!-- p3 cm -->
                                  <th class="th bg-warning"><b class="text-white">Usia < 6 Bulan</b>
                                  </th>
                                  <!-- p4 payroll -->
                                  <th class="th bg-ungu"><b class="text-white">Total Saldo</b></th>
                                </tr>
                              </thead>
                              <tbody id="tableWitelBergerak">

                              </tbody>
                              <!-- <tfoot id="tableTotalBergerak">
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

$(document).ready(function() {
  var prediction = $('#prediction').val();
  var segmen = $('#segmen').val();
  var segmen_hvc = $('#segmen_hvc').val();
  load_content(prediction,segmen,segmen_hvc);

  function load_content(prediction,segmen,segmen_hvc) {
    prediction = prediction;
    segmen = segmen;
    segmen_hvc = segmen_hvc;
    $.ajax({
      'type': "GET",
      'dataType': "JSON",
      'url': "{{ route('admin.pra_pra_npc') }}",
      'data': {
        prediction: prediction,
        segmen: segmen,
        segmen_hvc: segmen_hvc,
      },
      'success': function(data) {
        $('#tableWitelTetap').empty();
        $('#tableWitelBergerak').empty();
        $('#totalSaldoUnpaidBill').empty();
        $('#totalSaldoPaidBill').empty();
        $('#totalPraPraNPC').empty();

        var total_tetap_green = 0;
        var total_tetap_yellow = 0;
        var total_tetap_red = 0;
        var total_tetap_unspek = 0;
        var total_tetap_qjaringan = 0;
        var total_tetap_offline = 0;
        var total_tetap_qc2 = 0;
        var total_tetap_ticketcc = 0;
        var total_tetap_overquota = 0;
        var total_tetap_nousage = 0;
        var total_tetap_cm = 0;
        var total_tetap_sisa_caring = 0;

        var total_bergerak_green = 0;
        var total_bergerak_yellow = 0;
        var total_bergerak_red = 0;
        var total_bergerak_unspek = 0;
        var total_bergerak_qjaringan = 0;
        var total_bergerak_offline = 0;
        var total_bergerak_qc2 = 0;
        var total_bergerak_ticketcc = 0;
        var total_bergerak_overquota = 0;
        var total_bergerak_nousage = 0;
        var total_bergerak_cm = 0;
        var total_bergerak_sisa_caring = 0;

        $.each(data.total_witel_tetap, function(index, value) {
          total_tetap_green = total_tetap_green + value.green;
          total_tetap_yellow = total_tetap_yellow + value.yellow;
          total_tetap_red = total_tetap_red + value.red;
          total_tetap_unspek = total_tetap_unspek + value.unspek;
          total_tetap_qjaringan = total_tetap_qjaringan + value.qjaringan;
          total_tetap_offline = total_tetap_offline + value.offline;
          total_tetap_qc2 = total_tetap_qc2 + value.qc2;
          total_tetap_ticketcc = total_tetap_ticketcc + value.ticketcc;
          total_tetap_overquota = total_tetap_overquota + value.overquota;
          total_tetap_nousage = total_tetap_nousage + value.nousage;
          total_tetap_cm = total_tetap_cm + value.cm;
          total_tetap_sisa_caring = total_tetap_sisa_caring + value.sisa_caring;
          $('#tableWitelTetap').append(`
                        <tr class="tr" colspan="13">
                            <td class="td">` + value.witel_area + `</td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_zona=Green" class="text-black">` + value.green + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_zona=Yellow" class="text-black">` + value.yellow + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_zona=Red" class="text-black">` + value.red + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_spec=UNSPEK" class="text-black">` + value.unspek + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_ticket=TICKETINFRA" class="text-black">` + value.qjaringan + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_spec=OFFLINE" class="text-black">` + value.offline + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_qc=BELUM VALID" class="text-black">` + value.qc2 + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_ticket=TICKETCC" class="text-black">` + value.ticketcc + `</a></td>
                            <td class="td">-</td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_quota=OVERQUOTA" class="text-black">` + value.overquota + `</a></td>
                            <td class="td">-</td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_usage=NOUSAGE" class="text-black">` + value.nousage + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&cat_cm=CM" class="text-black">` + value.cm + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&witel_area=` + value.witel_area + `&sisa_caring=OK" class="text-black">` + value.sisa_caring + `</a></td>
                        </tr>`)
        });

        $.each(data.total_witel_bergerak, function(index, value) {
          total_bergerak_green = total_bergerak_green + value.green;
          total_bergerak_yellow = total_bergerak_yellow + value.yellow;
          total_bergerak_red = total_bergerak_red + value.red;
          total_bergerak_unspek = total_bergerak_unspek + value.unspek;
          total_bergerak_qjaringan = total_bergerak_qjaringan + value.qjaringan;
          total_bergerak_offline = total_bergerak_offline + value.offline;
          total_bergerak_qc2 = total_bergerak_qc2 + value.qc2;
          total_bergerak_ticketcc = total_bergerak_ticketcc + value.ticketcc;
          total_bergerak_overquota = total_bergerak_overquota + value.overquota;
          total_bergerak_nousage = total_bergerak_nousage + value.nousage;
          total_bergerak_cm = total_bergerak_cm + value.cm;
          total_bergerak_sisa_caring = total_bergerak_sisa_caring + value.sisa_caring;
          $('#tableWitelBergerak').append(`
                        <tr class="tr" colspan="13">
                            <td class="td">` + value.witel_area + `</td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_zona=Green" class="text-black">` + value.green + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_zona=Yellow" class="text-black">` + value.yellow + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_zona=Red" class="text-black">` + value.red + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_spec=UNSPEK" class="text-black">` + value.unspek + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_ticket=TICKETINFRA" class="text-black">` + value.qjaringan + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_spec=OFFLINE" class="text-black">` + value.offline + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_qc=BELUM VALID" class="text-black">` + value.qc2 + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_ticket=TICKETCC" class="text-black">` + value.ticketcc + `</a></td>
                            <td class="td">-</td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_quota=OVERQUOTA" class="text-black">` + value.overquota + `</a></td>
                            <td class="td">-</td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_usage=NOUSAGE" class="text-black">` + value.nousage + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&cat_cm=CM" class="text-black">` + value.cm + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&witel_area=` + value.witel_area + `&sisa_caring=OK" class="text-black">` + value.sisa_caring + `</a></td>
                        </tr>`)
        });

        $('#tableWitelTetap').append(`
                      <tr class="tr" colspan="13">
                          <td class="td th bg-danger text-white">TREG VI</td>
                          <td class="td th bg-secondary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_zona=Green" class="text-white">` + total_tetap_green + `</a></td>
                          <td class="td th bg-secondary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_zona=Yellow" class="text-white">` + total_tetap_yellow + `</a></td>
                          <td class="td th bg-secondary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_zona=Red" class="text-white">` + total_tetap_red + `</a></td>
                          <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_spec=UNSPEK" class="text-white">` + total_tetap_unspek + `</a></td>
                          <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_ticket=TICKETINFRA" class="text-white">` + total_tetap_qjaringan + `</a></td>
                          <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_spec=OFFLINE" class="text-white">` + total_tetap_offline + `</a></td>
                          <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_qc=BELUM VALID" class="text-white">` + total_tetap_qc2 + `</a></td>
                          <td class="td th bg-primary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_ticket=TICKETCC" class="text-white">` + total_tetap_ticketcc + `</a></td>
                          <td class="td th bg-primary text-white">-</td>
                          <td class="td th bg-primary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_quota=OVERQUOTA" class="text-white">` + total_tetap_overquota + `</a></td>
                          <td class="td th bg-primary text-white"></td>
                          <td class="td th bg-primary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_usage=NOUSAGE" class="text-white">` + total_tetap_nousage + `</a></td>
                          <td class="td th bg-warning text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&cat_cm=CM" class="text-white">` + total_tetap_cm + `</a></td>
                          <td class="td th bg-warning text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=TETAP&sisa_caring=OK" class="text-white">` + total_tetap_sisa_caring + `</a></td>
                      </tr>`)

        $('#tableWitelBergerak').append(`
                        <tr class="tr" colspan="13">
                            <td class="td th bg-danger text-white">TREG VI</td>
                            <td class="td th bg-secondary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_zona=Green" class="text-white">` + total_bergerak_green + `</a></td>
                            <td class="td th bg-secondary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_zona=Yellow" class="text-white">` + total_bergerak_yellow + `</a></td>
                            <td class="td th bg-secondary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_zona=Red" class="text-white">` + total_bergerak_red + `</a></td>
                            <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_spec=UNSPEK" class="text-white" class="text-white">` + total_bergerak_unspek + `</a></td>
                            <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_ticket=TICKETINFRA" class="text-white" class="text-white">` + total_bergerak_qjaringan + `</a></td>
                            <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_spec=OFFLINE" class="text-white">` + total_bergerak_offline + `</a></td>
                            <td class="td th bg-success text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_qc=BELUM VALID" class="text-white">` + total_bergerak_qc2 + `</a></td>
                            <td class="td th bg-primary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_ticket=TICKETCC" class="text-white">` + total_bergerak_ticketcc + `</a></td>
                            <td class="td th bg-primary text-white">-</td>
                            <td class="td th bg-primary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_quota=OVERQUOTA" class="text-white">` + total_bergerak_overquota + `</a></td>
                            <td class="td th bg-primary text-white"></td>
                            <td class="td th bg-primary text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_usage=NOUSAGE" class="text-white">` + total_bergerak_nousage + `</a></td>
                            <td class="td th bg-warning text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&cat_cm=CM" class="text-white">` + total_bergerak_cm + `</a></td>
                            <td class="td th bg-warning text-white"><a href="{{ route('admin.pra_pra_npc_detail') }}?prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&bill=BERGERAK&sisa_caring=OK" class="text-white">` + total_bergerak_sisa_caring + `</a></td>
                        </tr>`)


          $('#totalSaldoUnpaidBill').append(` <h5>` + (total_tetap_sisa_caring) + `</h5>`)
          $('#totalSaldoPaidBill').append(` <h5>` + (total_bergerak_sisa_caring) + `</h5>`)
          $('#totalPraPraNPC').append(`<h5>Total Pra Pra NPC : <a href="{{ route('admin.pra_pra_npc_detail') }}?prioritas=2&sisa_caring=OK">`+(total_bergerak_sisa_caring + total_tetap_sisa_caring)+`</a></h5>`)

      }
    });
  }

  $('#btnFilter').click(function() {
    prediction = $('#prediction').val();
    segmen = $('#segmen').val();
    segmen_hvc = $('#segmen_hvc').val();
    // langganan = $('#langganan').val();
    load_content(prediction,segmen,segmen_hvc);
  });

});

</script>
@endsection
