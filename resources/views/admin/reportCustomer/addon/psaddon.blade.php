@extends('layouts.admin')
@section('content')
<style>
tr, th, td {
  border: 1px solid black;
}
</style>
<div class="content">
  @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>PS Addon Daily</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- ALL ADDON -->
                    <div class="row">
                      <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                              <div class="card-body">
                                  <h3 class="card-title">ALL ADDON</h3>
                                  <div class="table-responsive">
                                      <table class="table table-striped text-center">
                                          <thead>
                                              <tr>
                                                  <th rowspan="2" class="align-middle">Witel</th>
                                                  <th colspan="2" class="text-center">Bulan Lalu<p class="last_m">[{{$last_m}}]</p></th>
                                                  <th rowspan="2" class="align-middle">Grow FM</th>
                                                  <th colspan="3" class="text-center">MTD<p class="current">[{{$current}}]</p></th>
                                                  <th rowspan="2" class="align-middle">Grow MTD</th>
                                                  <th colspan="2" class="text-center">Tahun Lalu<p class="last_y">[{{$last_y}}]</p></th>
                                                  <th rowspan="2" class="align-middle">Grow YFM</th>
                                                  <th colspan="5" class="text-center">YTD<p class="current">[{{$current}}]</p></th>
                                                  <th rowspan="2" class="align-middle">Grow YTD</th>
                                              </tr>
                                              <tr>
                                                  <th>MTD</th>
                                                  <th>Full</th>
                                                  <th>Target FM</th>
                                                  <th>REAL</th>
                                                  <th>ACH</th>
                                                  <th>YTD</th>
                                                  <th>Full</th>
                                                  <th>Target FY</th>
                                                  <th>ACH FY</th>
                                                  <th>Target YTD</th>
                                                  <th>REAL</th>
                                                  <th>ACH YTD</th>
                                              </tr>
                                          </thead>
                                          <tbody id="alladdon">
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <!-- Minipack -->
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(document).ready(function(){
    load_content();

    function load_content(){
      $.ajax({
        'type': "GET",
        'dataType': "JSON",
        'url': '{{ route('admin.performance.psaddon') }}',
        'success': function(data){
            $.each(data.alladdon, function(index,value){
                var gr_fm = value.gr_fm;
                var ach_mtd = value.ach_mtd;
                var gr_mtd = value.gr_mtd;
                var gr_yfm = value.gr_yfm;
                var ach_fy = value.ach_fy;
                var ach_ytd = value.ach_ytd;
                var gr_ytd = value.gr_ytd;
                if(gr_fm > 0){ var lb_gr_fm = '<text style="color: #29c0b1">'+ gr_fm +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'} else { var lb_gr_fm = '<text style="color: #ff3366">'+ gr_fm +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'}
                if(gr_mtd > 0){ var lb_gr_mtd = '<text style="color: #29c0b1">'+ gr_mtd +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'} else { var lb_gr_mtd = '<text style="color: #ff3366">'+ gr_mtd +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'}
                if(gr_yfm > 0){ var lb_gr_yfm = '<text style="color: #29c0b1">'+ gr_yfm +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'} else { var lb_gr_yfm = '<text style="color: #ff3366">'+ gr_yfm +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'}
                if(gr_ytd > 0){ var lb_gr_ytd = '<text style="color: #29c0b1">'+ gr_ytd +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'} else { var lb_gr_ytd = '<text style="color: #ff3366">'+ gr_ytd +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'}
                if(ach_mtd > 100){ var lb_ach_mtd = '<label class="badge badge-success">'+ ach_mtd +'%</label>' } else { var lb_ach_mtd = '<label class="badge badge-danger">'+ ach_mtd +'%</label>'}
                if(ach_fy > 100){ var lb_ach_fy = '<label class="badge badge-success">'+ ach_fy +'%</label>' } else { var lb_ach_fy = '<label class="badge badge-danger">'+ ach_fy +'%</label>'}
                if(ach_ytd > 100){ var lb_ach_ytd = '<label class="badge badge-success">'+ ach_ytd +'%</label>' } else { var lb_ach_ytd = '<label class="badge badge-danger">'+ ach_ytd +'%</label>'}
                $('#alladdon').append(`
                <tr>
                    <td>`+value.witel_str+`</td>
                    <td>`+value.mtd_bln_lalu+`</td>
                    <td>`+value.full_bln_lalu+`</td>
                    <td>`+lb_gr_fm+`</td>
                    <td>`+value.target_fm+`</td>
                    <td>`+value.mtd_bln_ini+`</td>
                    <td>`+lb_ach_mtd+`</td>
                    <td>`+lb_gr_mtd+`</td>
                    <td>`+value.ytd_thn_lalu+`</td>
                    <td>`+value.full_thn_lalu+`</td>
                    <td>`+lb_gr_yfm+`</td>
                    <td>`+value.target_fy+`</td>
                    <td>`+lb_ach_fy+`</td>
                    <td>`+value.target_ytd+`</td>
                    <td>`+value.ytd_thn_ini+`</td>
                    <td>`+lb_ach_ytd+`</td>
                    <td>`+lb_gr_ytd+`</td>
                </tr>`)
            });
        }
      })
    }

})
@endsection
