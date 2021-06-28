@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Grafik ARPU</h3>     
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-arpu">
                                    <i class="mdi mdi-filter-variant"></i>                               
                                </a>
                            </div>                   
                        </div>                        
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="chart">
                            <canvas id="arpuChart" width="700"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Komposisi ARPU</h3>                   
                    </div>
                    <div class="card-body">                            
                        <canvas id="arpuPie" width="700"></canvas>                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4>Data per Cluster</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th rowspan="2" class="align-middle">Source</th>
                                    <th colspan="7">Cluster</th>                                
                                </tr>
                                <tr>
                                    <th>0</th>                                
                                    <th>0 - 100 rb</th>
                                    <th>100 - 200 rb</th>
                                    <th>200 - 300 rb</th>
                                    <th>300 - 500 rb</th>
                                    <th>500 - 1 jt</th>
                                    <th>> 1 jt</th>
                                </tr>
                                <tbody id="table-arpu">
                                        
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- Modal Filter Witel-->
<div class="modal fade" id="modal-filter-arpu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-arpu">Filter ARPU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterarpu" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">
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
$(document).ready(function(){

    var chart1 = document.getElementById("arpuChart").getContext("2d");
    var chart2 = document.getElementById("arpuPie").getContext("2d");

    load_content();

    function load_content(witel_val='')
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.reporting.arpu') }}',
            'data': {
                witel: witel_val,
            },
            'success': function(data) {
                var labels_source = data.labels_source;
                var total_arpu_ct0 = data.total_arpu_ct0;
                var total_arpu_isiska = data.total_arpu_isiska;
                var total_arpu_ncx = data.total_arpu_ncx;
                var total_arpu = data.total_arpu;
                var total_all_arpu = data.total_all_arpu;

                // Chart.pluginService.register({
                //     beforeRender: function (chart) {
                //         if (chart.config.options.showAllTooltips) {                   
                //             chart.pluginTooltips = [];
                //             chart.config.data.datasets.forEach(function (dataset, i) {
                //                 chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                //                     chart.pluginTooltips.push(new Chart.Tooltip({
                //                         _chart: chart.chart,
                //                         _chartInstance: chart,
                //                         _data: chart.data,
                //                         _options: chart.options.tooltips,
                //                         _active: [sector]
                //                     }, chart));
                //                 });
                //             });

                //             // turn off normal tooltips
                //             chart.options.tooltips.enabled = false;
                //         }
                //     },
                //     afterDraw: function (chart, easing) {
                //         if (chart.config.options.showAllTooltips) {
                //             // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                //             if (!chart.allTooltipsOnce) {
                //                 if (easing !== 1)
                //                     return;
                //                 chart.allTooltipsOnce = true;
                //             }

                //             // turn on tooltips
                //             chart.options.tooltips.enabled = true;
                //             Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                //                 tooltip.initialize();
                //                 tooltip.update();
                //                 // we don't actually need this since we are not animating tooltips
                //                 tooltip.pivot();
                //                 tooltip.transition(easing).draw();
                //             });
                //             chart.options.tooltips.enabled = false;
                //         }
                //     }
                // })

                arpuChart = new Chart(chart1, {
                    type: 'bar',
                    data: {
                    labels: ["0", "0 - 100 rb", "100 - 200 rb", "200 - 300 rb", "300 - 500 rb", "500 - 1 jt", "> 1 jt"],
                    datasets: [{
                        label: "CT0",
                        backgroundColor: "#c28c17",
                        data: JSON.parse(total_arpu_ct0),
                        }, {
                        label: "ISISKA",
                        backgroundColor: "#c7c124",
                        data: JSON.parse(total_arpu_isiska),
                        }, {
                        label: "NCX",
                        backgroundColor: "#519c17",
                        data: JSON.parse(total_arpu_ncx),
                        }, {
                        label: "Grand Total",
                        backgroundColor: "#a3642c",
                        data: JSON.parse(total_arpu),
                        }]
                    },
                    options: {
                        // showAllTooltips: true,
                        responsive: false,
                        legend: {
                            position: 'bottom' // place legend on the right side of chart
                        },                         
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: "Jumlah Customer"
                                },
                                ticks: {
                                    beginAtZero: true,
                                    steps: 10,
                                    stepValue: 5,
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
                    },
                });

                arpuPie = new Chart(chart2, {
                    type: 'pie',
                    data: {
                        labels: ["0", "0 - 100 rb", "100 - 200 rb", "200 - 300 rb", "300 - 500 rb", "500 - 1 jt", "> 1 jt"],
                        datasets: [{
                            backgroundColor: [
                                "#e74c3c",
                                "#c7c124",
                                "#519c17",
                                "#a3642c",
                                "#c28c17",                     
                                "#95a5a6",
                                "#3498db"             
                            ],                
                            data: JSON.parse(total_arpu),
                        }]
                    },
                    options: {
                        showAllTooltips: true,
                        tooltips: {
                            callbacks: {                                
                                label: function(tooltipItem, data) {
                                    var value = data['datasets'][0]['data'][tooltipItem['index']];
                                    return ' ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                },
                                afterLabel: function(tooltipItem, data) {
                                    var dataset = data['datasets'][0];
                                    var percent = Math.round((dataset['data'][tooltipItem['index']] / total_all_arpu) * 100)
                                    return '(' + percent + '%)';
                                }
                            },
                            titleFontSize: 14,
                            bodyFontSize: 12,
                            // xAlign: 'bottom', 
                        }
                    }
                });
                
                $('#table-arpu').empty();
                $.each(data.datatable, function(index,value){                                      
                    $('#table-arpu').append(`
                    <tr>
                        <td>`+getNumber(value.source)+`</td>
                        <td>`+getNumber(value.a_null)+`</td>
                        <td>`+getNumber(value.b_0_100rb)+`</td>
                        <td>`+getNumber(value.c_100_200rb)+`</td>
                        <td>`+getNumber(value.d_200_300rb)+`</td>
                        <td>`+getNumber(value.e_300_500rb)+`</td>
                        <td>`+getNumber(value.f_500_1jt)+`</td> 
                        <td>`+getNumber(value.g_lebihdari1jt)+`</td>                                               
                    </tr>`)
                });
            }
        })
    }

    $('#applyBtn').click(function(e) {
        var witel_val = $('#witel').val();            
        e.preventDefault();

        load_content(witel_val);
        $('#modal-filter-arpu').modal('hide'); 
        $('#table-arpu').empty();
        arpuChart.destroy(); 
        arpuPie.destroy();        
    });
})  
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}  
</script>
@endsection