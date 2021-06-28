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
                        <h4>Provisioning</h4>
                    </div>                
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">                                
                                    <div class="row">                                    
                                        <div class="col-md-5 mt-1">
                                            <label for="" style="font-size:14px">Addon</label>
                                            <select class="form-control {{ $errors->has('addon') ? 'is-invalid' : '' }}" name="addon" id="addon">   
                                                <option value="ALL_ADDON">{{ trans('global.allAddon') }}</option>                                                                                     
                                                <option value="minipack">MINIPACK</option>
                                                <option value="upgrade">UPGRADE</option>
                                                <option value="mig2p3p">MIG2P3P</option>
                                                <option value="stb_tambahan">STB TAMBAHAN</option>
                                                <option value="plc">PLC</option>
                                                <option value="mig1p2p">MIG1P2P</option>                                  
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">                    
                                                <label for="" style="font-size:14px">Segmen</label>
                                                <select class="form-control {{ $errors->has('segmen') ? 'is-invalid' : '' }}" name="segmen" id="segmen">
                                                    <option value="ALL_SEGMEN">{{trans('global.allSegmen')}}</option>        
                                                    <option value="BL">BL</option>
                                                    <option value="CL">CL</option>
                                                    <option value="GL">GL</option>
                                                    <option value="PL">PL</option>
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
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body"> 
                                    <form method="POST" action="{{url('admin/performance/provisioning/search')}}">  
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
                                                    <th class="align-middle" rowspan="2">AREA</th>
                                                    <th class="align-middle" colspan="8">PRA-PROVISIONING</th>                                                
                                                    <th class="align-middle" colspan="4">PROVISIONING</th>
                                                    <th class="align-middle" colspan="3">FALLOUT</th>                                            
                                                    <th class="align-middle" colspan="4">PASCA PROVISIONING</th>  
                                                    <th class="align-middle" colspan="3">TIBS</th>
                                                    <th class="align-middle" rowspan="2">TOTAL</th>  
                                                </tr>
                                                <tr>                                                
                                                    <th class="align-middle">WAIT <br> FOR <br> APPROVAL <br> PAPERLESS</th>
                                                    <th class="align-middle">WAIT <br> FOR <br> UPLOAD <br> DOCUMENT <br> PAPERLESS</th>     
                                                    <th class="align-middle">MYCX <br> SEND <br> OPEN <br> PAPERLESS</th>
                                                    <th class="align-middle">MYCX <br> FAIL</th>
                                                    <th class="align-middle">FCC <br> HD1A <br> INVALID <br> IDENTITY</th>                                                                                                                                                
                                                    <th class="align-middle">ADDON <br> FAIL <br> PROV</th>
                                                    <th class="align-middle">NCX <br> CREATE <br> ORDERFAIL</th>
                                                    <th class="align-middle">NCX <br> CREATE <br> ORDER</th>
                                                    
                                                    <th class="align-middle" rowspan="2">OSS <br> PROVISIONING <br> START</th>
                                                    <th class="align-middle" rowspan="2">OSS <br> PROVISIONING <br> DESAIN</th>     
                                                    <th class="align-middle" rowspan="2">OSS <br> FALLOUT</th>
                                                    <th class="align-middle" rowspan="2">OSS <br> PROVISIONING <br> ISSUED</th>

                                                    <th class="align-middle" rowspan="2">FALLOUT <br> ACTIVATION</th>
                                                    <th class="align-middle" rowspan="2">FALLOUT <br> UIM</th>     
                                                    <th class="align-middle" rowspan="2">FALLOUT <br> WFM</th>

                                                    <th class="align-middle" rowspan="2">WFM <br> ACTIVATION <br> COMPLETE</th>
                                                    <th class="align-middle" rowspan="2">OSS <br> TESTING <br> SERVICE</th>     
                                                    <th class="align-middle" rowspan="2">OSS <br> PONR</th>
                                                    <th class="align-middle" rowspan="2">OSS <br> PROVISIONING <br> COMPLETE</th>

                                                    <th class="align-middle" rowspan="2">TIBS <br> FULFILL <br> BILLING <br> FAIL</th>
                                                    <th class="align-middle" rowspan="2">TIBS <br> FULFILL <br> BILLING <br> START</th>     
                                                    <th class="align-middle" rowspan="2">TIBS <br> FULFILL <br> BILLING <br> COMPLETED</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="provisioning-addon">
                                                                                                        
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
@parent
<script>
$(document).ready(function(){
    load_content();

    function load_content(addon_val = '', segmen_val = '') 
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.performance.provisioning') }}',
            'data': {
                addon: addon_val,
                segmen: segmen_val
            },
            'success': function(data) {     
                var addon = $('#addon').val() ? $('#addon').val() : 'ALL_ADDON';           
                var segmen = $('#segmen').val() ? $('#segmen').val() : 'ALL_SEGMEN';    
                $('#provisioning-addon').empty();
                $.each(data.treg_addon, function(index,value){  
                    $('#provisioning-addon').append(`
                    <tr>
                        <td><b>`+value.vwitel+`</b></td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'Wait For Approval Paperless')}}">`+getNumber(value.v1)+`</a>
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'Wait For Upload Document Paperless')}}">`+getNumber(value.v2)+`</a>
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'MYCX  SEND OPEN PAPERLESS')}}">`+getNumber(value.v3)+`</a>
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'MYCX  FAIL')}}">`+getNumber(value.v4)+`</a>
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'FCC  HD1A  INVALID IDENTITY')}}">`+getNumber(value.v5)+`</a>
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'ADDON  FAIL PROV')}}">`+getNumber(value.v6)+`</a>                            
                        </td> 
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '4  NCX  CREATE ORDERFAIL')}}">`+getNumber(value.v7)+`</a>                                                    
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '4  NCX  CREATE ORDER')}}">`+getNumber(value.v8)+`</a>                                                    
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '5  OSS  PROVISIONING START')}}">`+getNumber(value.v9)+`</a>                                                                            
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '6  OSS  PROVISIONING DESAIN')}}">`+getNumber(value.v10)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '7  OSS  FALLOUT')}}">`+getNumber(value.v11)+`</a>                                                                                                        
                        </td>                           
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '7  OSS  PROVISIONING ISSUED')}}">`+getNumber(value.v12)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'Fallout Activation')}}">`+getNumber(value.v13)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'Fallout UIM')}}">`+getNumber(value.v14)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'Fallout WFM')}}">`+getNumber(value.v15)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '9  WFM  ACTIVATION COMPLETE')}}">`+getNumber(value.v16)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'OSS  TESTING SERVICE')}}">`+getNumber(value.v17)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '8  OSS  PONR')}}">`+getNumber(value.v18)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '10  OSS  PROVISIONING COMPLETE')}}">`+getNumber(value.v19)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '11  TIBS  FULFILL BILLING FAIL')}}">`+getNumber(value.v20)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '11  TIBS  FULFILL BILLING START')}}">`+getNumber(value.v21)+`</a>                                                                                                        
                        </td>
                        <td>
                            <a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . '12  TIBS  FULFILL BILLING COMPLETED')}}">`+getNumber(value.v22)+`</a>                                                                                                        
                        </td>
                        <td>
                            <b><a style="color: black" target="_blank" href="{{url('admin/performance/show/provisioning/' . '`+addon+`' . '/' . '`+segmen+`' . '/' . '`+value.vwitel+`' . '/' . 'ALL_STATUS')}}">`+getNumber(value.total)+`</b></a>                                                                                                        
                        </td>
                    </tr>`)
                });
            }
        });
    }

    $('#applyBtn').click(function(e) {
        // var witel = $('#witel').val();
        var addon = $('#addon').val();
        var segmen = $('#segmen').val();
        e.preventDefault();
        
        $('#provisioning-addon').empty();
        load_content(addon,segmen);
        
    });
});
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection