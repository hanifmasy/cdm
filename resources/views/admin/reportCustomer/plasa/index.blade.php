@extends('layouts.admin')
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">             
            <div class="card">
                <div class="card-header">                   
                    <div style="float: left">
                        <h5>Ach PSB Plasa</h5>
                    </div>                  
                    <div class="card-tools" style="float: right">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-achplasa">
                            <i class="mdi mdi-filter-variant"></i>                              
                        </a>
                    </div>
                </div>                
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="plasa" data-width="90" data-height="90" data-fgcolor="#516395" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #516395; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>All</b></div>
                            <div id="label-plasa"></div>
                        </div>
                
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="balikpapan" data-width="90" data-height="90" data-fgcolor="#f45c43" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #f45c43; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>BALIKPAPAN</b></div>
                            <div id="label-balikpapan"></div>
                        </div>
                    
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="kalbar" data-width="90" data-height="90" data-fgcolor="#a8e063" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color:  #a8e063; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>KALBAR</b></div>
                            <div id="label-kalbar"></div>
                        </div>

                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="kalsel" data-width="90" data-height="90" data-fgcolor="#5d444d" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color:  #5d444d; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>KALSEL</b></div>
                            <div id="label-kalsel"></div>
                        </div>                                                                   
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-4 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="kaltara" data-width="90" data-height="90" data-fgcolor="#816ecd" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #816ecd; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>KALTARA</b></div>
                            <div id="label-kaltara"></div>
                        </div>
                
                        <div class="col-4 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="kalteng" data-width="90" data-height="90" data-fgcolor="#d76ad0" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #d76ad0; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>KALTENG</b></div>
                            <div id="label-kalteng"></div>
                        </div>
                    
                        <div class="col-4 text-center">
                            <div style="display:inline;width:60px;height:60px;">
                                <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                <input type="text" readonly class="knob" id="samarinda" data-width="90" data-height="90" data-fgcolor="#d27325" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color:  #d27325; padding: 0px; appearance: none;"></div>
                            <div class="knob-label"><b>SAMARINDA</b></div>
                            <div id="label-samarinda"></div>
                        </div>                            
                                                                
                    </div>
                </div>                
            </div>              
        </div>            
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">                          
                    <div style="float: left">
                        <h4>Periode PS Plasa</h4>
                    </div>                  
                    <div class="card-tools" style="float: right">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-psplasa">
                            <i class="mdi mdi-filter-variant"></i>                                
                        </a>
                    </div>                     
                </div>
                <div class="card-body" style="display: block;">
                    <div class="chart">
                        <canvas id="psplasaChart" width="750"></canvas>
                    </div>
                </div>                    
            </div>
        </div>            
    </div> 
