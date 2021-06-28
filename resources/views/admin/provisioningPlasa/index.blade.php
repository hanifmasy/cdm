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
                        <h4>Provisioning Plasa</h4>
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
                                                    @foreach ($periodes as $id => $periode)
                                                    <option value="{{ $periode->bulan }}" {{ old('periode') == $periode->bulan ? 'selected' : '' }}>{{$periode->bulan}}</option>
                                                    @endforeach
                                                </select>    
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-5 mt-1">
                                            <label for="" style="font-size:14px">Order Type</label>
                                            <select class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order" id="order">   
                                                <option value="ALL_ORDER">{{ trans('global.allOrder') }}</option>                                                                                     
                                                <option value="1">(1) PSB</option>
                                                <option value="2">(2) MO</option>
                                                <option value="3">(3) CABUT</option>
                                                <option value="4">(4) BUKA ISOLIR</option>
                                                <option value="5">(5) ISOLIR SEMENTARA</option>
                                                <option value="6">(6) CHANGE NUMBER</option>                                  
                                                <option value="7">(7) MIGRASI JARINGAN</option>
                                                <option value="8">(8) MO</option>                                            
                                                <option value="10">(10) MIGRASI PAKET</option>
                                                <option value="103">(103) ADD SERVICE</option>
                                                <option value="105">(105) ADD SERVICE</option>
                                                <option value="123">(123) BALIK NAMA</option>
                                                <option value="124">(124) PDA</option>
                                                <option value="125">(125) PDA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <button type="button" class="btn btn-info mr-2" id="applyBtn" style="margin-top: 10px">Filter</button>
                                        </div>
                                    </div>                                                            
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body"> 
                                    <form method="POST" action="{{url('admin/performance/provisioning/plasa/search')}}">  
                                        @csrf                             
                                        <div class="row">                                   
                                            <div class="col-md-8 mt-1">
                                                <label for="" style="font-size:14px">Search Order</label>
                                                <div class="form-group">                    
                                                    <input class="form-control" type="text" name="nomor" id="nomor" placeholder="Order ID / No Inet">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-4">
                                                <button type="submit" class="btn btn-secondary mr-1" style="margin-top: 10px">
                                                    <i style="color: white" class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div> 
                                    </form>                                                           
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
                                                    <th class="align-middle">No.</th>             
                                                    <th class="align-middle">WITEL</th>
                                                    <th class="align-middle">COMPLETED</th>                                                                                           
                                                    <th class="align-middle">IN PROGRESS</th>
                                                    <th class="align-middle">CANCEL</th>                                                
                                                    <th class="align-middle">TOTAL</th>  
                                                </tr>                                           
                                            </thead>
                                            <tbody id="provisioning-plasa">
                                                                                                        
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
    load_content();

    function load_content(periode_val='', order_val='') 
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.performance.provisioning_plasa') }}',
            'data': {
                periode: periode_val,
                order: order_val
            },
            'success': function(data) {                          
                $('#provisioning-plasa').empty();

                if (data.dt_count > 0) {
                    var date = new Date();
                    var date_now = $('#periode').val() ? $('#periode').val() : date.yyyymm();   
                    var order = $('#order').val() ? $('#order').val() : 'ALL_ORDER';   
            
                    $.each(data.provisioning_plasa, function(index,value){  
                        
                        var no = index+1;

                        $('#provisioning-plasa').append(`
                        <tr>
                            <td>`+ no +`</td>
                            <td><b>`+value.witel_str+`</b></td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/plasa/' . '`+order+`' . '/' . '`+date_now+`' . '/' . '`+value.witel_str+`' . '/' . 'COMPLETED')}}">`+getNumber(value.completed)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/plasa/' . '`+order+`' . '/' . '`+date_now+`' . '/' . '`+value.witel_str+`' . '/' . 'IN_PROGRESS')}}">`+getNumber(value.inprogress)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/plasa/' . '`+order+`' . '/' . '`+date_now+`' . '/' . '`+value.witel_str+`' . '/' . 'CANCEL')}}">`+getNumber(value.cancel)+`</a>
                            </td>
                            <td>
                                <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/plasa/' . '`+order+`' . '/' . '`+date_now+`' . '/' . '`+value.witel_str+`' . '/' . 'ALL_STATUS')}}">`+getNumber(value.total)+`</a>
                            </td>
                        
                        </tr>`)
                    });

                } else {
                    $('#provisioning-plasa').append(`
                    <tr>
                            <th class="align-middle" colspan="6" style="font-style: italic;">No Data Found</th>
                    </tr>`)
                }

            }
        });
    }

    $('#applyBtn').click(function(e) {
        var periode = $('#periode').val();
        var order = $('#order').val();
        e.preventDefault();
        
        $('#provisioning-plasa').empty();
        load_content(periode,order);
        
    });
});
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection