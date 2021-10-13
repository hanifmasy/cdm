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
                                        <div class="col-md-4">
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
    load_content("ALLPERIODE");

    function load_content(periode_val='')
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.performance.psb_segmen') }}',
            'data': {
                periode: periode_val,
            },
            'success': function(data) {
                $('#psb-allsegmen').empty();

                    $.each(data.psb_allsegmen, function(index,value){

                        $('#psb-allsegmen').append(`
                        <tr>
                            <td><b>`+value.witel+`</b></td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.witel+`&column=pl">`+value.pl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.witel+`&column=bl">`+value.bl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.witel+`&column=cl">`+value.cl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.witel+`&column=gl">`+value.gl+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{ route('admin.performance.psb_segmen_detail') }}?periode=`+getPeriode()+`&witel=`+value.witel+`&column=total">`+value.total+`</a>
                            </td>

                        </tr>`)
                    });
            }
        });
    }

    $('#applyBtn').click(function() {
        var periode = $('#periode').val();
        //e.preventDefault();

        $('#psb-allsegmen').empty();
        load_content(periode);
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
