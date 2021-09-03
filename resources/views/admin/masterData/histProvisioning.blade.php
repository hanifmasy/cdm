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
                              <input class="form-control" type="text" name="nomor" id="nomor" placeholder="SC / No Inet">
                          </div>
                      </div>
                      <div class="col-md-3 mt-1">
                          <button type="button" class="btn btn-info mr-2" id="applyBtn">Search</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row" id="data-provisioning">

  </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        load_content();

        function load_content(nomor='') {
            $.ajax({
                'type': "GET",
                'dataType': "JSON",
                'url': '{{ route('admin.customer.histProvisioning') }}',
                'data': {
                    nomor: nomor,
                },
                'success': function(data) {
                    $('#data-provisioning').empty();

                    if (data.dt_count != 0) {
                        $.each(data.dt_provisioning, function(index,value){
                            var customer_desc = value.customer_desc ? value.customer_desc : "-";
                            var order_id = value.order_id ? value.order_id : "-";
                            var internet = value.internet ? value.internet : "-";
                            var pots = value.pots ? value.pots : "-";
                            var witel_str = value.witel_str ? value.witel_str : "-";
                            var sto = value.sto ? value.sto : "-";
                            var item = value.item ? value.item : "-";
                            var segmen = value.segmen ? value.segmen : "-";
                            var plblcl_trems = value.plblcl_trems ? value.plblcl_trems : "-";
                            var ccat = value.ccat ? value.ccat : "-";
                            var lcat = value.lcat ? value.lcat : "-";
                            var latitude = value.latitude ? value.latitude : "-";
                            var longitude = value.longitude ? value.longitude : "-";
                            var odp = value.odp ? value.odp : "-";
                            var status_order = value.status_order ? value.status_order : "-";
                            var durasijam = value.durasijam ? value.durasijam : "-";
                            var create_dtm = value.create_dtm ? value.create_dtm : "-";
                            var update_dtm = value.update_dtm ? value.update_dtm : "-";
                            var alamat_manual = value.alamat_manual ? value.alamat_manual : "-";
                            var alamat_sistem = value.alamat_sistem ? value.alamat_sistem : "-";
                            var kcontact = value.kcontact ? value.kcontact : "-";
                            var kodepos = value.kodepos ? value.kodepos : "-";
                            var preview_packet = value.preview_packet ? value.preview_packet : "-";
                            var order_type_id = (value.order_type_id == 1) ? "(1) PSB"
                                : (value.order_type_id == 2) ? "(2) MODIFY"
                                : (value.order_type_id == 3) ? "(3) CAPS"
                                : (value.order_type_id == 4) ? "(4) BUKA ISOLIR"
                                : (value.order_type_id == 5) ? "(5) ISOLIR SEMENTARA"
                                : (value.order_type_id == 6) ? "(6) CHANGE NUMBER"
                                : (value.order_type_id == 7) ? "(7) MIGRASI JARINGAN"
                                : (value.order_type_id == 8) ? "(8) MODIFY"
                                : (value.order_type_id == 10) ? "(10) MIGRASI PAKET"
                                : (value.order_type_id == 103) ? "(103) ADD SERVICE"
                                : (value.order_type_id == 105) ? "(105) ADD SERVICE"
                                : (value.order_type_id == 123) ? "(123) BALIK NAMA"
                                : (value.order_type_id == 124) ? "(124) PDA"
                                : (value.order_type_id == 125) ? "(125) PDA"
                                : "";

                            $('#data-provisioning').append(`
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-header">
                                            <div style="float: left">
                                                <h5>SC : `+order_id+`</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-12">
                                                    <table class="table-borderless table-striped mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">NAMA PELANGGAN</th>
                                                                <td style="padding:10px; font-size: 13px">: `+customer_desc+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">SC ORDER</th>
                                                                <td style="padding:10px; font-size: 13px">: `+order_id+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">ND INTERNET</th>
                                                                <td style="padding:10px; font-size: 13px">: `+internet+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">POTS</th>
                                                                <td style="padding:10px; font-size: 13px">: `+pots+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">WITEL/STO</th>
                                                                <td style="padding:10px; font-size: 13px">: `+witel_str+` / `+sto+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">ITEM</th>
                                                                <td style="padding:10px; font-size: 13px">: `+item+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">PAKET</th>
                                                                <td style="padding:10px; font-size: 13px">: `+ preview_packet +`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">SEGMEN</th>
                                                                <td style="padding:10px; font-size: 13px">: `+segmen+` / `+plblcl_trems+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">CCAT/LCAT</th>
                                                                <td style="padding:10px; font-size: 13px">: `+ccat+` / `+lcat+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">ALAMAT SISTEM</th>
                                                                <td style="padding:10px; font-size: 13px">: `+ alamat_sistem +`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">ALAMAT MANUAL</th>
                                                                <td style="padding:10px; font-size: 13px">: `+ alamat_manual +`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">KCONTACT</th>
                                                                <td style="padding:10px; font-size: 13px">: `+ kcontact +`</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="col-md-5 col-sm-12">
                                                    <table class="table-striped mb-0">
                                                        <tbody id="table-assets-internet">
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">LAT/LONG</th>
                                                                <td style="padding:10px; font-size: 13px">: Lat : `+latitude+` | Long : `+longitude+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">KODE POS</th>
                                                                <td style="padding:10px; font-size: 13px">: `+kodepos+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">ODP</th>
                                                                <td style="padding:10px; font-size: 13px">: `+odp+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">STATUS ORDER</th>
                                                                <td style="padding:10px; font-size: 13px">: `+status_order+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">DURASI JAM</th>
                                                                <td style="padding:10px; font-size: 13px">: `+durasijam+` jam</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">ORDER TYPE ID</th>
                                                                <td style="padding:10px; font-size: 13px">: `+order_type_id+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">CREATE DATE</th>
                                                                <td style="padding:10px; font-size: 13px">: `+create_dtm+`</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 150px; padding:10px; font-size: 13px">UPDATE DATE</th>
                                                                <td style="padding:10px; font-size: 13px">: `+update_dtm+`</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `)
                        });
                    } else {
                        $('#data-provisioning').append(`
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div style="float: left">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="d-flex justify-content-center">
                                                    <b>No Data Found</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                }
            })
        }

        $('#applyBtn').click(function(e) {
            var nomor = $('#nomor').val();
            e.preventDefault();

            load_content(nomor);
            $('#data-provisioning').empty();
        });
    });
</script>
@endsection
