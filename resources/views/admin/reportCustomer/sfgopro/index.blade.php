@extends('layouts.admin')
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">                                
                                    <div class="row">                                    
                                        <div class="col-md-5 mt-1">
                                            <label for="" style="font-size:14px">Witel</label>
                                            <select class="form-control {{ $errors->has('witel') ? 'is-invalid' : '' }}" name="witel" id="witel">
                                                <option value="">{{trans('global.treg6Select')}}</option>
                                                @foreach ($witels as $id => $witel)
                                                <option value="{{ $witel->nama_witel }}" {{ old('witel') == $witel->nama_witel ? 'selected' : '' }}>{{$witel->nama_witel}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">                    
                                                <label for="">Worst Channel Sales Follow Up</label>
                                                <select class="form-control {{ $errors->has('channel') ? 'is-invalid' : '' }}" name="channel" id="channel">
                                                    <option value="">{{trans('global.allChannel')}}</option>
                                                    @foreach ($channels as $channel)
                                                    <option value="{{ $channel }}" {{ old('channel') == $channel ? 'selected' : '' }}>{{$channel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <button type="button" class="btn btn-info mr-2" id="applyBtn" style="margin-top: 10px">Filter</button>
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
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">            
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>SF GoPro</h4>
                    </div>                                   
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">    
                                    <h3 class="card-title">5 Worst Sales Follow Up</h3>            
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Seller ID</th>
                                                    <th>Nama Seller</th>
                                                    <th>Channel</th>
                                                    <th style="text-align: center">Sisa Dapros</th>
                                                    <th style="text-align: center">Follow Up</th>
                                                    <th style="text-align: center">Total Dapros</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="worst-sales">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Semua Addon</h3>                               
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Channel</th>
                                                    <th style="text-align: center">Sisa Dapros</th>
                                                    <th style="text-align: center">Follow Up</th>
                                                    <th style="text-align: center">Total Dapros</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="all-addon">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Minipack</h3>                               
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Channel</th>
                                                    <th style="text-align: center">Sisa Dapros</th>
                                                    <th style="text-align: center">Follow Up</th>
                                                    <th style="text-align: center">Total Dapros</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="minipack-addon">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Speed Upgrade</h3>                               
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Channel</th>
                                                    <th style="text-align: center">Sisa Dapros</th>
                                                    <th style="text-align: center">Follow Up</th>
                                                    <th style="text-align: center">Total Dapros</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="upgrade-addon">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">STB Tambahan</h3>                               
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Channel</th>
                                                    <th style="text-align: center">Sisa Dapros</th>
                                                    <th style="text-align: center">Follow Up</th>
                                                    <th style="text-align: center">Total Dapros</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="stb-addon">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Mig2P3P</h3>                               
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Channel</th>
                                                    <th style="text-align: center">Sisa Dapros</th>
                                                    <th style="text-align: center">Follow Up</th>
                                                    <th style="text-align: center">Total Dapros</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="mig2p3p-addon">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Other</h3>                               
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Channel</th>
                                                    <th style="text-align: center">Sisa Dapros</th>
                                                    <th style="text-align: center">Follow Up</th>
                                                    <th style="text-align: center">Total Dapros</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody id="other-addon">
                                            
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

    function load_content(witel_val='', sales_channel_val='') {
        $.ajax({
            'type': "GET",
            'datatype': "JSON",
            'url': '{{ route('admin.reporting.sfgopro') }}',
            'data': {
                witel: witel_val,
                sales_channel: sales_channel_val,
            },
            'success': function(data) {

                var witel = $('#witel').val() ? $('#witel').val() : 'ALL_WITEL';   

                $('#worst-sales').empty();
                $.each(data.total_worst_sales, function(index,value){                                      
                    $('#worst-sales').append(`
                    <tr>
                        <td><b>`+value.seller_id+`</b></td>
                        <td><b>`+value.nama_seller+`</b></td>
                        <td><b>`+value.channel+`</b></td>
                        <td style="text-align: center">`+formatNumber(value.sisa_dapros)+`</td>
                        <td style="text-align: center">`+formatNumber(value.total_followup)+`</td>
                        <td style="text-align: center">`+formatNumber(value.total_dapros)+`</td>                                              
                    </tr>`)
                });

                $('#all-addon').empty();
                $.each(data.total_all_addon, function(index,value){                                      
                    $('#all-addon').append(`
                    <tr>
                        <td><b>`+value.channel+`</b></td>
                        <td style="text-align: center">
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'ALL_ADDON' . '/' . 'SISA_DAPROS')}}">`+formatNumber(value.sisa_dapros)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'ALL_ADDON' . '/' . 'FOLLOWUP_DAPROS')}}">`+formatNumber(value.total_followup)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'ALL_ADDON' . '/' . 'TOTAL_DAPROS')}}">`+formatNumber(value.total_dapros)+`</a>
                        </td>                                              
                    </tr>`)
                });

                $('#minipack-addon').empty();
                $.each(data.total_minipack_addon, function(index,value){                                      
                    $('#minipack-addon').append(`
                    <tr>                          
                        <td><b>`+value.channel+`</b></td>
                        <td style="text-align: center">
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'minipack' . '/' . 'SISA_DAPROS')}}">`+formatNumber(value.sisa_dapros)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'minipack' . '/' . 'FOLLOWUP_DAPROS')}}">`+formatNumber(value.total_followup)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'minipack' . '/' . 'TOTAL_DAPROS')}}">`+formatNumber(value.total_dapros)+`</a>
                        </td>                                               
                    </tr>`)
                });

                $('#upgrade-addon').empty();
                $.each(data.total_upgrade_addon, function(index,value){                                      
                    $('#upgrade-addon').append(`
                    <tr>
                        <td><b>`+value.channel+`</b></td>
                        <td style="text-align: center">
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'upgrade_speed' . '/' . 'SISA_DAPROS')}}">`+formatNumber(value.sisa_dapros)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'upgrade_speed' . '/' . 'FOLLOWUP_DAPROS')}}">`+formatNumber(value.total_followup)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'upgrade_speed' . '/' . 'TOTAL_DAPROS')}}">`+formatNumber(value.total_dapros)+`</a>
                        </td>   
                    </tr>`)
                });

                $('#stb-addon').empty();
                $.each(data.total_stb_addon, function(index,value){                                      
                    $('#stb-addon').append(`
                    <tr>
                        <td><b>`+value.channel+`</b></td>
                        <td style="text-align: center">
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'stb_tambahan' . '/' . 'SISA_DAPROS')}}">`+formatNumber(value.sisa_dapros)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'stb_tambahan' . '/' . 'FOLLOWUP_DAPROS')}}">`+formatNumber(value.total_followup)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'stb_tambahan' . '/' . 'TOTAL_DAPROS')}}">`+formatNumber(value.total_dapros)+`</a>
                        </td>   
                    </tr>`)
                });

                $('#mig2p3p-addon').empty();
                $.each(data.total_mig2p3p_addon, function(index,value){                                      
                    $('#mig2p3p-addon').append(`
                    <tr>
                        <td><b>`+value.channel+`</b></td>
                        <td style="text-align: center">
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'mig2p3p' . '/' . 'SISA_DAPROS')}}">`+formatNumber(value.sisa_dapros)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'mig2p3p' . '/' . 'FOLLOWUP_DAPROS')}}">`+formatNumber(value.total_followup)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'mig2p3p' . '/' . 'TOTAL_DAPROS')}}">`+formatNumber(value.total_dapros)+`</a>
                        </td>   
                    </tr>`)
                });

                $('#other-addon').empty();
                $.each(data.total_other_addon, function(index,value){                                      
                    $('#other-addon').append(`
                    <tr>
                        <td><b>`+value.channel+`</b></td>
                        <td style="text-align: center">
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'other' . '/' . 'SISA_DAPROS')}}">`+formatNumber(value.sisa_dapros)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'other' . '/' . 'FOLLOWUP_DAPROS')}}">`+formatNumber(value.total_followup)+`</a>
                        </td>
                        <td style="text-align: center">                            
                            <a style="color: black" target="_blank" href="{{url('admin/reporting/show/sfgopro/' . '`+witel+`' . '/' . '`+value.channel+`' . '/' . 'other' . '/' . 'TOTAL_DAPROS')}}">`+formatNumber(value.total_dapros)+`</a>
                        </td>   
                    </tr>`)
                });
            }
        })
    }

    $('#applyBtn').click(function(e) {
        var witel_val = $('#witel').val();  
        var sales_channel_val = $('#channel').val();                    
        e.preventDefault();

        load_content(witel_val,sales_channel_val);

        $('#worst-sales').empty();
        $('#all-addon').empty();                   
        $('#minipack-addon').empty(); 
        $('#upgrade-addon').empty();
        $('#stb-addon').empty(); 
        $('#mig2p3p-addon').empty(); 
        $('#other-addon').empty(); 
    });   
});
function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
} 
</script>
@endsection