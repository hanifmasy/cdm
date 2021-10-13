@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>PSB All Segmen Detail</h4>
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
                          <div class="col-md-6" id="formDownload">
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
                                          <td>NCLI</td>
                                          <td>NDOS</td>
                                          <td>NDEM</td>
                                          <th>ETAT</th>
                                          <th>CAGENT</th>
                                          <th>DESC_PACK</th>
                                          <th>COPER</th>
                                          <th>C_WITEL</th>
                                          <th>STO</th>
                                          <th>ND_CONTACT</th>
                                          <th>STATUS</th>
                                          <th>CSEG</th>
                                          <th>CHANEL</th>
                                          <th>USER_ID</th>
                                          <th>KODE_SALES</th>
                                          <th>HAPE_KCONTACT</th>
                                          <th>C_SEBAB</th>
                                          <th>SEBAB</th>
                                          <th>KET_SEBAB</th>
                                          <th>C_SOLUSI</th>
                                          <th>SOLUSI</th>
                                          <th>KET_SOLUSI</th>
                                          <th>ID_ALPRO</th>
                                          <th>IS_CT0</th>
                                          <th>CPACK</th>
                                          <th>USAGE_SPEEDY</th>
                                          <th>USAGE_USEETV</th>
                                          <th>TGL_PS</th>
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
            { data: 'ncli', name: 'ncli'},
            { data: 'ndos', name: 'ndos'},
            { data: 'ndem', name: 'ndem'},
            { data: 'etat', name: 'etat'},
            { data: 'cagent', name: 'cagent'},
            { data: 'desc_pack', name: 'desc_pack'},
            { data: 'coper', name: 'coper'},
            { data: 'c_witel', name: 'c_witel'},
            { data: 'sto', name: 'sto'},
            { data: 'nd_contact', name: 'nd_contact'},
            { data: 'status', name: 'status'},
            { data: 'cseg', name: 'cseg'},
            { data: 'chanel', name: 'chanel'},
            { data: 'user_id', name: 'user_id'},
            { data: 'kode_sales', name: 'kode_sales'},
            { data: 'hape_kcontact', name: 'hape_kcontact'},
            { data: 'c_sebab', name: 'c_sebab'},
            { data: 'sebab', name: 'sebab'},
            { data: 'ket_sebab', name: 'ket_sebab'},
            { data: 'c_solusi', name: 'c_solusi'},
            { data: 'solusi', name: 'solusi'},
            { data: 'ket_solusi', name: 'ket_solusi'},
            { data: 'id_alpro', name: 'id_alpro'},
            { data: 'is_ct0', name: 'is_ct0'},
            { data: 'cpack', name: 'cpack'},
            { data: 'usage_speedy', name: 'usage_speedy'},
            { data: 'usage_useetv', name: 'usage_useetv'},
            { data: 'tgl_ps', name: 'tgl_ps'},
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

$('#formDownload').append(`
  <form action="{{ route('admin.performance.downloadPsb') }}`+window.location.search+`" method="POST">
    @csrf
      <div class="col col-sm-6">
          <div class="form-group col col-md" style="margin-bottom:0px;">
              <button type="submit" class="btn btn-success" id="btnDownload" name="btnDownload">Download Excel</button>
          </div>
      </div>
  </form>
  `)
</script>
@endsection
