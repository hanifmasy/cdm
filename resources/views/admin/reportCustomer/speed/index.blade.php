@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Grafik Speed Inet</h3>     
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-speed">
                                    <i class="mdi mdi-filter-variant"></i>                              
                                </a>
                            </div>                   
                        </div>                        
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="chart">
                            <canvas id="speedChart" width="900"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
                                    <th rowspan="2" class="align-middle">Datel</th>
                                    <th colspan="14">Cluster</th>                                
                                </tr>
                                <tr>
                                    <th>(blank)</th>                                
                                    <th>512</th>
                                    <th>1024</th>
                                    <th>2048</th>
                                    <th>3072</th>
                                    <th>5120</th>
                                    <th>10240</th>
                                    <th>20480</th>
                                    <th>30720</th>
                                    <th>40960</th>
                                    <th>51200</th>
                                    <th>102400</th>
                                    <th>204800</th>
                                    <th>307200</th>
                                    <th>Total</th>                                
                                </tr>
                                <tbody id="table-speed">
                                        
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
<div class="modal fade" id="modal-filter-speed" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-speed">Filter Speed Inet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterspeed" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">
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

    var chart1 = document.getElementById("speedChart").getContext("2d");

    load_content();

    function load_content(witel_val='')
    {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': "{{ route('admin.reporting.speed') }}",
            'data': {
                witel: witel_val,
            },
            'success': function(data) {    
                var labels_datel = data.labels_datel;            
                var total_speed_kurang10mbps = data.total_speed_kurang10mbps;
                var total_speed_lebih10mbps = data.total_speed_lebih10mbps;                
                var total_speed = data.total_speed;  

                speedChart = new Chart(chart1, {
                    type: 'horizontalBar',
                    data: {
                    labels: JSON.parse(labels_datel),
                    datasets: [{
                        label: "Kurang dari 10 Mbps",
                        backgroundColor: "#c28c17",
                        data: JSON.parse(total_speed_kurang10mbps),
                        }, {
                        label: "Lebih dari 10 Mbps",
                        backgroundColor: "#c7c124",
                        data: JSON.parse(total_speed_lebih10mbps),
                        }, {
                        label: "Grand Total",
                        backgroundColor: "#a3642c",
                        data: JSON.parse(total_speed),
                        }]
                    },
                    options: {
                        // showAllTooltips: true,
                        responsive: false,
                        legend: {
                            position: 'bottom' // place legend on the right side of chart
                        },
                        // tooltips: {
                        //     callbacks: {                  
                        //         label: function(tooltipItem, data) {
                        //             var value = data['datasets'][0]['data'][tooltipItem['index']];
                        //             var datasets = data.datasets[tooltipItem.datasetIndex];
                        //             return datasets.label + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        //         }                               
                        //     },
                        //     titleFontSize: 14,
                        //     bodyFontSize: 12,
                        //     // xAlign: 'left',
                        // },
                        scales: {
                            xAxes: [{
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

                $('#table-speed').empty();
                $.each(data.datatable, function(index,value){                                      
                    $('#table-speed').append(`
                    <tr>
                        <td>`+value.datel_str+`</td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/(blank)') }}">`+getNumber(value.a_blank)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/512') }}">`+getNumber(value.b_512)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/1024') }}">`+getNumber(value.c_1024)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/2048') }}">`+getNumber(value.d_2048)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/3072') }}">`+getNumber(value.e_3072)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/5120') }}">`+getNumber(value.f_5120)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/10240') }}">`+getNumber(value.g_10240)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/20480') }}">`+getNumber(value.h_20480)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/30720') }}">`+getNumber(value.i_30720)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/40960') }}">`+getNumber(value.j_40960)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/51200') }}">`+getNumber(value.k_51200)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/102400') }}">`+getNumber(value.l_102400)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/204800') }}">`+getNumber(value.m_204800)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/307200') }}">`+getNumber(value.n_307200)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.datel_str+`/') }}">`+getNumber(value.o_total)+`</a></td>
                    </tr>`)
                });
            }
        })
    }

    $('#applyBtn').click(function(e) {
        var witel_val = $('#witel').val();  
        console.log(witel_val);     
        e.preventDefault();

        load_content(witel_val);
        $('#modal-filter-speed').modal('hide'); 
        $('#table-speed').empty();
        speedChart.destroy();         
    });

})
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection