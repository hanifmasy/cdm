@extends('layouts.admin')
@section('content')
<style>
  .table, .tr, .th, .td {
    border: 1px solid black;
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
                        <h4>Input New CT0</h4>
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
                                      <button type="submit" class="btn btn-info" id="btnSave">Save</button>
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
                            <table class="table datatable" style="height:380px;">
                            <thead class="thead align-baseline text-center">
                              <tr class="" style="height:69px;">
                                  <th class="th bg-danger text-white" rowspan="2"> <b class="text-white">Witel</b> </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="tr" rowspan="2" style="height:35px;">
                                <td class="td">BALIKPAPAN</td>
                              </tr>
                              <tr class="tr" rowspan="2" style="height:35px;">
                                <td class="td">KALBAR</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:35px;">
                                <td class="td">KALTARA</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:35px;">
                                <td class="td">KALTENG</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:35px;">
                                <td class="td">KALSEL</td>
                              </tr>
                              <tr class="tr" colspan="" style="height:35px;">
                                <td class="td">SAMARINDA</td>
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
                            <table class="table datatable">
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
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_unspek" name="balikpapan_unspek"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_qjaringan" name="balikpapan_qjaringan"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_modemoff" name="balikpapan_modemoff"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_qc2" name="balikpapan_qc2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_tiketcc" name="balikpapan_tiketcc"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_ctl" name="balikpapan_ctl"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_quota" name="balikpapan_quota"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_device" name="balikpapan_device"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_nousage" name="balikpapan_nousage"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_psb1" name="balikpapan_psb1"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_psb2" name="balikpapan_psb2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_psb3" name="balikpapan_psb3"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_psb4" name="balikpapan_psb4"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_caringok" name="balikpapan_caringok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_caringnok" name="balikpapan_caringnok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="balikpapan_sisa" name="balikpapan_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_unspek" name="kalbar_unspek"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_qjaringan" name="kalbar_qjaringan"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_modemoff" name="kalbar_modemoff"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_qc2" name="kalbar_qc2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_tiketcc" name="kalbar_tiketcc"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_ctl" name="kalbar_ctl"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_quota" name="kalbar_quota"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_device" name="kalbar_device"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_nousage" name="kalbar_nousage"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_psb1" name="kalbar_psb1"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_psb2" name="kalbar_psb2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_psb3" name="kalbar_psb3"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_psb4" name="kalbar_psb4"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_caringok" name="kalbar_caringok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_caringnok" name="kalbar_caringnok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalbar_sisa" name="kalbar_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_unspek" name="kaltara_unspek"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_qjaringan" name="kaltara_qjaringan"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_modemoff" name="kaltara_modemoff"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_qc2" name="kaltara_qc2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_tiketcc" name="kaltara_tiketcc"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_ctl" name="kaltara_ctl"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_quota" name="kaltara_quota"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_device" name="kaltara_device"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_nousage" name="kaltara_nousage"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_psb1" name="kaltara_psb1"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_psb2" name="kaltara_psb2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_psb3" name="kaltara_psb3"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_psb4" name="kaltara_psb4"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_caringok" name="kaltara_caringok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_caringnok" name="kaltara_caringnok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kaltara_sisa" name="kaltara_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_unspek" name="kalteng_unspek"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_qjaringan" name="kalteng_qjaringan"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_modemoff" name="kalteng_modemoff"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_qc2" name="kalteng_qc2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_tiketcc" name="kalteng_tiketcc"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_ctl" name="kalteng_ctl"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_quota" name="kalteng_quota"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_device" name="kalteng_device"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_nousage" name="kalteng_nousage"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_psb1" name="kalteng_psb1"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_psb2" name="kalteng_psb2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_psb3" name="kalteng_psb3"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_psb4" name="kalteng_psb4"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_caringok" name="kalteng_caringok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_caringnok" name="kalteng_caringnok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalteng_sisa" name="kalteng_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_unspek" name="kalsel_unspek"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_qjaringan" name="kalsel_qjaringan"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_modemoff" name="kalsel_modemoff"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_qc2" name="kalsel_qc2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_tiketcc" name="kalsel_tiketcc"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_ctl" name="kalsel_ctl"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_quota" name="kalsel_quota"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_device" name="kalsel_device"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_nousage" name="kalsel_nousage"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_psb1" name="kalsel_psb1"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_psb2" name="kalsel_psb2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_psb3" name="kalsel_psb3"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_psb4" name="kalsel_psb4"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_caringok" name="kalsel_caringok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_caringnok" name="kalsel_caringnok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="kalsel_sisa" name="kalsel_sisa"></td>
                              </tr>
                              <tr class="tr" colspan="16">
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_unspek" name="samarinda_unspek"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_qjaringan" name="samarinda_qjaringan"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_modemoff" name="samarinda_modemoff"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_qc2" name="samarinda_qc2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_tiketcc" name="samarinda_tiketcc"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_ctl" name="samarinda_ctl"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_quota" name="samarinda_quota"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_device" name="samarinda_device"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_nousage" name="samarinda_nousage"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_psb1" name="samarinda_psb1"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_psb2" name="samarinda_psb2"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_psb3" name="samarinda_psb3"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_psb4" name="samarinda_psb4"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_caringok" name="samarinda_caringok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_caringnok" name="samarinda_caringnok"></td>
                                <td class="td"><input style="width:5rem;" type="text" id="samarinda_sisa" name="samarinda_sisa"></td>
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
    $('#loading').hide();

        function save_content(prioritas,objData){
            $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
           $.ajax({
             'type': "POST",
             'url': '{{ route('admin.machine-learning.insertDataNewCt0') }}',
             'data': {
                 prioritas: prioritas,
                 objData: objData,
             },
             'beforeSend': function(){
                   $('#loading').show();
             },
             'success': function(result){
                  $('#loading').hide();
                  //if(result){alert("Data berhasil ditambahkan");}
             }
           });
         }

        $('#btnSave').click(function(e) {
            var prioritas = $('#prioritas').val();
            //balikpapan
            var balikpapan_unspek = $('#balikpapan_unspek').val();
            var balikpapan_qjaringan = $('#balikpapan_qjaringan').val();
            var balikpapan_modemoff = $('#balikpapan_modemoff').val();
            var balikpapan_qc2 = $('#balikpapan_qc2').val();
            var balikpapan_tiketcc = $('#balikpapan_tiketcc').val();
            var balikpapan_ctl = $('#balikpapan_ctl').val();
            var balikpapan_quota = $('#balikpapan_quota').val();
            var balikpapan_device = $('#balikpapan_device').val();
            var balikpapan_nousage = $('#balikpapan_nousage').val();
            var balikpapan_psb1 = $('#balikpapan_psb1').val();
            var balikpapan_psb2 = $('#balikpapan_psb2').val();
            var balikpapan_psb3 = $('#balikpapan_psb3').val();
            var balikpapan_psb4 = $('#balikpapan_psb4').val();
            var balikpapan_caringok = $('#balikpapan_caringok').val();
            var balikpapan_caringnok = $('#balikpapan_caringnok').val();
            var balikpapan_sisa = $('#balikpapan_sisa').val();
            //kalbar
            var kalbar_unspek = $('#kalbar_unspek').val();
            var kalbar_qjaringan = $('#kalbar_qjaringan').val();
            var kalbar_modemoff = $('#kalbar_modemoff').val();
            var kalbar_qc2 = $('#kalbar_qc2').val();
            var kalbar_tiketcc = $('#kalbar_tiketcc').val();
            var kalbar_ctl = $('#kalbar_ctl').val();
            var kalbar_quota = $('#kalbar_quota').val();
            var kalbar_device = $('#kalbar_device').val();
            var kalbar_nousage = $('#kalbar_nousage').val();
            var kalbar_psb1 = $('#kalbar_psb1').val();
            var kalbar_psb2 = $('#kalbar_psb2').val();
            var kalbar_psb3 = $('#kalbar_psb3').val();
            var kalbar_psb4 = $('#kalbar_psb4').val();
            var kalbar_caringok = $('#kalbar_caringok').val();
            var kalbar_caringnok = $('#kalbar_caringnok').val();
            var kalbar_sisa = $('#kalbar_sisa').val();
            //kaltara
            var kaltara_unspek = $('#kaltara_unspek').val();
            var kaltara_qjaringan = $('#kaltara_qjaringan').val();
            var kaltara_modemoff = $('#kaltara_modemoff').val();
            var kaltara_qc2 = $('#kaltara_qc2').val();
            var kaltara_tiketcc = $('#kaltara_tiketcc').val();
            var kaltara_ctl = $('#kaltara_ctl').val();
            var kaltara_quota = $('#kaltara_quota').val();
            var kaltara_device = $('#kaltara_device').val();
            var kaltara_nousage = $('#kaltara_nousage').val();
            var kaltara_psb1 = $('#kaltara_psb1').val();
            var kaltara_psb2 = $('#kaltara_psb2').val();
            var kaltara_psb3 = $('#kaltara_psb3').val();
            var kaltara_psb4 = $('#kaltara_psb4').val();
            var kaltara_caringok = $('#kaltara_caringok').val();
            var kaltara_caringnok = $('#kaltara_caringnok').val();
            var kaltara_sisa = $('#kaltara_sisa').val();
            //kalteng
            var kalteng_unspek = $('#kalteng_unspek').val();
            var kalteng_qjaringan = $('#kalteng_qjaringan').val();
            var kalteng_modemoff = $('#kalteng_modemoff').val();
            var kalteng_qc2 = $('#kalteng_qc2').val();
            var kalteng_tiketcc = $('#kalteng_tiketcc').val();
            var kalteng_ctl = $('#kalteng_ctl').val();
            var kalteng_quota = $('#kalteng_quota').val();
            var kalteng_device = $('#kalteng_device').val();
            var kalteng_nousage = $('#kalteng_nousage').val();
            var kalteng_psb1 = $('#kalteng_psb1').val();
            var kalteng_psb2 = $('#kalteng_psb2').val();
            var kalteng_psb3 = $('#kalteng_psb3').val();
            var kalteng_psb4 = $('#kalteng_psb4').val();
            var kalteng_caringok = $('#kalteng_caringok').val();
            var kalteng_caringnok = $('#kalteng_caringnok').val();
            var kalteng_sisa = $('#kalteng_sisa').val();
            //kalsel
            var kalsel_unspek = $('#kalsel_unspek').val();
            var kalsel_qjaringan = $('#kalsel_qjaringan').val();
            var kalsel_modemoff = $('#kalsel_modemoff').val();
            var kalsel_qc2 = $('#kalsel_qc2').val();
            var kalsel_tiketcc = $('#kalsel_tiketcc').val();
            var kalsel_ctl = $('#kalsel_ctl').val();
            var kalsel_quota = $('#kalsel_quota').val();
            var kalsel_device = $('#kalsel_device').val();
            var kalsel_nousage = $('#kalsel_nousage').val();
            var kalsel_psb1 = $('#kalsel_psb1').val();
            var kalsel_psb2 = $('#kalsel_psb2').val();
            var kalsel_psb3 = $('#kalsel_psb3').val();
            var kalsel_psb4 = $('#kalsel_psb4').val();
            var kalsel_caringok = $('#kalsel_caringok').val();
            var kalsel_caringnok = $('#kalsel_caringnok').val();
            var kalsel_sisa = $('#kalsel_sisa').val();
            //samarinda
            var samarinda_unspek = $('#samarinda_unspek').val();
            var samarinda_qjaringan = $('#samarinda_qjaringan').val();
            var samarinda_modemoff = $('#samarinda_modemoff').val();
            var samarinda_qc2 = $('#samarinda_qc2').val();
            var samarinda_tiketcc = $('#samarinda_tiketcc').val();
            var samarinda_ctl = $('#samarinda_ctl').val();
            var samarinda_quota = $('#samarinda_quota').val();
            var samarinda_device = $('#samarinda_device').val();
            var samarinda_nousage = $('#samarinda_nousage').val();
            var samarinda_psb1 = $('#samarinda_psb1').val();
            var samarinda_psb2 = $('#samarinda_psb2').val();
            var samarinda_psb3 = $('#samarinda_psb3').val();
            var samarinda_psb4 = $('#samarinda_psb4').val();
            var samarinda_caringok = $('#samarinda_caringok').val();
            var samarinda_caringnok = $('#samarinda_caringnok').val();
            var samarinda_sisa = $('#samarinda_sisa').val();

            var objData = {
                  balikpapan_unspek: balikpapan_unspek,
                  balikpapan_qjaringan: balikpapan_qjaringan,
                  balikpapan_modemoff: balikpapan_modemoff,
                  balikpapan_qc2: balikpapan_qc2,
                  balikpapan_tiketcc: balikpapan_tiketcc,
                  balikpapan_ctl: balikpapan_ctl,
                  balikpapan_quota: balikpapan_quota,
                  balikpapan_device: balikpapan_device,
                  balikpapan_nousage: balikpapan_nousage,
                  balikpapan_psb1: balikpapan_psb1,
                  balikpapan_psb2: balikpapan_psb2,
                  balikpapan_psb3: balikpapan_psb3,
                  balikpapan_psb4: balikpapan_psb4,
                  balikpapan_caringok: balikpapan_caringok,
                  balikpapan_caringnok: balikpapan_caringnok,
                  balikpapan_sisa: balikpapan_sisa,
                  //kalbar
                  kalbar_unspek: kalbar_unspek,
                  kalbar_qjaringan: kalbar_qjaringan,
                  kalbar_modemoff: kalbar_modemoff,
                  kalbar_qc2: kalbar_qc2,
                  kalbar_tiketcc: kalbar_tiketcc,
                  kalbar_ctl: kalbar_ctl,
                  kalbar_quota: kalbar_quota,
                  kalbar_device: kalbar_device,
                  kalbar_nousage: kalbar_nousage,
                  kalbar_psb1: kalbar_psb1,
                  kalbar_psb2: kalbar_psb2,
                  kalbar_psb3: kalbar_psb3,
                  kalbar_psb4: kalbar_psb4,
                  kalbar_caringok: kalbar_caringok,
                  kalbar_caringnok: kalbar_caringnok,
                  kalbar_sisa: kalbar_sisa,
                  //kaltara
                  kaltara_unspek: kaltara_unspek,
                  kaltara_qjaringan: kaltara_qjaringan,
                  kaltara_modemoff: kaltara_modemoff,
                  kaltara_qc2: kaltara_qc2,
                  kaltara_tiketcc: kaltara_tiketcc,
                  kaltara_ctl: kaltara_ctl,
                  kaltara_quota: kaltara_quota,
                  kaltara_device: kaltara_device,
                  kaltara_nousage: kaltara_nousage,
                  kaltara_psb1: kaltara_psb1,
                  kaltara_psb2: kaltara_psb2,
                  kaltara_psb3: kaltara_psb3,
                  kaltara_psb4: kaltara_psb4,
                  kaltara_caringok: kaltara_caringok,
                  kaltara_caringnok: kaltara_caringnok,
                  kaltara_sisa: kaltara_sisa,
                  //kalteng
                  kalteng_unspek: kalteng_unspek,
                  kalteng_qjaringan: kalteng_qjaringan,
                  kalteng_modemoff: kalteng_modemoff,
                  kalteng_qc2: kalteng_qc2,
                  kalteng_tiketcc: kalteng_tiketcc,
                  kalteng_ctl: kalteng_ctl,
                  kalteng_quota: kalteng_quota,
                  kalteng_device: kalteng_device,
                  kalteng_nousage: kalteng_nousage,
                  kalteng_psb1: kalteng_psb1,
                  kalteng_psb2: kalteng_psb2,
                  kalteng_psb3: kalteng_psb3,
                  kalteng_psb4: kalteng_psb4,
                  kalteng_caringok: kalteng_caringok,
                  kalteng_caringnok: kalteng_caringnok,
                  kalteng_sisa: kalteng_sisa,
                  //kalsel
                  kalsel_unspek: kalsel_unspek,
                  kalsel_qjaringan: kalsel_qjaringan,
                  kalsel_modemoff: kalsel_modemoff,
                  kalsel_qc2: kalsel_qc2,
                  kalsel_tiketcc: kalsel_tiketcc,
                  kalsel_ctl: kalsel_ctl,
                  kalsel_quota: kalsel_quota,
                  kalsel_device: kalsel_device,
                  kalsel_nousage: kalsel_nousage,
                  kalsel_psb1: kalsel_psb1,
                  kalsel_psb2: kalsel_psb2,
                  kalsel_psb3: kalsel_psb3,
                  kalsel_psb4: kalsel_psb4,
                  kalsel_caringok: kalsel_caringok,
                  kalsel_caringnok: kalsel_caringnok,
                  kalsel_sisa: kalsel_sisa,
                  //samarinda
                  samarinda_unspek: samarinda_unspek,
                  samarinda_qjaringan: samarinda_qjaringan,
                  samarinda_modemoff: samarinda_modemoff,
                  samarinda_qc2: samarinda_qc2,
                  samarinda_tiketcc: samarinda_tiketcc,
                  samarinda_ctl: samarinda_ctl,
                  samarinda_quota: samarinda_quota,
                  samarinda_device: samarinda_device,
                  samarinda_nousage: samarinda_nousage,
                  samarinda_psb1: samarinda_psb1,
                  samarinda_psb2: samarinda_psb2,
                  samarinda_psb3: samarinda_psb3,
                  samarinda_psb4: samarinda_psb4,
                  samarinda_caringok: samarinda_caringok,
                  samarinda_caringnok: samarinda_caringnok,
                  samarinda_sisa: samarinda_sisa,
                };

            //console.log(prioritas,arrData);
            save_content(prioritas,objData);
        });

  });
</script>
@endsection
