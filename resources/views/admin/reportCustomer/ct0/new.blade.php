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
                    <div class="col-lg-6" style="width:60rem;">

                          <div class="row" style="margin:2% 0 0 0;">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control select2" name="prioritas" id="prioritas">
                                        <option value="1">Prior 1</option>
                                        <option value="2">Prior 2</option>
                                        <option value="3">Prior 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group col col-md" style="margin-top:5px;">
                                    <button type="submit" class="btn btn-info" id="btnFilter">Filter</button>
                                </div>
                            </div>
                          </div>

                    </div>
                  </div>
                    <!-- start row -->
                    <div class="row">
                      <div class="col-lg-12" style="">
                        <div class="card card-table">
                          <div class="card-header">
                              <h5>DATA TETAP</h5>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table datatable" id="" style="height:340px;">
                              <thead class="thead align-baseline text-center">
                                <tr class="tr">
                                  <th class="th bg-danger" rowspan="2"><b class="text-white">Witel</b></th>
                                  <th class="th bg-secondary" colspan="3"><b class="text-white">Zona Occupancy</b></th>
                                  <th class="th bg-success" colspan="4"><b class="text-white">P1 - Infra</b></th>
                                  <th class="th bg-primary" colspan="5"><b class="text-white">P2 - Customer Care</b></th>
                                  <th class="th bg-warning" colspan="1"><b class="text-white">P3 - CM Pelanggan</b></th>
                                  <th class="th th4" colspan="1"><b class="text-white">P4 - Paycoll</b></th>
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
                                    <th class="th bg-warning"><b class="text-white">Channel PSB</b></th>
                                    <!-- p4 payroll -->
                                    <th class="th th4"><b class="text-white">Sisa Caring</b></th>
                                </tr>
                              </thead>
                              <tbody  id="tableWitelTetap">
                                </tr>
                              </tbody>
                              <tfoot id="tableTotalTetap">
                              </tfoot>
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
                              <h5>DATA BERGERAK</h5>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table datatable" id="" style="height:340px;">
                              <thead class="thead align-baseline text-center">
                                <tr class="tr">
                                  <th class="th bg-danger" rowspan="2"><b class="text-white">Witel</b></th>
                                  <th class="th bg-secondary" colspan="3"><b class="text-white">Zona Occupancy</b></th>
                                  <th class="th bg-success" colspan="4"><b class="text-white">P1 - Infra</b></th>
                                  <th class="th bg-primary" colspan="5"><b class="text-white">P2 - Customer Care</b></th>
                                  <th class="th bg-warning" colspan="1"><b class="text-white">P3 - CM Pelanggan</b></th>
                                  <th class="th th4" colspan="1"><b class="text-white">P4 - Paycoll</b></th>
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
                                    <th class="th bg-warning"><b class="text-white">Channel PSB</b></th>
                                    <!-- p4 payroll -->
                                    <th class="th th4"><b class="text-white">Sisa Caring</b></th>
                                </tr>
                              </thead>
                              <tbody  id="tableWitelBergerak">
                                </tr>
                              </tbody>
                              <tfoot id="tableTotalBergerak">
                              </tfoot>
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
var prioritas = $('#prioritas').val();
load_content(prioritas);

        function load_content(prioritas){
            $.ajax({
              'type': "GET",
              'dataType': "JSON",
              'url': '{{ route('admin.machine-learning.new_ct0') }}',
              'data': {
                prioritas: prioritas,
              },
              'success': function(data){
                    $('#tableWitelTetap').empty();
                    $('#tableTotalTetap').empty();
                    $('#tableWitelBergerak').empty();
                    $('#tableTotalBergerak').empty();

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
                        $('#tableWitelTetap').append(`
                          <tr class="tr" colspan="15">
                              <td class="td">`+value.witel_area+`</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/ZONA/Green') }}">`+value.green+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/ZONA/Yellow') }}">`+value.yellow+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/ZONA/Red') }}">`+value.red+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/SPEC/SPEK') }}">`+value.unspek+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/TICKET/TICKETINFRA') }}">`+value.qjaringan+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/SPEC/OFFLINE') }}">`+value.offline+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/QC/BELUM VALID') }}">`+value.qc2+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/TICKET/TICKETCC') }}">`+value.ticketcc+`</a></td>
                              <td class="td">-</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/QUOTA/OVERQUOTA') }}">`+value.overquota+`</a></td>
                              <td class="td">-</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/USAGE/NOUSAGE') }}">`+value.nousage+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/`+value.witel_area+`/CM/CM') }}">`+value.cm+`</a></td>
                              <td class="td">-</td>
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
                        $('#tableWitelBergerak').append(`
                          <tr class="tr" colspan="15">
                              <td class="td">`+value.witel_area+`</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/ZONA/Green') }}">`+value.green+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/ZONA/Yellow') }}">`+value.yellow+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/ZONA/Red') }}">`+value.red+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/SPEC/SPEK') }}">`+value.unspek+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/TICKET/TICKETINFRA') }}">`+value.qjaringan+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/SPEC/OFFLINE') }}">`+value.offline+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/QC/BELUM VALID') }}">`+value.qc2+`</a></td
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/TICKET/TICKETCC') }}">`+value.ticketcc+`</a></td>
                              <td class="td">-</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/QUOTA/OVERQUOTA') }}">`+value.overquota+`</a></td>
                              <td class="td">-</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/USAGE/NOUSAGE') }}">`+value.nousage+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/`+value.witel_area+`/CM/CM') }}">`+value.cm+`</a></td>
                              <td class="td">-</td>
                          </tr>`)
                      });

                      $('#tableTotalTetap').append(`
                        <tr class="tr" colspan="15">
                            <td class="td">TREG VI</td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/ZONA/Green') }}">`+total_tetap_green+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/ZONA/Yellow') }}">`+total_tetap_yellow+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/ZONA/Red') }}">`+total_tetap_red+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/SPEC/SPEK') }}">`+total_tetap_unspek+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/TICKET/TICKETINFRA') }}">`+total_tetap_qjaringan+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/SPEC/OFFLINE') }}">`+total_tetap_offline+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/QC/BELUM VALID') }}">`+total_tetap_qc2+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/TICKET/TICKETCC') }}">`+total_tetap_ticketcc+`</a></td>
                            <td class="td">-</td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/QUOTA/OVERQUOTA') }}">`+total_tetap_overquota+`</a></td>
                            <td class="td">-</td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/USAGE/NOUSAGE') }}">`+total_tetap_nousage+`</a></td>
                            <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/TETAP/ALLWITEL/CM/CM') }}">`+total_tetap_cm+`</a></td>
                            <td class="td">-</td>
                        </tr>`)

                        $('#tableTotalBergerak').append(`
                          <tr class="tr" colspan="15">
                              <td class="td">TREG VI</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/ZONA/Green') }}">`+total_bergerak_green+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/ZONA/Yellow') }}">`+total_bergerak_yellow+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/ZONA/Red') }}">`+total_bergerak_red+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/SPEC/SPEK') }}">`+total_bergerak_unspek+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/TICKET/TICKETINFRA') }}">`+total_bergerak_qjaringan+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/SPEC/OFFLINE') }}">`+total_bergerak_offline+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/QC/BELUM VALID') }}">`+total_bergerak_qc2+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/TICKET/TICKETCC') }}">`+total_bergerak_ticketcc+`</a></td>
                              <td class="td">-</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/QUOTA/OVERQUOTA') }}">`+total_bergerak_overquota+`</a></td>
                              <td class="td">-</td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/USAGE/NOUSAGE') }}">`+total_bergerak_nousage+`</a></td>
                              <td class="td"><a style="color:black" target="_blank" href="{{ url('admin/machine-learning/new-ct0/detail/`+value.prioritas+`/BERGERAK/ALLWITEL/CM/CM') }}">`+total_bergerak_cm+`</a></td>
                              <td class="td">-</td>
                          </tr>`)
              }
            });
          }

      $('#btnFilter').click(function(){
            var prioritas = $('#prioritas').val();
            load_content(prioritas);
      });

});
</script>
@endsection