</div>
<!-- Modal Filter AchPlasa-->
<div class="modal fade" id="modal-filter-achplasa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-achplasa">Filter Ach Plasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterachplasa" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Periode</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon input-group-append border-right">
                                        <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>                                    
                                    <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="ach_periode" id="ach_periode">                                             
                                        @foreach ($periodes_ach as $id => $periode)
                                        <option value="{{ $periode->bulan }}" {{ old('periode') == $periode->bulan ? 'selected' : '' }}>{{$periode->bulan}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div> 
                            </div>
                        </div>                        
                    </div> 
                </form>
            </div>
            <div class="modal-footer">                              
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="applyBtnAch">
                    <span>Filter</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Filter PSPlasa-->
<div class="modal fade" id="modal-filter-psplasa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-psplasa">Filter PS Plasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterpsplasa" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Filter</label>
                                <select class="form-control {{ $errors->has('witel') ? 'is-invalid' : '' }}" name="witel" id="witel">
                                    <option value="">{{trans('global.treg6Select')}}</option>
                                    @foreach ($witels as $id => $witel)
                                    <option value="{{ $witel->nama_witel }}" {{ old('witel') == $witel->nama_witel ? 'selected' : '' }}>{{$witel->nama_witel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start Periode</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon input-group-append border-right">
                                        <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>                                    
                                    <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="start_periode" id="start_periode">      
                                        <option value="">{{trans('global.pleaseSelect')}}</option>                              
                                        @foreach ($periodes as $id => $periode)
                                        <option value="{{ $periode->bulanps }}" {{ old('periode') == $periode->bulanps ? 'selected' : '' }}>{{$periode->bulanps}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">End Periode</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon input-group-append border-right">
                                        <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>                                    
                                    <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="end_periode" id="end_periode">                                    
                                        <option value="">{{trans('global.pleaseSelect')}}</option>
                                        @foreach ($periodes as $id => $periode)
                                        <option value="{{ $periode->bulanps }}" {{ old('periode') == $periode->bulanps ? 'selected' : '' }}>{{$periode->bulanps}}</option>
                                        @endforeach
                                    </select>
                                   
                                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script>
$(document).ready(function() {

    var pslineChart = document.getElementById('psplasaChart').getContext('2d');

    load_content();

    function load_content(witel='',start_periode='',end_periode='',ach_periode='') {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.reporting.plasa') }}',
            'data': {
                witel: witel,
                start_periode: start_periode,
                end_periode: end_periode,
                // ach_witel: ach_witel,
                ach_periode: ach_periode
            },
            'success': function(data) {                                    
                var labels_date_psplasa = data.labels_date_psplasa;
                var total_counts_all = data.total_counts_all;   

                var total_counts_mig2p = data.total_counts_mig2p;  
                var total_counts_mig3p = data.total_counts_mig3p; 

                // var gradient1 = pslineChart.createLinearGradient(0, 0, 0, 350);
                // gradient1.addColorStop(0, 'rgba(5, 541, 186, .5)');
                // gradient1.addColorStop(1, 'rgba(0,0,0,0)');
                // var gradient2 = pslineChart.createLinearGradient(0, 0, 0, 300);
                // gradient2.addColorStop(0, 'rgba(98, 1, 237, .5)');
                // gradient2.addColorStop(1, 'rgba(0,0,0,0)');

                if (data.ach_plasa > 100) {
                    $('#plasa').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#plasa').trigger('configure', {
                        max: data.ach_plasa,
                    });
                }

                if (data.ach_balikpapan > 100) {
                    $('#balikpapan').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#balikpapan').trigger('configure', {
                        max: data.ach_balikpapan,
                    });
                }

                if (data.ach_kalbar > 100) {
                    $('#kalbar').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#kalbar').trigger('configure', {
                        max: data.ach_kalbar,
                    });
                }

                if (data.ach_kalsel > 100) {
                    $('#kalsel').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#kalsel').trigger('configure', {
                        max: data.ach_kalsel,
                    });
                }

                if (data.ach_kaltara > 100) {
                    $('#kaltara').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#kaltara').trigger('configure', {
                        max: data.ach_kaltara,
                    });
                }

                if (data.ach_kalteng > 100) {
                    $('#kalteng').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#kalteng').trigger('configure', {
                        max: data.ach_kalteng,
                    });
                }

                if (data.ach_samarinda > 100) {
                    $('#samarinda').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#samarinda').trigger('configure', {
                        max: data.ach_samarinda,
                    });
                }

                $(".knob").knob({
                    'format' : function (value) {
                        return value + '%';
                    }
                });

                $('#plasa').val(data.ach_plasa).trigger('change');
                $('#balikpapan').val(data.ach_balikpapan).trigger('change');
                $('#kalsel').val(data.ach_kalsel).trigger('change');
                $('#kalbar').val(data.ach_kalbar).trigger('change');
                $('#kaltara').val(data.ach_kaltara).trigger('change');
                $('#kalteng').val(data.ach_kalteng).trigger('change');
                $('#samarinda').val(data.ach_samarinda).trigger('change');

                $('#plasa').show();
                $('#balikpapan').show();
                $('#kalsel').show();
                $('#kalbar').show();
                $('#kaltara').show();
                $('#kalteng').show();
                $('#samarinda').show();
                
                $('#label-plasa').append(`
                    <span>Target : `+formatNumber(data.target_plasa)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.plasa)+`</span>
                `)

                $('#label-balikpapan').append(`
                    <span>Target : `+formatNumber(data.target_balikpapan)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.balikpapan)+`</span>
                `)

                $('#label-kalbar').append(`
                    <span>Target : `+formatNumber(data.target_kalbar)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.kalbar)+`</span>
                `)

                $('#label-kalsel').append(`
                    <span>Target : `+formatNumber(data.target_kalsel)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.kalsel)+`</span>
                `)

                $('#label-kaltara').append(`
                    <span>Target : `+formatNumber(data.target_kaltara)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.kaltara)+`</span>
                `)

                $('#label-kalteng').append(`
                    <span>Target : `+formatNumber(data.target_kalteng)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.kalteng)+`</span>
                `)

                $('#label-samarinda').append(`
                    <span>Target : `+formatNumber(data.target_samarinda)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.samarinda)+`</span>
                `)

                psplasaChart = new Chart(pslineChart, {
                type: 'line',
                data: {
                    labels: JSON.parse(labels_date_psplasa),                        
                    datasets: [                        
                        {  
                            label: '2P',                   
                            fill: false,                            
                            borderColor: 'rgba(200, 0, 0, 1)',
                            data: JSON.parse(total_counts_mig2p),
                            // backgroundColor: gradient2,
                        },
                        {  
                            label: '3P',                   
                            fill: false,                             
                            borderColor: 'rgba(0, 200, 0, 1)',
                            data: JSON.parse(total_counts_mig3p),
                            // backgroundColor: gradient1,
                        },
                        {  
                            label: 'Total',                   
                            fill: false,                            
                            borderColor: 'rgb(54, 162, 235)',
                            data: JSON.parse(total_counts_all),
                            // backgroundColor: 'rgba(47, 152, 208, 0.2)',
                        }                  
                    ],
                    
                },
                options: {
                    legend: {
                        display: true
                    },
                    tooltips: {
                        mode: 'index',                            
                        callbacks: {                                           
                            label: function(tooltipItem, data) {                                                                       
                                var value = tooltipItem.yLabel;
                                return ' ' + data.datasets[tooltipItem.datasetIndex].label +': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }                           
                        },
                        titleFontSize: 14,
                        bodyFontSize: 12,                        
                    },                       
                    scales: {
                        yAxes: [{
                            display: true,
                            gridLines: {
                                drawBorder: false,
                                lineWidth: 1,
                                color: "rgba(46, 50, 74, .7)",
                                zeroLineColor: "rgba(46, 50, 74, .7)",
                            },
                            scaleLabel: {
                                display: true,
                                labelString: "Total Customer"
                            },
                            ticks: {
                                beginAtZero: true,                                    
                                // stepSize: 250,
                                callback: function(value, index, values) {
                                    if(parseInt(value) >= 1000){
                                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return value;
                                    }
                                }
                            }
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                                lineWidth: 1,
                                color: "#e9e9e9",
                            },
                            ticks: {
                                fontColor: "#606A96",
                                fontSize: 11,
                                fontStyle: 400,
                                padding: 15,
                            }
                        }]
                    }
                }
            });                    
            }
        })
    }

    $('#applyBtn').click(function(e) {
        var witel = $('#witel').val();
        var start_periode = $('#start_periode').val();
        var end_periode = $('#end_periode').val();
        e.preventDefault();

        if (start_periode != '' && end_periode == '') {
            alert("Please select filter end periode")
        } else if (start_periode == '' && end_periode != '') {
            alert("Please select filter start periode")
        } else {
            load_content(witel,start_periode,end_periode);
            $('#modal-filter-psplasa').modal('hide');

            $('#plasa').hide(); 
            $('#balikpapan').hide();
            $('#kalsel').hide();
            $('#kalbar').hide();
            $('#kaltara').hide();
            $('#kalteng').hide();
            $('#samarinda').hide();

            $('#label-plasa').empty();  
            $('#label-balikpapan').empty();  
            $('#label-kalbar').empty();  
            $('#label-kalsel').empty();
            $('#label-kaltara').empty();
            $('#label-kalteng').empty();
            $('#label-samarinda').empty();           

            psplasaChart.destroy();  
        }                      
    });

    $('#applyBtnAch').click(function(e) {
        var witel = $('#witel').val();
        var start_periode = $('#start_periode').val();
        var end_periode = $('#end_periode').val();
        // var ach_witel = $('#ach_witel').val();
        var ach_periode = $('#ach_periode').val();
        e.preventDefault();

        load_content(witel,start_periode,end_periode,ach_periode);
        $('#modal-filter-achplasa').modal('hide');

        $('#plasa').hide(); 
        $('#balikpapan').hide();
        $('#kalsel').hide();
        $('#kalbar').hide();
        $('#kaltara').hide();
        $('#kalteng').hide();
        $('#samarinda').hide();

        $('#label-plasa').empty();  
        $('#label-balikpapan').empty();  
        $('#label-kalbar').empty();  
        $('#label-kalsel').empty();
        $('#label-kaltara').empty();
        $('#label-kalteng').empty();
        $('#label-samarinda').empty();   

        // psplasaChart.destroy();  
                          
    });
});

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection