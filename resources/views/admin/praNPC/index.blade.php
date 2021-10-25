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
                              <h5>Table 1</h5>
                            </div>&nbsp;
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
                              <tbody class="text-center" id="tableSatu">

                              </tbody>
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
                              <h5>Table 2</h5>
                            </div>&nbsp;
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
                              <tbody class="text-center" id="tableDua">

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

$(document).ready(function(){
  var source = $('#source').val();
  var prediction = $('#prediction').val();
  var segmen = $('#segmen').val();
  var segmen_hvc = $('#segmen_hvc').val();
  var tunggakan = $('#tunggakan').val();
  // var langganan = $('#langganan').val();
  load_content(source,prediction,segmen,segmen_hvc,tunggakan);

  function load_content(source,prediction,segmen,segmen_hvc,tunggakan) {
    source = source;
    prediction = prediction;
    segmen = segmen;
    segmen_hvc = segmen_hvc;
    tunggakan = tunggakan;
    $.ajax({
      'type': "GET",
      'dataType': "JSON",
      'url': "{{ route('admin.pra_npc') }}",
      'data': {
        source: source,
        prediction: prediction,
        segmen: segmen,
        segmen_hvc: segmen_hvc,
        tunggakan: tunggakan,
      },
      'success': function(data) {
        $('#tableSatu').empty();
        $('#tableDua').empty();
        $('#totalPraNPC').empty();

        var total_table_all = 0;
        // table satu
        var total_datapra1_val = 0;
        var total_paid_val = 0;
        var total_nonpaid_val = 0;
        // var total_janji_val = 0;
        // var total_ybs_val = 0;
        // var total_penghuni_val = 0;
        // var total_alamat_val = 0;
        // var total_rumah_val = 0;
        // var total_perangkat_val = 0;
        // var total_gangguan_val = 0;
        // var total_lain_val = 0;
        // var total_belumcaring_val = 0;
        var total_offline_val = 0;

        // table dua
        var total_datapra2_val = 0;
        var total_green_val = 0;
        var total_yellow_val = 0;
        var total_red_val = 0;
        var total_unspek_val = 0;
        var total_qjaringan_val = 0;
        var total_qc2_val = 0;
        var total_ticket_val = 0;
        // var total_ctl_val = 0;
        var total_quota_val = 0;
        // var total_device_val = 0;
        // var total_bi_val = 0;
        // var total_bl_val = 0;
        var total_cm_val = 0;
        // var total_pcf_val = 0;

        $.each(data.total_table_1, function(index, value) {
          total_datapra1_val += value.datapra1;
          total_paid_val += value.paid;
          total_nonpaid_val += value.nonpaid;
          // total_janji_val += value.a;
          // total_ybs_val += value.a;
          // total_penghuni_val += value.a;
          // total_alamat_val += value.a;
          // total_rumah_val += value.a;
          // total_perangkat_val += value.a;
          // total_gangguan_val += value.a;
          // total_lain_val += value.a;
          // total_belumcaring_val += value.a;
          total_offline_val += value.offline;
          total_table_all += value.total;

          $('#tableSatu').append(`
                        <tr class="tr">
                            <td class="td">` + value.witel_area + `</td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `" class="text-black">` + value.datapra1 + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&moving_bill=BERGERAK" class="text-black">` + value.paid + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&moving_bill=TETAP" class="text-black">` + value.nonpaid + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&caring=" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_spec=OFFLINE" class="text-black">` + value.offline + `</a></td>
                        </tr>`)
        });

        $.each(data.total_table_2, function(index, value) {
          total_datapra2_val += value.datapra2;
          total_green_val += value.green;
          total_yellow_val += value.yellow;
          total_red_val += value.red;
          total_unspek_val += value.unspek;
          total_qjaringan_val += value.qjaringan;
          total_qc2_val += value.qc2;
          total_ticket_val += value.ticket;
          // total_ctl_val += value.ctl;
          total_quota_val += value.quota;
          // total_device_val += value.device;
          // total_bi_val += value.bi;
          // total_bl_val += value.bl;
          total_cm_val += value.cm;
          // total_pcf_val += value.pcf;

          $('#tableDua').append(`
                        <tr class="tr">
                            <td class="td">` + value.witel_area + `</td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `" class="text-black">` + value.datapra2 + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_zona=Green" class="text-black">` + value.green + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_zona=Yellow" class="text-black">` + value.yellow + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_zona=Red" class="text-black">` + value.red + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_spec=UNSPEK" class="text-black">` + value.unspek + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_ticket=TICKETINFRA" class="text-black">` + value.qjaringan + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_qc=BELUM VALID" class="text-black">` + value.qc2 + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_ticket=TICKETCC" class="text-black">` + value.ticket + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_quota=OVERQUOTA" class="text-black">` + value.quota + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `" class="text-black">123</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `&cat_cm=CM" class="text-black">` + value.cm + `</a></td>
                            <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&witel_area=` + value.witel_area + `" class="text-black">123</a></td>
                        </tr>`)
        });

        $('#tableSatu').append(`
                      <tr class="tr">
                          <td class="td">TREG VI</td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`" class="text-black">` + total_datapra1_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&moving_bill=BERGERAK" class="text-black">` + total_paid_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&moving_bill=TETAP" class="text-black">` + total_nonpaid_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&caring=" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_spec=OFFLINE" class="text-black">` + total_offline_val + `</a></td>
                      </tr>`)

        $('#tableDua').append(`
                      <tr class="tr">
                          <td class="td">TREG VI</td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`" class="text-black">` + total_datapra2_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_zona=Green" class="text-black">` + total_green_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_zona=Yellow" class="text-black">` + total_yellow_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_zona=Red" class="text-black">` + total_red_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_spec=UNSPEK" class="text-black">` + total_unspek_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_ticket=TICKETINFRA" class="text-black">` + total_qjaringan_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_qc=BELUM VALID" class="text-black">` + total_qc2_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_ticket=TICKETCC" class="text-black">` + total_ticket_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_quota=OVERQUOTA" class="text-black">` + total_quota_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`" class="text-black">123</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`&cat_cm=CM" class="text-black">` + total_cm_val + `</a></td>
                          <td class="td"><a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`" class="text-black">123</a></td>
                      </tr>`)


          $('#totalPraNPC').append(`<h5>Total Pra NPC : <a href="{{ route('admin.pra_npc_detail') }}?source=`+ source +`&prediction=`+ prediction +`&segmen=` + segmen + `&segmen_hvc=`+ segmen_hvc +`&tunggakan=`+ tunggakan +`">`+total_table_all+`</a></h5>`)

      }
    });
  }

    $('#btnFilter').click(function() {
      source = $('#source').val();
      prediction = $('#prediction').val();
      segmen = $('#segmen').val();
      segmen_hvc = $('#segmen_hvc').val();
      tunggakan = $('#tunggakan').val();
      // var langganan = $('#langganan').val();
      load_content(source,prediction,segmen,segmen_hvc,tunggakan);
    });

});

</script>
@endsection
