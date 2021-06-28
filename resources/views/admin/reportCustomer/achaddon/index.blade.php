@extends('layouts.admin')
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">             
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>Ach Addon</h4>
                    </div>                  
                    <div class="card-tools" style="float: right">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-achaddon">
                            <i class="mdi mdi-filter-variant"></i>                              
                        </a>
                    </div>  
                </div>                
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="mig2p3p" data-width="90" data-height="90" data-fgcolor="#516395" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #516395; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>Mig2P3P</b></div>
                            <div id="label-mig2p3p"></div>
                        </div>
                
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="minipack" data-width="90" data-height="90" data-fgcolor="#f45c43" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #f45c43; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>Minipack</b></div>
                            <div id="label-minipack"></div>
                        </div>
                    
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="stb" data-width="90" data-height="90" data-fgcolor="#a8e063" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color:  #a8e063; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>STB Tambahan</b></div>
                            <div id="label-stb"></div>
                        </div>
                    
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="upgrade" data-width="90" data-height="90" data-fgcolor="#48b1bf" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #48b1bf; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>Upgrade</b></div>
                            <div id="label-upgrade"></div>
                        </div>                    
                    </div>
                    <div class="row mt-4">
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="mig1p2p" data-width="90" data-height="90" data-fgcolor="#5d444d" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #5d444d; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>Mig1P2P</b></div>
                            <div id="label-mig1p2p"></div>
                        </div> 
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="wifiext" data-width="90" data-height="90" data-fgcolor="#816ecd" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #816ecd; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>Wifi Ext</b></div>
                            <div id="label-wifiext"></div>
                        </div> 
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="plc" data-width="90" data-height="90" data-fgcolor="#d76ad0" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #d76ad0; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>PLC</b></div>
                            <div id="label-plc"></div>
                        </div>
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="ottvideo" data-width="90" data-height="90" data-fgcolor="#d27325" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #d27325; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>OTT Video</b></div>
                            <div id="label-ottvideo"></div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="musik" data-width="90" data-height="90" data-fgcolor="#c11d59" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #c11d59; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>Musik</b></div>
                            <div id="label-musik"></div>
                        </div>
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="indibox" data-width="90" data-height="90" data-fgcolor="#ecda14" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #ecda14; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>Indibox</b></div>
                            <div id="label-indibox"></div>
                        </div>
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="ihsmart" data-width="90" data-height="90" data-fgcolor="#3b2ce0" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #3b2ce0; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>IH Smart</b></div>
                            <div id="label-ihsmart"></div>
                        </div>
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="ihstudy" data-width="90" data-height="90" data-fgcolor="#ff0000" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #ff0000; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>IH Study</b></div>
                            <div id="label-ihstudy"></div>
                        </div>
                    </div>                                 
                </div>                
            </div>              
        </div>            
    </div>
</div>
<!-- Modal Filter Witel-->
<div class="modal fade" id="modal-filter-achaddon" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-achaddon">Filter Addon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterpscabut" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Periode</label>
                                <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="periode" id="periode">                                    
                                    @foreach ($periodes as $id => $periode)
                                    <option value="{{ $periode->bulan }}" {{ old('periode') == $periode->bulan ? 'selected' : '' }}>{{$periode->bulan}}</option>
                                    @endforeach
                                </select>                             
                            </div>                          
                        </div>                        
                    </div>     
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Witel</label>
                                <select class="form-control {{ $errors->has('witel') ? 'is-invalid' : '' }}" name="witel" id="witel">
                                    <option value="">{{trans('global.treg6Select')}}</option>
                                    <option value="45">BALIKPAPAN</option>
                                    <option value="42">KALBAR</option>
                                    <option value="44">KALSEL</option>
                                    <option value="47">KALTARA</option>
                                    <option value="43">KALTENG</option>
                                    <option value="46">SAMARINDA</option>
                                </select>
                            </div>
                        </div>                       
                    </div>  
                                                                     
                </form>
            </div>
            <div class="modal-footer">                              
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="applyBtn">
                    <span>Filter</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="{{ asset('public/js/jquery.knob.min.js') }}"></script>
