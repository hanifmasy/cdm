@extends('layouts.admin')
@section('styles')
<style>
    .table-bordered, tr, th, td{
        border:1px solid black !important;
    }
</style>
@endsection
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>PSB All Segmen</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Periode</label>
                                                <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="periode" id="periode">
                                                    <option value="ALLPERIODE">All Periode</option>
                                                    @foreach ($periodes as $id => $periode)
                                                    <option value="{{ $periode->tgl_ps }}" {{ old('periode') == $periode->tgl_ps ? 'selected' : '' }}>{{$periode->tgl_ps}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Witel</label>
                                                <select class="form-control {{ $errors->has('witel') ? 'is-invalid' : '' }}" name="witel" id="witel">
                                                    <option value="ALLWITEL">All Witel</option>
                                                    @foreach($witels as $id => $witel)
                                                    <option value="{{ $witel->c_witel }}" {{ old('witel') == $witel->c_witel ? 'selected' : '' }}>{{$witel->witel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="">Ubis</label>
                                              <select class="form-control {{ $errors->has('ubis') ? 'is-invalid' : '' }}" name="ubis" id="ubis">
                                                  <option value="ALLUBIS">All Ubis</option>
                                                  @foreach($ubises as $id => $ubis)
                                                  <option value="{{ $ubis->ubis }}" {{ old('ubis') == $ubis->ubis ? 'selected' : '' }}>{{$ubis->ubis}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <button type="button" class="btn btn-info mr-2" id="applyBtn" style="margin-top: 10px">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">WITEL</th>
                                                    <th class="align-middle">PL</th>
                                                    <th class="align-middle">BL</th>
                                                    <th class="align-middle">CL</th>
                                                    <th class="align-middle">GL</th>
                                                    <th class="align-middle">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="psb-allsegmen">

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
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
    load_content("ALLPERIODE","ALLWITEL","ALLUBIS");

    function load_content(periode_val='',witel_val='',ubis_val='')
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.performance.psb_segmen') }}',
            'data': {
                periode: periode_val,
                witel: witel_val,
                ubis: ubis_val,
            },
            'success': function(data) {
                $('#psb-allsegmen').empty();

                var grand_pl = 0;
                var grand_bl = 0;
                var grand_cl = 0;
                var grand_gl = 0;
                var grand_total = 0;
                var check_witel = 0;

                    $.each(data.psb_allsegmen, function(index,value){
                        grand_pl += value.pl;
                        grand_bl += value.bl;
                        grand_cl += value.cl;
                        grand_gl += value.gl;
                        grand_total += value.total;
                        check_witel++;

                        $('#psb-allsegmen').append(`
                        <tr>
                            <td><b>`+value.witel+`</b></td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.c_witel+`&column=pl">`+value.pl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.c_witel+`&column=bl">`+value.bl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.c_witel+`&column=cl">`+value.cl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.c_witel+`&column=gl">`+value.gl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.c_witel+`&column=total">`+value.total+`</a>
                            </td>

                        </tr>`)
                    });

                    if(check_witel > 1){
                      $('#psb-allsegmen').append(`
                        <tr>
                            <td><b>GRAND TOTAL</b></td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=ALLWITEL&column=pl">`+grand_pl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=ALLWITEL&column=bl">`+grand_bl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=ALLWITEL&column=cl">`+grand_cl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=ALLWITEL&column=gl">`+grand_gl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=ALLWITEL&column=total">`+grand_total+`</a>
                            </td>

                        </tr>
                        `)
                    }
            }
        });
    }

    $('#applyBtn').click(function() {
        var periode = $('#periode').val();
        var witel = $('#witel').val();
        var ubis = $('#ubis').val();
        //e.preventDefault();

        $('#psb-allsegmen').empty();
        load_content(periode,witel,ubis);
    });

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
    $('#witel').change(function(){
        var witel = $(this).find(':selected').val();
              $.ajax({
              type: 'POST',
              url: '{{ route('admin.performance.psb_segmen_witels') }}',
              data: {
                  witel: witel,
              },
              success: function (data) {
                  $('#ubis').empty();
                  $('#ubis').append(`<option value="ALLUBIS">All Ubis</option>`);
                  $.each(data.ubis_list, function(index,value){
                      $('#ubis').append(`
                          <option value="`+value.ubis+`">`+value.ubis+`</option>
                      `)
                  });
              }
          });
    });
});

function getPeriode(){
  return $('#periode').val();
}
// function getNumber(number) {
//     return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
// }
</script>
@endsection
