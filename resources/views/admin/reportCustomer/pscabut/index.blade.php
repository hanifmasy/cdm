@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="container-fluid">
        @include('partials.navtab')
        <div class="row">
            <div class="col-12 grid-margin stretch-card">             
                <div class="card">
                    <div class="card-header">                   
                        <div style="float: left">
                            <h5>Ach Churn</h5>
                        </div>                  
                        <div class="card-tools" style="float: right">
                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-achchurn">
                                <i class="mdi mdi-filter-variant"></i>                              
                            </a>
                        </div>
                    </div>                
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div style="display:inline;width:60px;height:60px;">
                                    <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                    <input type="text" readonly class="knob" id="caps" data-width="90" data-height="90" data-fgcolor="#516395" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #516395; padding: 0px; appearance: none;"></div>
                                <div class="knob-label"><b>CAPS</b></div>
                                <div id="label-caps"></div>
                            </div>
                    
                            <div class="col-4 text-center">
                                <div style="display:inline;width:60px;height:60px;">
                                    <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                    <input type="text" readonly class="knob" id="cleansing" data-width="90" data-height="90" data-fgcolor="#f45c43" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #f45c43; padding: 0px; appearance: none;"></div>
                                <div class="knob-label"><b>Cleansing</b></div>
                                <div id="label-cleansing"></div>
                            </div>
                        
                            <div class="col-4 text-center">
                                <div style="display:inline;width:60px;height:60px;">
                                    <canvas width="53" height="53" style="width: 60px; height: 60px;"></canvas>
                                    <input type="text" readonly class="knob" id="lis" data-width="90" data-height="90" data-fgcolor="#a8e063" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color:  #a8e063; padding: 0px; appearance: none;"></div>
                                <div class="knob-label"><b>LIS</b></div>
                                <div id="label-lis"></div>
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
                            <h5>Periode PS Cabut</h5>
                        </div>                  
                        <div class="card-tools" style="float: right">
                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-pscabut">
                                <i class="mdi mdi-filter-variant"></i>                                
                            </a>
                        </div>                     
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="chart">
                            <canvas id="pscabutChart" width="750"></canvas>
                        </div>
                    </div>                    
                </div>
            </div>            
        </div>   
    </div>
