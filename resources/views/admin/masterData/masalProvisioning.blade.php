@extends('layouts.admin')
@section('content')
<div class="content">
@include('partials.navtab')
  <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-9">
                          <div class="form-group">
                              <label for=""><b>Masukkan SC / No Inet dipisahkan dengan Enter</b></label>
                              <textarea type="text" class="form-control" name="nomor" id="nomor" rows="8" cols="50"></textarea>
                          </div>
                      </div>
                      <div class="col-md-3 mt-1" style="padding:19% 0 0 0;">
                          <button type="button" class="btn btn-info mr-2" id="applyBtn">Search</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-12">
                      <div class="table-responsive">
                          <table id="order-listing" class="table table-bordered table-hover datatable" style="width: 100%;">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>Order ID</th>
                                      <th>No Inet</th>
                                      <th>Pots</th>
                                      <th>Witel</th>
                                      <th>STO</th>
                                      <th>Item</th>
                                      <th>Paket</th>
                                      <th>Segmen</th>
                                      <th>Plblcl Trems</th>
                                      <th>CCAT</th>
                                      <th>LCAT</th>
                                      <th>Alamat Sistem</th>
                                      <th>Alamat Manual</th>
                                      <th>KContact</th>
                                      <th>Latitude</th>
                                      <th>Longitude</th>
                                      <th>Kodepos</th>
                                      <th>ODP</th>
                                      <th>Status Order</th>
                                      <th>Durasi Jam</th>
                                      <th>Order Type ID</th>
                                      <th>Created Date</th>
                                      <th>Updated Date</th>
                                    </tr>
                              </thead>
                              <tbody>
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
@endsection
@section('scripts')
<script>
  $(document).ready(function() {

    function load_content(arrNomor){
      $.ajax({
        'type': "GET",
        'dataType': "JSON",
        'url': '{{ route('admin.customer.masalProvisioning') }}',
        'data': {
            arrNomor: arrNomor,
        },
        'success': function(data){
          let url = window.location.href;
          let dtOverrideGlobals = {
              processing: true,
              serverSide: true,
              retrieve: true,
              aaSorting: [],
              ajax: url,
              columns: [
                  { data: 'DT_RowIndex', orderable: false, searchable: false},
                  { data: 'order_id', name: 'order_id'},
                  { data: 'internet', name: 'internet'},
                  { data: 'pots', name: 'pots'},
                  { data: 'witel', name: 'witel'},
                  { data: 'sto', name: 'sto'},
                  { data: 'item', name: 'item'},
                  { data: 'preview_packet', name: 'preview_packet'},
                  { data: 'segmen', name: 'segmen'},
                  { data: 'plblcl_trems', name: 'plblcl_trems'},
                  { data: 'ccat', name: 'ccat'},
                  { data: 'lcat_name', name: 'lcat_name'},
                  { data: 'alamat_sistem', name: 'alamat_sistem'},
                  { data: 'alamat_manual', name: 'alamat_manual'},
                  {
                      data: 'kcontact',
                      name: 'kcontact',
                      render: function ( data, type, row, meta ) {
                          return '<div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="'+data+'">'+data+'</div>';
                      }
                  },
                  { data: 'latitude', name: 'latitude'},
                  { data: 'longitude', name: 'longitude'},
                  { data: 'kodepos', name: 'kodepos'},
                  { data: 'odp', name: 'odp'},
                  { data: 'status_order', name: 'status_order'},
                  { data: 'durasijam', name: 'durasijam'},
                  { data: 'order_type_id', name: 'order_type_id'},
                  { data: 'create_dtm', name: 'create_dtm',orderable: true},
                  { data: 'update_dtm', name: 'update_dtm',orderable: true},
              ],
              orderCellsTop: true,
              order: [[ 0, 'desc' ]],
              pageLength: 50,
          };
          let table = $('#order-listing').DataTable(dtOverrideGlobals);
        }
      })
    }

    $('#applyBtn').click(function(e) {
        var nomor = $('#nomor').val();
        var arrNomor = nomor.split("\n");

        load_content(arrNomor);
    });

});
</script>
@endsection
