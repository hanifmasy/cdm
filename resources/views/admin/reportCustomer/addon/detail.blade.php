@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>PS Addon Daily Detail</h4>
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
                                          <td>Ndinet</td>
                                          <td>Ndem</td>
                                          <td>Coper</td>
                                          <th>Kcontact</th>
                                          <th>Jenis Addon</th>
                                          <th>Item</th>
                                          <th>Cpack</th>
                                          <th>PSB</th>
                                          <th>CBT</th>
                                          <th>MIG</th>
                                          <th>Price PSB</th>
                                          <th>Price CBT</th>
                                          <th>Price MIG</th>
                                          <th>Tgl PS</th>
                                          <td>Report Month</td>
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
            { data: 'ndinet', name: 'ndinet'},
            { data: 'ndem', name: 'ndem'},
            { data: 'coper', name: 'coper',class: 'text-center'},
            {
                data: 'kcontact',
                name: 'kcontact',
                render: function ( data, type, row, meta ) {
                    return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                }
            },
            { data: 'jenis_addon', name: 'jenis_addon'},
            { data: 'item', name: 'item'},
            { data: 'cpack', name: 'cpack' },
            { data: 'psb', name: 'psb' },
            { data: 'cbt', name: 'cbt' },
            { data: 'mig', name: 'mig' },
            { data: 'price_psb', name: 'price_psb' },
            { data: 'price_cbt', name: 'price_cbt' },
            { data: 'price_mig', name: 'price_mig' },
            { data: 'tgl_ps', name: 'tgl_ps', orderable: true},
            { data: 'report_month', name: 'report_month',orderable: true},
        ],
        orderCellsTop: true,
        order: [[ 0, 'desc' ]],
        pageLength: 50,
    };
    $('#kt_datatable_search').keyup(function(){
        table.search($(this).val()).draw();
    });
    let table = $('#order-listing').DataTable(dtOverrideGlobals);
});
</script>
@endsection
