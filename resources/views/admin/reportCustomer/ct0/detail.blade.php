@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>New CT0 Detail</h4>
                    </div>
                </div>
                <div class="card-body">
                  <div class="card-body">
                      <div class="row align-items-center">
                          <div class="col-md-4">
                              <div class="row align-items-center">
                                  <div class="col-md-12">
                                      <div class="input-icon">
                                          <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <br>
                   <div class="row">
                      <div class="col-12">
                          <div class="table-responsive">
                              <table id="order-listing" class="table table-bordered table-hover datatable" style="width: 100%;">
                                  <thead>
                                      <tr>
                                          <th>No.</th>
                                          <th>Notel</th>
                                          <th>Probability</th>
                                          <th>Nper Awal</th>
                                          <th>Prioritas</th>
                                          <th>Update Nper</th>
                                          <th>Alpro RXPoweronu</th>
                                          <th>Alpro Onu Status</th>
                                          <th>Status Gangguan</th>
                                          <th>Usia ps</th>
                                          <th>Lcat Name</th>
                                          <th>Segmen HVC</th>
                                          <th>Status QC</th>
                                          <th>Paket Inet</th>
                                          <th>PSB Channel Sales</th>
                                          <th>Usage Bulan Lalu</th>
                                          <th>Usage Bulan Ini</th>
                                          <th>Kuota Speed Ncx</th>
                                          <th>Status Fup</th>
                                          <th>Ticket ID</th>
                                          <th>Report Time</th>
                                          <th>Status Time</th>
                                          <th>Status</th>
                                          <th>Max End Time</th>
                                          <th>Duration No Usage</th>
                                          <th>Witel</th>
                                          <th>Category Spec</th>
                                          <th>Category Ticket</th>
                                          <th>Category QC</th>
                                          <th>Category Quota</th>
                                          <th>Category Usage</th>
                                          <th>Category CM</th>
                                          <th>Category Zona</th>
                                          <th>Moving Bill</th>
                                        </tr>
                                  </thead>
                              </table>
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
@parent
<script>
$(function () {
    let url = window.location.href;
    let dtOverrideGlobals = {
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: url,
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'notel', name: 'notel'},
            { data: 'probability', name: 'probability'},
            { data: 'nper_awal', name: 'nper_awal'},
            { data: 'prioritas', name: 'prioritas'},
            { data: 'update_nper', name: 'update_nper'},
            { data: 'alpro_rxpoweronu', name: 'alpro_rxpoweronu'},
            { data: 'alpro_onustatus', name: 'alpro_onustatus'},
            { data: 'status_gangguan', name: 'status_gangguan'},
            { data: 'usia_ps', name: 'usia_ps'},
            { data: 'lcat_name', name: 'lcat_name'},
            { data: 'segmen_hvc', name: 'segmen_hvc'},
            { data: 'status_qc', name: 'status_qc'},
            { data: 'paket_inet', name: 'paket_inet'},
            { data: 'psb_channel_sales', name: 'psb_channel_sales'},
            { data: 'usage_bln_lalu', name: 'usage_bln_lalu'},
            { data: 'usage_inet_current_month', name: 'usage_inet_current_month'},
            { data: 'kuota_speed_ncx', name: 'kuota_speed_ncx'},
            { data: 'status_fup', name: 'status_fup'},
            { data: 'ticketid', name: 'ticketid'},
            { data: 'reporttimestamp', name: 'reporttimestamp', orderable: true},
            { data: 'statustimestamp', name: 'statustimestamp', orderable: true},
            { data: 'status', name: 'status'},
            { data: 'max_endtime', name: 'max_endtime'},
            { data: 'duration_no_usage', name: 'duration_no_usage'},
            { data: 'witel_area', name: 'witel_area'},
            { data: 'cat_spec', name: 'cat_spec'},
            { data: 'cat_ticket', name: 'cat_ticket'},
            { data: 'cat_qc', name: 'cat_qc'},
            { data: 'cat_quota', name: 'cat_quota'},
            { data: 'cat_usage', name: 'cat_usage'},
            { data: 'cat_cm', name: 'cat_cm'},
            { data: 'cat_zona', name: 'cat_zona'},
            { data: 'moving_bill', name: 'moving_bill'},
        ],
        orderCellsTop: true,
        order: [[ 1, 'asc' ]],
        pageLength: 50,
    };
    $('#kt_datatable_search').keyup(function(){
        table.search($(this).val()).draw();
    });
    let table = $('#order-listing').DataTable(dtOverrideGlobals);
});
</script>
@endsection
