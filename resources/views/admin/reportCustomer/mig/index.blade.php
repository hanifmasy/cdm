@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Komposisi 2P3P</h3>
                </div>
                <div class="card-body">
                    <div class="row">            
                        <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="card-title">Perbandingan 2P3P</h2>   
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-mig">
                                                <i class="mdi mdi-filter-variant"></i>                              
                                            </a>
                                        </div>                
                                    </div>                                                         
                                </div>
                                <div class="card-body">                            
                                    <canvas id="migPie" width="400"></canvas>                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data per Cluster</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-center">
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
                                            <tbody id="table-mig">
                                                    
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
<!-- Modal Filter Witel-->
<div class="modal fade" id="modal-filter-mig" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-mig">Filter MIG2P3P</h5>
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
    
    var chart1 = document.getElementById("migPie").getContext("2d");

    load_content();

    function load_content(witel_val='')
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.reporting.mig2p3p') }}',
            'data': {
                witel: witel_val,
            },
            'success': function(data) {                   
                var total_mig = data.total_mig;                
                var total_all_mig = data.total_all_mig;

                Chart.pluginService.register({
                    beforeRender: function (chart) {
                        if (chart.config.options.showAllTooltips) {                   
                            chart.pluginTooltips = [];
                            chart.config.data.datasets.forEach(function (dataset, i) {
                                chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                                    chart.pluginTooltips.push(new Chart.Tooltip({
                                        _chart: chart.chart,
                                        _chartInstance: chart,
                                        _data: chart.data,
                                        _options: chart.options.tooltips,
                                        _active: [sector]
                                    }, chart));
                                });
                            });

                            // turn off normal tooltips
                            chart.options.tooltips.enabled = false;
                        }
                    },
                    afterDraw: function (chart, easing) {
                        if (chart.config.options.showAllTooltips) {
                            // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                            if (!chart.allTooltipsOnce) {
                                if (easing !== 1)
                                    return;
                                chart.allTooltipsOnce = true;
                            }

                            // turn on tooltips
                            chart.options.tooltips.enabled = true;
                            Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                                tooltip.initialize();
                                tooltip.update();
                                // we don't actually need this since we are not animating tooltips
                                tooltip.pivot();
                                tooltip.transition(easing).draw();
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    }
                })               

                migPie = new Chart(chart1, {
                    type: 'pie',
                    data: {
                        labels: ["2P", "3P"],
                        datasets: [{
                            backgroundColor: [                               
                                "#c28c17",                                                     
                                "#3498db"             
                            ],                
                            data: JSON.parse(total_mig),
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
                                    var percent = Math.round((dataset['data'][tooltipItem['index']] / total_all_mig) * 100)
                                    return '(' + percent + '%)';
                                }
                            },
                            titleFontSize: 14,
                            bodyFontSize: 12,
                            xAlign: 'bottom', 
                        }
                    }
                });
                
                $('#table-mig').empty();
                $.each(data.datatable, function(index,value){                                      
                    $('#table-mig').append(`
                    <tr>
                        <td>`+value.mig2p3p+`</td>
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
        $('#modal-filter-mig').modal('hide'); 
        $('#table-mig').empty();        
        migPie.destroy();        
    });
})  
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}  
</script>
@endsection