</div>
<!-- Modal Filter Witel-->
<div class="modal fade" id="modal-filter-pscabut" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-pscabut">Filter PS Cabut</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterpscabut" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">     
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <div class="input-group date datepicker">
                                    <input type="text" class="form-control" id="start_date_ps" placeholder="Start Date">
                                    <span class="input-group-addon input-group-append border-left">
                                      <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>
                                </div>                               
                            </div>                          
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">End Date</label>                                
                                <div class="input-group date datepicker">
                                    <input type="text" class="form-control" id="end_date_ps" placeholder="End Date">
                                    <span class="input-group-addon input-group-append border-left">
                                      <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>
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
<!-- Modal Filter Periode-->
<div class="modal fade" id="modal-filter-achchurn" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-achchurn">Filter Periode Churn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterachchurn" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">     
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
                </form>
            </div>
            <div class="modal-footer">                              
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="applyBtnAchChurn">
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
{{-- <script src="{{ asset('public/js/formpickers.js') }}"></script> --}}
<script>
$(document).ready(function() {

    $('.datepicker').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
    });

    var pslineChart = document.getElementById('pscabutChart').getContext('2d');

    load_content();

    function load_content(witel='',start_ps='',end_ps='',periode='')
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.reporting.pscabut') }}',
            'data': {
                witel: witel,
                start_ps: start_ps,
                end_ps: end_ps,
                periode: periode
            },
            'success': function(data) {                
                var labels_pscabut = data.labels_pscabut;
                var labels_date_pscabut = data.labels_date_pscabut;
                var total_counts_pscabut = data.total_counts_pscabut;   

                var total_counts_caps = data.total_counts_caps;  
                var total_counts_cleansing = data.total_counts_cleansing; 
                var total_counts_cman = data.total_counts_cman;   

                if (data.ach_caps > 100) {
                    $('#caps').knob({                        
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#caps').trigger('configure', {
                        max: data.ach_caps,
                    });
                }

                if (data.ach_cleansing > 100) {
                    $('#cleansing').knob({
                        "min" : 0,
                        "max" : data.ach_cleansing,
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#cleansing').trigger('configure', {
                        max: data.ach_cleansing,
                    });
                }

                if (data.ach_lis > 100) {
                    $('#lis').knob({
                        "min" : 0,
                        "max" : data.ach_lis,
                        'format' : function (value) {
                            return value + '%';
                        } 
                    });
                    $('#lis').trigger('configure', {
                        max: data.ach_lis,
                    });
                }

                $(".knob").knob({
                    'format' : function (value) {
                        return value + '%';
                    }
                });

                $('#caps').val(data.ach_caps).trigger('change');
                $('#cleansing').val(data.ach_cleansing).trigger('change');
                $('#lis').val(data.ach_lis).trigger('change');

                $('#caps').show();
                $('#cleansing').show();
                $('#lis').show();

                $('#label-caps').append(`
                    <span>Target : `+formatNumber(data.target_caps)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.caps)+`</span>
                `)

                $('#label-cleansing').append(`
                    <span>Target : `+formatNumber(data.target_cleansing)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.cleansing)+`</span>
                `)

                $('#label-lis').append(`
                    <span>Target : `+formatNumber(data.target_lis)+`</span><br>
                    <span>Realisasi : `+formatNumber(data.lis)+`</span>
                `)
                
                pscabutChart = new Chart(pslineChart, {
                    type: 'line',
                    data: {
                        labels: JSON.parse(labels_date_pscabut),
                        datasets: [
                        {  
                            label: 'Total',                   
                            fill: false,                            
                            borderColor: 'rgb(54, 162, 235)',
                            data: JSON.parse(total_counts_pscabut)
                        },
                        {  
                            label: 'CAPS',                   
                            fill: false,                            
                            borderColor: 'rgba(200, 0, 0, 1)',
                            data: JSON.parse(total_counts_caps)
                        },
                        {  
                            label: 'Cleansing',                   
                            fill: false,                             
                            borderColor: 'rgba(0, 200, 0, 1)',
                            data: JSON.parse(total_counts_cleansing)
                        },
                        {  
                            label: 'Cman',                   
                            fill: false,                             
                            borderColor: 'rgb(204,204,0)',
                            data: JSON.parse(total_counts_cman)
                        }
                    ]
                    },
                    options: {
                        legend: {
                            display: true
                        },
                        tooltips: {
                            mode: 'index',                            
                            callbacks: {                                           
                                label: function(tooltipItem, data) {                                   
                                    // var label = tooltipsLabel[tooltipItem[0].index];
                                    var value = tooltipItem.yLabel;
                                    return ' ' + data.datasets[tooltipItem.datasetIndex].label +': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }                           
                            },
                            titleFontSize: 14,
                            bodyFontSize: 12,                        
                        },                       
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: "Total Customer"
                                },
                                ticks: {
                                    beginAtZero: true,
                                    callback: function(value, index, values) {
                                        if(parseInt(value) >= 1000){
                                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                        } else {
                                            return value;
                                        }
                                    }
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
        var start_ps = $('#start_date_ps').val();
        var end_ps = $('#end_date_ps').val();
        e.preventDefault();

        if (start_ps != '' && end_ps == '') {
            alert("Please select filter end ps")
        } else if (start_ps == '' && end_ps != '') {
            alert("Please select filter start ps")
        } else {
            load_content(witel,start_ps,end_ps);
            $('#modal-filter-pscabut').modal('hide'); 
            pscabutChart.destroy();  

            $('#caps').hide();
            $('#cleansing').hide();
            $('#lis').hide();

            $('#label-caps').empty();
            $('#label-cleansing').empty();
            $('#label-lis').empty(); 
        }                      
    });

    $('#applyBtnAchChurn').click(function(e) {
        var witel = $('#witel').val();
        var start_ps = $('#start_date_ps').val();
        var end_ps = $('#end_date_ps').val();
        var periode = $('#periode').val();
        e.preventDefault();
       
        load_content(witel,start_ps,end_ps,periode);
        $('#modal-filter-achchurn').modal('hide'); 

        $('#caps').hide();
        $('#cleansing').hide();
        $('#lis').hide();

        $('#label-caps').empty();
        $('#label-cleansing').empty();
        $('#label-lis').empty(); 
    });   
   
});
function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection