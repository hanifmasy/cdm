@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="container-fluid">
        @include('partials.navtab')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">                          
                        <div style="float: left">
                            <h5>Length of Stay Regional VI</h5>
                            <h5 id="thn_periode"></h5>
                        </div>                  
                        <div class="card-tools" style="float: right">
                            <a href="#" class="btn btn-tool btn-md" data-toggle="modal" data-target="#modal-filter-ct0">
                                <i class="mdi mdi-filter-variant"></i>                                
                            </a>
                        </div>                     
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="chart">
                            <canvas id="ct0Chart" width="750"></canvas>
                        </div>
                    </div>                    
                </div>
            </div>            
        </div>
    </div>
</div>
<!-- Modal Filter Periode-->
<div class="modal fade" id="modal-filter-ct0" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-ct0">Filter Periode Churn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterct0" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">     
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Periode</label>
                                <div class="input-group">
                                    <span class="input-group-addon input-group-append border-right">
                                        <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>   
                                    <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="periode" id="periode">
                                        <option value="">{{trans('global.pleaseSelect')}}</option>
                                        @foreach ($periodes_ct0 as $id => $periode)
                                        <option value="{{ $periode->bulan_psb }}" {{ old('periode') == $periode->bulan_psb ? 'selected' : '' }}>{{$periode->bulan_psb}}</option>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script>
$(document).ready(function() {
    var ctlineChart = document.getElementById('ct0Chart').getContext('2d');

    load_content();

    function load_content(periode='') {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.reporting.ct0') }}',
            'data': {              
                periode: periode
            },
            'success': function(data) {

                // var periode = $('#periode').val();
                if (periode != '') {
                    $('#thn_periode').append(`
                        Periode : `+ periode +`
                    `);
                } else {
                    $('#thn_periode').append(`
                        Periode : 202004
                    `);
                }

                var labels_ct0 = data.labels_ct0;
                var total_counts_alltreg = data.total_counts_alltreg;   
                var total_counts_balikpapan = data.total_counts_balikpapan;  
                var total_counts_kalbar = data.total_counts_kalbar; 
                var total_counts_kalsel = data.total_counts_kalsel; 
                var total_counts_kaltara = data.total_counts_kaltara; 
                var total_counts_kalteng = data.total_counts_kalteng; 
                var total_counts_samarinda = data.total_counts_samarinda;

                var total_counts_alltreg_unbill = data.total_counts_alltreg_unbill;   
                var total_counts_balikpapan_unbill = data.total_counts_balikpapan_unbill;  
                var total_counts_kalbar_unbill = data.total_counts_kalbar_unbill; 
                var total_counts_kalsel_unbill = data.total_counts_kalsel_unbill; 
                var total_counts_kaltara_unbill = data.total_counts_kaltara_unbill; 
                var total_counts_kalteng_unbill = data.total_counts_kalteng_unbill; 
                var total_counts_samarinda_unbill = data.total_counts_samarinda_unbill; 

                var total_counts_alltreg_psb = data.total_counts_alltreg_psb;   
                var total_counts_balikpapan_psb = data.total_counts_balikpapan_psb;   
                var total_counts_kalbar_psb = data.total_counts_kalbar_psb;   
                var total_counts_kalsel_psb = data.total_counts_kalsel_psb;   
                var total_counts_kaltara_psb = data.total_counts_kaltara_psb; 
                var total_counts_kalteng_psb = data.total_counts_kalteng_psb;
                var total_counts_samarinda_psb = data.total_counts_samarinda_psb;   
                
                ctChart = new Chart(ctlineChart, {
                    type: 'line',
                    data: {
                        labels: JSON.parse(labels_ct0),
                        datasets: [
                        {  
                            label: 'TREG6',                   
                            fill: false,                            
                            borderColor: 'rgb(54, 162, 235)',
                            data: JSON.parse(total_counts_alltreg),
                            datax: JSON.parse(total_counts_alltreg_unbill),
                            dataz: JSON.parse(total_counts_alltreg_psb)
                        },
                        {  
                            label: 'BALIKPAPAN',                   
                            fill: false,                            
                            borderColor: 'rgba(200, 0, 0, 1)',
                            data: JSON.parse(total_counts_balikpapan),
                            datax: JSON.parse(total_counts_balikpapan_unbill),
                            dataz: JSON.parse(total_counts_balikpapan_psb)
                        },
                        {  
                            label: 'KALBAR',                   
                            fill: false,                             
                            borderColor: 'rgba(0, 200, 0, 1)',
                            data: JSON.parse(total_counts_kalbar),
                            datax: JSON.parse(total_counts_kalbar_unbill),
                            dataz: JSON.parse(total_counts_kalbar_psb)
                        },
                        {  
                            label: 'KALSEL',                   
                            fill: false,                             
                            borderColor: '#00ffd0',
                            data: JSON.parse(total_counts_kalsel),
                            datax: JSON.parse(total_counts_kalsel_unbill),
                            dataz: JSON.parse(total_counts_kalsel_psb)
                        },
                        {  
                            label: 'KALTARA',                   
                            fill: false,                             
                            borderColor: '#795548',
                            data: JSON.parse(total_counts_kaltara),
                            datax: JSON.parse(total_counts_kaltara_unbill),
                            dataz: JSON.parse(total_counts_kaltara_psb)
                        },
                        {  
                            label: 'KALTENG',                   
                            fill: false,                             
                            borderColor: '#f44336',
                            data: JSON.parse(total_counts_kalteng),
                            datax: JSON.parse(total_counts_kalteng_unbill),
                            dataz: JSON.parse(total_counts_kalteng_psb)
                        },
                        {  
                            label: 'SAMARINDA',                   
                            fill: false,                             
                            borderColor: '#607d8b',
                            data: JSON.parse(total_counts_samarinda),
                            datax: JSON.parse(total_counts_samarinda_unbill),
                            dataz: JSON.parse(total_counts_samarinda_psb)
                        }                       
                    ]
                    },
                    options: {
                        legend: {
                            display: true
                        },
                        tooltips: {
                            mode: 'label',                            
                            callbacks: {                                  
                                label: function(tooltipItem, data) {                                   
                                    // var label = tooltipsLabel[tooltipItem[0].index];
                                    var value = tooltipItem.yLabel;
                                    return ' ' + data.datasets[tooltipItem.datasetIndex].label +': ' + value + '%';
                                },
                                afterLabel: function (tooltipItem, data) {
                                    return ' ' + 'Unbill: ' + data.datasets[tooltipItem.datasetIndex].datax[tooltipItem.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' | ' 
                                        + 'Total Psb: ' + data.datasets[tooltipItem.datasetIndex].dataz[tooltipItem.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }                                                 
                            },
                            titleFontSize: 14,
                            bodyFontSize: 12,                        
                        },                       
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: "Percentage (%)"
                                },
                                ticks: {
                                    // beginAtZero: true,
                                    // min: 80,
                                    max: 100,
                                    // stepSize: 20,
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
        var periode = $('#periode').val();
        e.preventDefault();
        
        load_content(periode);
        $('#modal-filter-ct0').modal('hide'); 
        $('#thn_periode').empty();
        ctChart.destroy();  
        
    });   
});
</script>
@endsection