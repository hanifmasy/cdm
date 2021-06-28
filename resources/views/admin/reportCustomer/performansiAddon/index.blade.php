@extends('layouts.admin')
@section('content')
<div class="content">    
    {{-- <div class="row">
        <div class="col-12 grid-margin stretch-card">             
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">                            
                        % Achievement ({{$month_now}})
                    </h3>
                    <div class="card-tools">
                        
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
                            <div class="knob-label"><b>STB</b></div>
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
                </div>                
            </div>              
        </div>            
    </div> --}}
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Periode Performansi Addon</h3>     
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-performaddon">
                                <i class="mdi mdi-filter-variant"></i>                                
                            </a>
                        </div>                   
                    </div>                        
                </div>
                <div class="card-body" style="display: block;">
                    <div class="chart">
                        <canvas id="performaddonChart" width="750"></canvas>
                    </div>                      
                </div>                    
            </div>
        </div>            
    </div>   
</div>
<!-- Modal Filter Witel-->
<div class="modal fade" id="modal-filter-performaddon" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-performaddon">Filter Performansi Addon</h5>
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
                                {{-- <input type="text" class="form-control date" id="start_date" placeholder="Start Date"> --}}
                                <div class="input-group date datepicker">
                                    <input type="text" class="form-control" id="start_date" placeholder="Start Date">
                                    <span class="input-group-addon input-group-append border-left">
                                      <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">End Date</label>
                                {{-- <input type="text" class="form-control date" id="end_date" placeholder="End Date"> --}}
                                <div class="input-group date datepicker">
                                    <input type="text" class="form-control" id="end_date" placeholder="End Date">
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
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="{{ asset('public/js/jquery.knob.min.js') }}"></script>
<script>
$(document).ready(function() {

    $('.datepicker').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
    });

    var addonlineChart = document.getElementById('performaddonChart').getContext('2d');

    load_content();

    function load_content(witel='',start_date='',end_date='') {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.reporting.performaddon') }}',
            'data': {
                witel: witel,
                start_date: start_date,
                end_date: end_date
            },
            'success': function(data) {
                var labels_date = data.labels_date_ps;

                var total_counts_mig2p3p = data.total_counts_mig2p3p;
                var total_counts_minipack = data.total_counts_minipack;
                var total_counts_stb = data.total_counts_stb;
                var total_counts_upgradespeed = data.total_counts_upgradespeed;
                var total_counts_all = data.total_counts_all;
                
                addonChart = new Chart(addonlineChart, {
                    type: 'line',
                    data: {
                        labels: JSON.parse(labels_date),
                        datasets: [
                            {  
                                label: 'Mig2p3p',                   
                                fill: false,                                                            
                                borderColor: 'rgb(101, 67, 33)',
                                data: JSON.parse(total_counts_mig2p3p)
                            },
                            {  
                                label: 'Minipack',                   
                                fill: false,                            
                                borderColor: 'rgba(200, 0, 0, 1)',
                                data: JSON.parse(total_counts_minipack)
                            },
                            {  
                                label: 'STB Tambahan',                   
                                fill: false,                             
                                borderColor: 'rgba(0, 200, 0, 1)',
                                data: JSON.parse(total_counts_stb)
                            },
                            {  
                                label: 'Upgrade Speed',                   
                                fill: false,                             
                                borderColor: 'rgb(204,204,0)',
                                data: JSON.parse(total_counts_upgradespeed)
                            },
                            {  
                                label: 'Total',                   
                                fill: false,                             
                                borderColor: 'rgb(54, 162, 235)',
                                data: JSON.parse(total_counts_all)
                            },
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
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        e.preventDefault();

        if (start_date != '' && end_date == '') {
            alert("Please select filter end date")
        } else if (start_date == '' && end_date != '') {
            alert("Please select filter start date")
        } else {
            load_content(witel,start_date,end_date);
            $('#modal-filter-performaddon').modal('hide'); 

            addonChart.destroy();  
        }                      
    });

})

function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endsection