<script>
$(document).ready(function() {

    load_content();

    function load_content(witel_val='', periode_val='') {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.reporting.achaddon') }}',
            'data': {
                witel: witel_val,
                periode: periode_val
            },
            'success': function(data) {

                if (data.ach_mig2p3p > 100) {
                    $('#mig2p3p').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#mig2p3p').trigger('configure', {
                        max: data.ach_mig2p3p,
                    });
                }

                if (data.ach_minipack > 100) {
                    $('#minipack').knob({                        
                        'format': function (value) {
                            return value + '%';
                        }
                    });
                    $('#minipack').trigger('configure', {
                        max: data.ach_minipack,
                    });
                }

                if (data.ach_stb > 100) {
                    $('#stb').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        }  
                    });
                    $('#stb').trigger('configure', {
                        max: data.ach_stb,
                    });
                }

                if (data.ach_upgrade > 100) {
                    $('#upgrade').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#upgrade').trigger('configure', {
                        max: data.ach_upgrade,
                    });
                }

                if (data.ach_mig1p2p > 100) {
                    $('#mig1p2p').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#mig1p2p').trigger('configure', {
                        max: data.ach_mig1p2p,
                    });
                }

                if (data.ach_wifiext > 100) {
                    $('#wifiext').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#wifiext').trigger('configure', {
                        max: data.ach_wifiext,
                    });
                }

                if (data.ach_plc > 100) {
                    $('#plc').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#plc').trigger('configure', {
                        max: data.ach_plc,
                    });
                }

                if (data.ach_ottvideo > 100) {
                    $('#ottvideo').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#ottvideo').trigger('configure', {
                        max: data.ach_ottvideo,
                    });
                }

                if (data.ach_musik > 100) {
                    $('#musik').knob({                       
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#musik').trigger('configure', {
                        max: data.ach_musik,
                    });
                }

                if (data.ach_indibox > 100) {
                    $('#indibox').knob({                
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#indibox').trigger('configure', {
                        max: data.ach_indibox,
                    });
                }

                if (data.ach_ihsmart > 100) {
                    $('#ihsmart').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#ihsmart').trigger('configure', {
                        max: data.ach_ihsmart,
                    });
                }

                if (data.ach_ihstudy > 100) {
                    $('#ihstudy').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#ihstudy').trigger('configure', {
                        max: data.ach_ihstudy,
                    });
                }

                $(".knob").knob({
                    'format': function (value) {
                        return value + '%';
                    }
                });
                
                $('#mig2p3p').val(data.ach_mig2p3p).trigger('change');
                $('#minipack').val(data.ach_minipack).trigger('change');
                $('#stb').val(data.ach_stb).trigger('change');
                $('#upgrade').val(data.ach_upgrade).trigger('change');
                $('#mig1p2p').val(data.ach_mig1p2p).trigger('change');
                $('#wifiext').val(data.ach_wifiext).trigger('change');
                $('#plc').val(data.ach_plc).trigger('change');
                $('#ottvideo').val(data.ach_ottvideo).trigger('change');
                $('#musik').val(data.ach_musik).trigger('change');
                $('#indibox').val(data.ach_indibox).trigger('change');
                $('#ihsmart').val(data.ach_ihsmart).trigger('change');
                $('#ihstudy').val(data.ach_ihstudy).trigger('change');
                
                $('#mig2p3p').show();
                $('#minipack').show();
                $('#stb').show();
                $('#upgrade').show();
                $('#mig1p2p').show();
                $('#wifiext').show();
                $('#plc').show();
                $('#ottvideo').show();
                $('#musik').show();
                $('#indibox').show();
                $('#ihsmart').show();
                $('#ihstudy').show();
                                
                $('#label-mig2p3p').append(`
                    <span>Target : `+formatNumber(data.target_mig2p3p)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.mig2p3p)+`</span>
                `)

                $('#label-minipack').append(`
                    <span>Target : ` + formatNumber(data.target_minipack) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.minipack) + `</span><br>
                    <span>(PSB : ` + formatNumber(data.minipack_psb) + `, Addon : ` + formatNumber(data.minipack_sales) + `,</span><br>
                    <span>Prepaid : ` + formatNumber(data.minipack_prepaid) + `)</span>
                `)

                $('#label-stb').append(`
                    <span>Target : ` + formatNumber(data.target_stb) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.stb) + `</span>
                `)

                $('#label-upgrade').append(`
                    <span>Target : ` + formatNumber(data.target_upgrade) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.upgrade) + `</span>
                `)

                $('#label-mig1p2p').append(`
                    <span>Target : ` + formatNumber(data.target_mig1p2p) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.mig1p2p) + `</span>
                `)

                $('#label-wifiext').append(`
                    <span>Target : ` + formatNumber(data.target_wifiext) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.wifiext) + `</span>
                `)

                $('#label-plc').append(`
                    <span>Target : ` + formatNumber(data.target_plc) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.plc) + `</span>
                `)

                $('#label-ottvideo').append(`
                    <span>Target : ` + formatNumber(data.target_ottvideo) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.ottvideo) + `</span>
                `)

                $('#label-musik').append(`
                    <span>Target : ` + formatNumber(data.target_musik) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.musik) + `</span><br>
                    <span>(PSB : ` + formatNumber(data.musik_psb) + `, Addon : ` + formatNumber(data.musik_sales) + `,</span><br>
                    <span>Prepaid : ` + formatNumber(data.musik_prepaid) + `)</span>
                `)

                $('#label-indibox').append(`
                    <span>Target : ` + formatNumber(data.target_indibox) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.indibox) + `</span>
                `)

                $('#label-ihsmart').append(`
                    <span>Target : ` + formatNumber(data.target_ihsmart) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.ihsmart) + `</span><br>
                    <span>(PSB : ` + formatNumber(data.ihsmart_psb) + `, Addon : ` + formatNumber(data.ihsmart_sales) + `,</span><br>
                    <span>Prepaid : ` + formatNumber(data.ihsmart_prepaid) + `)</span>                    
                `)

                $('#label-ihstudy').append(`
                    <span>Target : ` + formatNumber(data.target_ihstudy) + `</span><br>
                    <span>Realisasi : ` + formatNumber(data.ihstudy) + `</span><br>
                    <span>(PSB : ` + formatNumber(data.ihstudy_psb) + `, Addon : ` + formatNumber(data.ihstudy_sales) + `,</span><br>
                    <span>Prepaid : ` + formatNumber(data.ihstudy_prepaid) + `)</span>
                `)
            }   
        })      
    }

    $('#applyBtn').click(function(e) {
        var witel = $('#witel').val();        
        var periode = $('#periode').val();        
        e.preventDefault();

        load_content(witel,periode);
        $('#modal-filter-achaddon').modal('hide'); 
        
        $('#mig2p3p').hide();
        $('#minipack').hide();
        $('#stb').hide();
        $('#upgrade').hide();
        $('#mig1p2p').hide();
        $('#wifiext').hide();
        $('#plc').hide();
        $('#ottvideo').hide();
        $('#musik').hide();
        $('#indibox').hide();
        $('#ihsmart').hide();
        $('#ihstudy').hide();

        $('#label-mig2p3p').empty();
        $('#label-minipack').empty();
        $('#label-stb').empty();
        $('#label-upgrade').empty(); 
        $('#label-mig1p2p').empty();  
        $('#label-wifiext').empty();  
        $('#label-plc').empty();  
        $('#label-ottvideo').empty();
        $('#label-musik').empty();
        $('#label-indibox').empty();
        $('#label-ihsmart').empty();
        $('#label-ihstudy').empty();
                                   
    });
});
function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection