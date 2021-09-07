@extends('layouts.admin')
@section('content')
<style>
  .table, .tr, .th, .td, .tdh {
    border: 1px solid black;
    text-align: center;
  }
  .card-table {
    margin-top: 2%;
  }
  .card-filter {
    margin-top: 1.5%;
    margin-left: 1%;
  }
  .col-card {
    margin-left:2%;
  }
  .card {
    display: flex;
  }
  .th4 {
    background-color: #6b1e40;
  }
</style>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>KPI New CT0</h4>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-8" style="width:60rem;">

                          <div class="row" style="margin:2% 0 0 0;">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control select2" name="prioritas" id="prioritas">
                                        <option value="prioritas_satu">Prioritas 1</option>
                                        <option value="prioritas_dua">Prioritas 2</option>
                                        <option value="prioritas_tiga">Prioritas 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group col col-md" style="margin-top:5px;">
                                    <button type="submit" class="btn btn-info" id="btnFilter">Filter</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="loading" class="card border-info">
                                    <div class="card-body">
                                      <div class="form-group" style="margin-top:5px;">
                                         <p id=""><h5>Sedang memproses... Mohon Tunggu</h5></p>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          </div>

                    </div>
                  </div>
                    <!-- start row -->
                    <div class="row">
                      <!-- start col 1 -->
                      <div class="col-sm-2" style="margin:1.7% 0 4% 0; padding:-5px -5px -5px -5px;">
                          <div class="table-responsive" style="position:absolute;">
                            <table class="table datatable" style="height:340px;">
                            <thead class="thead align-baseline text-center">
                              <tr class="" style="height:80px;">
                                  <th class="th bg-danger text-white" rowspan="2"> <b class="text-white">Witel</b> </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="tr" rowspan="2" style="height:40px;">
                                <td class="tdh">BALIKPAPAN</td>
                              </tr>
                              <tr class="tr" rowspan="2" style="height:40px;">
                                <td class="tdh">KALBAR</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:40px;">
                                <td class="tdh">KALTARA</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:40px;">
                                <td class="tdh">KALTENG</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:40px;">
                                <td class="tdh">KALSEL</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:40px;">
                                <td class="tdh">SAMARINDA</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:40px;">
                                <td class="tdh bg-danger text-white">TREG VI</td>
                              </tr>
                            </tbody>
                            </table>
                          </div>
                      </div>
                      <!-- end col 1 -->
                      <!-- col 2 -->
                      <div class="col-lg-10" style="">
                        <div class="card card-table">
                          <div class="table-responsive">
                            <table class="table datatable" id="tableData" style="height:340px;">
                            <thead class="thead align-baseline text-center">
                              <tr class="tr">
                                <th class="th bg-success" colspan="4"><b class="text-white">P1 - Infra</b></th>
                                <th class="th bg-primary" colspan="5"><b class="text-white">P2 - Customer Care</b></th>
                                <th class="th bg-warning" colspan="4"><b class="text-white">P3 - CM Pelanggan</b></th>
                                <th class="th th4" colspan="3"><b class="text-white">P4 - Paycoll</b></th>
                              </tr>
                              <tr class="tr">
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
                                  <th class="th bg-warning"><b class="text-white">Channel PSB 1</b></th>
                                  <th class="th bg-warning"><b class="text-white">Channel PSB 2</b></th>
                                  <th class="th bg-warning"><b class="text-white">Channel PSB 3</b></th>
                                  <th class="th bg-warning"><b class="text-white">Channel PSB 4</b></th>
                                  <!-- p4 payroll -->
                                  <th class="th th4"><b class="text-white">Caring OK</b></th>
                                  <th class="th th4"><b class="text-white">Caring NOK</b></th>
                                  <th class="th th4"><b class="text-white">Sisa Caring</b></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="tr" colspan="16">
                                <td class="td" id="balikpapan_unspek">-</td>
                                <td class="td" id="balikpapan_qjaringan"></td>
                                <td class="td" id="balikpapan_modemoff"></td>
                                <td class="td" id="balikpapan_qc2"></td>
                                <td class="td" id="balikpapan_tiketcc"></td>
                                <td class="td" id="balikpapan_ctl"></td>
                                <td class="td" id="balikpapan_quota"></td>
                                <td class="td" id="balikpapan_device"></td>
                                <td class="td" id="balikpapan_nousage"></td>
                                <td class="td" id="balikpapan_psb1"></td>
                                <td class="td" id="balikpapan_psb2"></td>
                                <td class="td" id="balikpapan_psb3"></td>
                                <td class="td" id="balikpapan_psb4"></td>
                                <td class="td" id="balikpapan_caringok"></td>
                                <td class="td" id="balikpapan_caringnok"></td>
                                <td class="td" id="balikpapan_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td" id="kalbar_unspek">-</td>
                                <td class="td" id="kalbar_qjaringan"></td>
                                <td class="td" id="kalbar_modemoff"></td>
                                <td class="td" id="kalbar_qc2"></td>
                                <td class="td" id="kalbar_tiketcc"></td>
                                <td class="td" id="kalbar_ctl"></td>
                                <td class="td" id="kalbar_quota"></td>
                                <td class="td" id="kalbar_device"></td>
                                <td class="td" id="kalbar_nousage"></td>
                                <td class="td" id="kalbar_psb1"></td>
                                <td class="td" id="kalbar_psb2"></td>
                                <td class="td" id="kalbar_psb3"></td>
                                <td class="td" id="kalbar_psb4"></td>
                                <td class="td" id="kalbar_caringok"></td>
                                <td class="td" id="kalbar_caringnok"></td>
                                <td class="td" id="kalbar_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td" id="kaltara_unspek">-</td>
                                <td class="td" id="kaltara_qjaringan"></td>
                                <td class="td" id="kaltara_modemoff"></td>
                                <td class="td" id="kaltara_qc2"></td>
                                <td class="td" id="kaltara_tiketcc"></td>
                                <td class="td" id="kaltara_ctl"></td>
                                <td class="td" id="kaltara_quota"></td>
                                <td class="td" id="kaltara_device"></td>
                                <td class="td" id="kaltara_nousage"></td>
                                <td class="td" id="kaltara_psb1"></td>
                                <td class="td" id="kaltara_psb2"></td>
                                <td class="td" id="kaltara_psb3"></td>
                                <td class="td" id="kaltara_psb4"></td>
                                <td class="td" id="kaltara_caringok"></td>
                                <td class="td" id="kaltara_caringnok"></td>
                                <td class="td" id="kaltara_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td" id="kalteng_unspek">-</td>
                                <td class="td" id="kalteng_qjaringan"></td>
                                <td class="td" id="kalteng_modemoff"></td>
                                <td class="td" id="kalteng_qc2"></td>
                                <td class="td" id="kalteng_tiketcc"></td>
                                <td class="td" id="kalteng_ctl"></td>
                                <td class="td" id="kalteng_quota"></td>
                                <td class="td" id="kalteng_device"></td>
                                <td class="td" id="kalteng_nousage"></td>
                                <td class="td" id="kalteng_psb1"></td>
                                <td class="td" id="kalteng_psb2"></td>
                                <td class="td" id="kalteng_psb3"></td>
                                <td class="td" id="kalteng_psb4"></td>
                                <td class="td" id="kalteng_caringok"></td>
                                <td class="td" id="kalteng_caringnok"></td>
                                <td class="td" id="kalteng_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td" id="kalsel_unspek">-</td>
                                <td class="td" id="kalsel_qjaringan"></td>
                                <td class="td" id="kalsel_modemoff"></td>
                                <td class="td" id="kalsel_qc2"></td>
                                <td class="td" id="kalsel_tiketcc"></td>
                                <td class="td" id="kalsel_ctl"></td>
                                <td class="td" id="kalsel_quota"></td>
                                <td class="td" id="kalsel_device"></td>
                                <td class="td" id="kalsel_nousage"></td>
                                <td class="td" id="kalsel_psb1"></td>
                                <td class="td" id="kalsel_psb2"></td>
                                <td class="td" id="kalsel_psb3"></td>
                                <td class="td" id="kalsel_psb4"></td>
                                <td class="td" id="kalsel_caringok"></td>
                                <td class="td" id="kalsel_caringnok"></td>
                                <td class="td" id="kalsel_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td" id="samarinda_unspek">-</td>
                                <td class="td" id="samarinda_qjaringan"></td>
                                <td class="td" id="samarinda_modemoff"></td>
                                <td class="td" id="samarinda_qc2"></td>
                                <td class="td" id="samarinda_tiketcc"></td>
                                <td class="td" id="samarinda_ctl"></td>
                                <td class="td" id="samarinda_quota"></td>
                                <td class="td" id="samarinda_device"></td>
                                <td class="td" id="samarinda_nousage"></td>
                                <td class="td" id="samarinda_psb1"></td>
                                <td class="td" id="samarinda_psb2"></td>
                                <td class="td" id="samarinda_psb3"></td>
                                <td class="td" id="samarinda_psb4"></td>
                                <td class="td" id="samarinda_caringok"></td>
                                <td class="td" id="samarinda_caringnok"></td>
                                <td class="td" id="samarinda_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td bg-success text-white" id="total_unspek">-</td>
                                <td class="td bg-success text-white" id="total_qjaringan"></td>
                                <td class="td bg-success text-white" id="total_modemoff"></td>
                                <td class="td bg-success text-white" id="total_qc2"></td>
                                <td class="td bg-primary text-white" id="total_tiketcc"></td>
                                <td class="td bg-primary text-white" id="total_ctl"></td>
                                <td class="td bg-primary text-white" id="total_quota"></td>
                                <td class="td bg-primary text-white" id="total_device"></td>
                                <td class="td bg-primary text-white" id="total_nousage"></td>
                                <td class="td bg-warning text-white" id="total_psb1"></td>
                                <td class="td bg-warning text-white" id="total_psb2"></td>
                                <td class="td bg-warning text-white" id="total_psb3"></td>
                                <td class="td bg-warning text-white" id="total_psb4"></td>
                                <td class="td th4 text-white" id="total_caringok"></td>
                                <td class="td th4 text-white" id="total_caringnok"></td>
                                <td class="td th4 text-white" id="total_sisa"></td>
                              </tr>
                            </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- end col 2 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){


        function load_content(prioritas){
            $.ajax({
              'type': "GET",
              'dataType': "JSON",
              'url': '{{ route('admin.machine-learning.new_ct0') }}',
              'data': {
                prioritas: prioritas,
              },
              'beforeSend': function(){
                    $('#loading').show();
              },
              'success': function(data){
                    $('#loading').hide();
                    $('.td').empty();

                    $('#balikpapan_unspek').append(data.balikpapan_unspek);
                    $('#balikpapan_qjaringan').append(data.balikpapan_qjaringan);
                    $('#balikpapan_modemoff').append(data.balikpapan_modemoff);
                    $('#balikpapan_qc2').append(data.balikpapan_qc2);
                    $('#balikpapan_tiketcc').append(data.balikpapan_tiketcc);
                    $('#balikpapan_ctl').append(data.balikpapan_ctl);
                    $('#balikpapan_quota').append(data.balikpapan_quota);
                    $('#balikpapan_device').append(data.balikpapan_device);
                    $('#balikpapan_nousage').append(data.balikpapan_nousage);
                    $('#balikpapan_psb1').append(data.balikpapan_psb1);
                    $('#balikpapan_psb2').append(data.balikpapan_psb2);
                    $('#balikpapan_psb3').append(data.balikpapan_psb3);
                    $('#balikpapan_psb4').append(data.balikpapan_psb4);
                    $('#balikpapan_caringok').append(data.balikpapan_caringok);
                    $('#balikpapan_caringnok').append(data.balikpapan_caringnok);
                    $('#balikpapan_sisa').append(data.balikpapan_sisa);

                    $('#kalbar_unspek').append(data.kalbar_unspek);
                    $('#kalbar_qjaringan').append(data.kalbar_qjaringan);
                    $('#kalbar_modemoff').append(data.kalbar_modemoff);
                    $('#kalbar_qc2').append(data.kalbar_qc2);
                    $('#kalbar_tiketcc').append(data.kalbar_tiketcc);
                    $('#kalbar_ctl').append(data.kalbar_ctl);
                    $('#kalbar_quota').append(data.kalbar_quota);
                    $('#kalbar_device').append(data.kalbar_device);
                    $('#kalbar_nousage').append(data.kalbar_nousage);
                    $('#kalbar_psb1').append(data.kalbar_psb1);
                    $('#kalbar_psb2').append(data.kalbar_psb2);
                    $('#kalbar_psb3').append(data.kalbar_psb3);
                    $('#kalbar_psb4').append(data.kalbar_psb4);
                    $('#kalbar_caringok').append(data.kalbar_caringok);
                    $('#kalbar_caringnok').append(data.kalbar_caringnok);
                    $('#kalbar_sisa').append(data.kalbar_sisa);

                    $('#kaltara_unspek').append(data.kaltara_unspek);
                  $('#kaltara_qjaringan').append(data.kaltara_qjaringan);
                  $('#kaltara_modemoff').append(data.kaltara_modemoff);
                  $('#kaltara_qc2').append(data.kaltara_qc2);
                  $('#kaltara_tiketcc').append(data.kaltara_tiketcc);
                  $('#kaltara_ctl').append(data.kaltara_ctl);
                  $('#kaltara_quota').append(data.kaltara_quota);
                  $('#kaltara_device').append(data.kaltara_device);
                  $('#kaltara_nousage').append(data.kaltara_nousage);
                  $('#kaltara_psb1').append(data.kaltara_psb1);
                  $('#kaltara_psb2').append(data.kaltara_psb2);
                  $('#kaltara_psb3').append(data.kaltara_psb3);
                  $('#kaltara_psb4').append(data.kaltara_psb4);
                  $('#kaltara_caringok').append(data.kaltara_caringok);
                  $('#kaltara_caringnok').append(data.kaltara_caringnok);
                  $('#kaltara_sisa').append(data.kaltara_sisa);

                  $('#kalteng_unspek').append(data.kalteng_unspek);
                $('#kalteng_qjaringan').append(data.kalteng_qjaringan);
                $('#kalteng_modemoff').append(data.kalteng_modemoff);
                $('#kalteng_qc2').append(data.kalteng_qc2);
                $('#kalteng_tiketcc').append(data.kalteng_tiketcc);
                $('#kalteng_ctl').append(data.kalteng_ctl);
                $('#kalteng_quota').append(data.kalteng_quota);
                $('#kalteng_device').append(data.kalteng_device);
                $('#kalteng_nousage').append(data.kalteng_nousage);
                $('#kalteng_psb1').append(data.kalteng_psb1);
                $('#kalteng_psb2').append(data.kalteng_psb2);
                $('#kalteng_psb3').append(data.kalteng_psb3);
                $('#kalteng_psb4').append(data.kalteng_psb4);
                $('#kalteng_caringok').append(data.kalteng_caringok);
                $('#kalteng_caringnok').append(data.kalteng_caringnok);
                $('#kalteng_sisa').append(data.kalteng_sisa);

                $('#kalsel_unspek').append(data.kalsel_unspek);
              $('#kalsel_qjaringan').append(data.kalsel_qjaringan);
              $('#kalsel_modemoff').append(data.kalsel_modemoff);
              $('#kalsel_qc2').append(data.kalsel_qc2);
              $('#kalsel_tiketcc').append(data.kalsel_tiketcc);
              $('#kalsel_ctl').append(data.kalsel_ctl);
              $('#kalsel_quota').append(data.kalsel_quota);
              $('#kalsel_device').append(data.kalsel_device);
              $('#kalsel_nousage').append(data.kalsel_nousage);
              $('#kalsel_psb1').append(data.kalsel_psb1);
              $('#kalsel_psb2').append(data.kalsel_psb2);
              $('#kalsel_psb3').append(data.kalsel_psb3);
              $('#kalsel_psb4').append(data.kalsel_psb4);
              $('#kalsel_caringok').append(data.kalsel_caringok);
              $('#kalsel_caringnok').append(data.kalsel_caringnok);
              $('#kalsel_sisa').append(data.kalsel_sisa);

              $('#samarinda_unspek').append(data.samarinda_unspek);
              $('#samarinda_qjaringan').append(data.samarinda_qjaringan);
              $('#samarinda_modemoff').append(data.samarinda_modemoff);
              $('#samarinda_qc2').append(data.samarinda_qc2);
              $('#samarinda_tiketcc').append(data.samarinda_tiketcc);
              $('#samarinda_ctl').append(data.samarinda_ctl);
              $('#samarinda_quota').append(data.samarinda_quota);
              $('#samarinda_device').append(data.samarinda_device);
              $('#samarinda_nousage').append(data.samarinda_nousage);
              $('#samarinda_psb1').append(data.samarinda_psb1);
              $('#samarinda_psb2').append(data.samarinda_psb2);
              $('#samarinda_psb3').append(data.samarinda_psb3);
              $('#samarinda_psb4').append(data.samarinda_psb4);
              $('#samarinda_caringok').append(data.samarinda_caringok);
              $('#samarinda_caringnok').append(data.samarinda_caringnok);
              $('#samarinda_sisa').append(data.samarinda_sisa);

                    $('#total_unspek').append(data.total_unspek);
                    $('#total_qjaringan').append(data.total_qjaringan);
                    $('#total_modemoff').append(data.total_modemoff);
                    $('#total_qc2').append(data.total_qc2);
                    $('#total_tiketcc').append(data.total_tiketcc);
                    $('#total_ctl').append(data.total_ctl);
                    $('#total_quota').append(data.total_quota);
                    $('#total_device').append(data.total_device);
                    $('#total_nousage').append(data.total_nousage);
                    $('#total_psb1').append(data.total_psb1);
                    $('#total_psb2').append(data.total_psb2);
                    $('#total_psb3').append(data.total_psb3);
                    $('#total_psb4').append(data.total_psb4);
                    $('#total_caringok').append(data.total_caringok);
                    $('#total_caringnok').append(data.total_caringnok);
                    $('#total_sisa').append(data.total_sisa);
              }
            });
          }

      $('#btnFilter').click(function(){
            var prioritas = $('#prioritas').val();
            //$('#loading').show();
            load_content(prioritas);
      });

        $('#loading').hide();
});
</script>
@endsection
