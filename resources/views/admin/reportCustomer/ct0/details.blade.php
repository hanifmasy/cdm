@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left">
                <h4>New CT0 Prediction</h4>
            </div>
        </div>
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
                <div class="col-md-6" id="formDownload">
                  <!-- <form action="{{ route('admin.reporting.sfgopro.downloadAccept') }}" method="POST">
                    @csrf
                      <div class="col col-sm-6">
                          <div class="form-group col col-md" style="margin-bottom:0px;">
                              <button type="submit" class="btn btn-success" id="btnDownload" name="btnDownload">Download Excel</button>
                          </div>
                      </div>
                  </form> -->
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing-ct0" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No Inet</th>
                                    <th>Witel</th>
                                    <th>Prediction</th>
                                    <th>Probability</th>
                                    <th>NPER Awal</th>
                                    <th>Prioritas</th>
                                    <th>Update NPER</th>
                                    <th>Alpro RX Power ONU</th>
                                    <th>Alpro ONU Status</th>
                                    <th>Status Gangguan</th>
                                    <th>Usia PS</th>
                                    <th>LCAT Name</th>
                                    <th>Segmen HVC</th>
                                    <th>Status QC</th>
                                    <th>Paket Inet</th>
                                    <th>PSB Channel Sales</th>
                                    <th>Usage Inet Current Month</th>
                                    <th>Usage Bulan Lalu</th>
                                    <th>Kuota Speed NCX</th>
                                    <th>Status FUP</th>
                                    <th>Ticket ID</th>
                                    <th>Report Timestamp</th>
                                    <th>Status Timestamp</th>
                                    <th>Status</th>
                                    <th>Max Endtime</th>
                                    <th>Duration No Usage</th>
                                    <th>Cat SPEC</th>
                                    <th>Cat Ticket</th>
                                    <th>Cat QC</th>
                                    <th>Cat Quota</th>
                                    <th>Cat Usage</th>
                                    <th>Cat CM</th>
                                    <th>Moving Bill</th>
                                    <th>Moving Zona</th>
                                </tr>
                            </thead>
                        </table>
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
        let url = window.location.href;
        let dtOverrideGlobals = {
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: url,
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'notel', name: 'notel' },
                { data: 'witel_area', name: 'witel_area' },
                { data: 'prediction', name: 'prediction' },
                { data: 'probability', name: 'probability' },
                { data: 'nper_awal', name: 'nper_awal' },
                { data: 'prioritas', name: 'prioritas' },
                { data: 'update_nper', name: 'update_nper' },
                { data: 'alpro_rxpoweronu', name: 'alpro_rxpoweronu' },
                { data: 'alpro_onustatus', name: 'alpro_onustatus' },
                { data: 'status_gangguan', name: 'status_gangguan' },
                { data: 'usia_ps', name: 'usia_ps' },
                { data: 'lcat_name', name: 'lcat_name' },
                { data: 'segmen_hvc', name: 'segmen_hvc' },
                { data: 'status_qc', name: 'status_qc' },
                { data: 'paket_inet', name: 'paket_inet' },
                { data: 'psb_channel_sales', name: 'psb_channel_sales' },
                { data: 'usage_inet_current_month', name: 'usage_inet_current_month' },
                { data: 'usage_bln_lalu', name: 'usage_bln_lalu' },
                { data: 'kuota_speed_ncx', name: 'kuota_speed_ncx' },
                { data: 'status_fup', name: 'status_fup' },
                { data: 'ticket_id', name: 'ticket_id' },
                { data: 'reporttimestamp', name: 'reporttimestamp' },
                { data: 'statustimestamp', name: 'statustimestamp' },
                { data: 'status', name: 'status' },
                { data: 'max_endtime', name: 'max_endtime' },
                { data: 'duration_no_usage', name: 'duration_no_usage' },
                { data: 'cat_spec', name: 'cat_spec' },
                { data: 'cat_ticket', name: 'cat_ticket' },
                { data: 'cat_qc', name: 'cat_qc' },
                { data: 'cat_quota', name: 'cat_quota' },
                { data: 'cat_usage', name: 'cat_usage' },
                { data: 'cat_cm', name: 'cat_cm' },
                { data: 'moving_bill', name: 'moving_bill' },
                { data: 'cat_zona', name: 'cat_zona' },
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 50,
        };
        $('#kt_datatable_search').keyup(function(){
            table.search($(this).val()).draw();
        });
        let table = $('#order-listing-ct0').DataTable(dtOverrideGlobals);

        $('#formDownload').append(`
          <form action="{{ route('admin.machine-learning.downloadNewCt0') }}`+window.location.search+`" method="POST">
            @csrf
              <div class="col col-sm-6">
                  <div class="form-group col col-md" style="margin-bottom:0px;">
                      <button type="submit" class="btn btn-success" id="btnDownload" name="btnDownload">Download Excel</button>
                  </div>
              </div>
          </form>
          `)
        // $('#btnDownload').click(function(){
        //       $.ajaxSetup({
        //             headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
        //       });
        //       $.ajax({
        //             'type': "POST",
        //             'url': "{{route('admin.machine-learning.downloadNewCt0')}}",
        //             'data': {
        //               prioritas: prioritas,
        //               bill: bill,
        //               witel_area: witel_area,
        //               cat_value: cat_value,
        //             },
        //             'success': function(data){
        //               //console.log(data);
        //             }
        //       });
        // });
        //
        // function getQueryVariable(variable){
        //     var query = window.location.search.substring(1);
        //     var vars = query.split("&");
        //       for (var i=0;i<vars.length;i++) {
        //         var pair = vars[i].split("=");
        //         if(pair[0] == variable){return pair[1];}
        //       }
        //     return(false);
        //   }
        // var prioritas = getQueryVariable("prioritas");
        // var bill = getQueryVariable("bill");
        // var witel_area = getQueryVariable("witel_area");
        // var cat_value = '';
        // if(getQueryVariable("cat_zona")){ cat_value = getQueryVariable("cat_zona"); }
        // if(getQueryVariable("cat_spec")){ cat_value = getQueryVariable("cat_spec"); }
        // if(getQueryVariable("cat_ticket")){ cat_value = getQueryVariable("cat_ticket"); }
        // if(getQueryVariable("cat_qc")){ cat_value = getQueryVariable("cat_qc"); }
        // if(getQueryVariable("cat_quota")){ cat_value = getQueryVariable("cat_quota"); }
        // if(getQueryVariable("cat_usage")){ cat_value = getQueryVariable("cat_usage"); }
        // if(getQueryVariable("cat_cm")){ cat_value = getQueryVariable("cat_cm"); }
        // if(getQueryVariable("sisa_caring")){ cat_value = getQueryVariable("sisa_caring"); }
        //console.log(prioritas,bill,witel_area,cat_value);
    })
</script>
@endsection
