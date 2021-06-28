@extends('layouts.admin')
@section('content')
<style>
    .container {
        width: 100%;        
    }   

    .small-box {
        border-radius: 12px;
    }

    .canvas-container {
        display: block;
        margin: 0 auto;
    }

    .card {
        border-radius: 10px;
    }

    .knob {
        width: 49px !important;
        height: 30px !important;
        position: relative !important;
        vertical-align: middle !important;
        margin-top: -75px !important;
        margin-left: -68px !important;
        border: 0px !important;
        background: none !important;
        font: bold 18px Arial !important;
        text-align: center !important;        
        padding: 0px !important;
        appearance: none !important;
    }

    #progress-bar2p {
        border-radius: 10px !important;
    }

    #progress-bar3p {
        border-radius: 10px !important;
    }
   
</style>

<div class="row">
	<div class="col-lg-12 grid-margin">
		<div class="d-flex justify-content-between flex-wrap">
			<div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
				<h5 class="mr-4 mb-0 font-weight-bold">Dashboard</h5>
				<div class="d-flex align-items-baseline dashboard-breadcrumb">
					<p class="mb-0 mr-1">App</p>
					<i class="mdi mdi-chevron-right mr-1"></i>
					<p class="mb-0 mr-1">Dashboard</p>
					<i class="mdi mdi-chevron-right mr-1"></i>
					<p class="mb-0">Analytics</p>
				</div>
			</div>
			<div class="d-flex">
				{{-- <div class="btn-group mr-3">
					<button type="button" class="btn btn-primary">{{ date("j F Y") }}</button>
				</div> --}}
				{{-- <button class="btn btn-light border d-none d-sm-block">Download Report</button> --}}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-danger">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-account"></i>
					</div>
					<p class="font-weight-medium mb-0">Personal</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($pl , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-success">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-briefcase"></i>
					</div>
					<p class="font-weight-medium mb-0">Business</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($bl , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-office-building"></i>
					</div>
					<p class="font-weight-medium mb-0">Corporate</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($cl , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-warning">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-bank"></i>
					</div>
					<p class="font-weight-medium mb-0">Government</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($gl , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pelanggan Normal</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-between mt-2">
                            <small>Platinum</small>
                            <small>{{$platinum_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$platinum_normal}}%" aria-valuenow="{{$platinum_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <small>Silver</small>
                            <small>{{$silver_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$silver_normal}}%" aria-valuenow="{{$silver_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                                                                                         
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-between mt-2">
                            <small>Gold</small>
                            <small>{{$gold_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$gold_normal}}%" aria-valuenow="{{$gold_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div> 
                        <div class="d-flex justify-content-between mt-3">
                            <small>Reguler</small>
                            <small>{{$reguler_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$reguler_normal}}%" aria-valuenow="{{$reguler_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>   
                    </div>
                </div>
                <div class="card-body text-center">                                           
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-3">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_normal[0] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Platinum</small>
                            </div>
                            <div class="col-3">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_normal[1] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Gold</small>
                            </div>
                            <div class="col-3">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_normal[2] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Silver</small>
                            </div>
                            <div class="col-3">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_normal[3] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Reguler</small>
                            </div>
                        </div>
                    </div>
                </div>                   
            </div>
        </div>
    </div>
    <div class="col-lg-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pelanggan Abnormal</h4>
                <div class="row">
                    <div class="col-lg-4">                        
                        <div class="d-flex justify-content-between mt-2">
                            <small>Platinum</small>
                            <small>{{$platinum_not_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$platinum_not_normal}}%" aria-valuenow="{{$platinum_not_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>                        
                        <div class="d-flex justify-content-between mt-2">
                            <small>Reguler</small>
                            <small>{{$reguler_not_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$reguler_not_normal}}%" aria-valuenow="{{$reguler_not_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>                                          
                    </div>
                    <div class="col-lg-4">                                               
                        <div class="d-flex justify-content-between mt-2">
                            <small>Gold</small>
                            <small>{{$gold_not_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$gold_not_normal}}%" aria-valuenow="{{$gold_not_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>                       
                        <div class="d-flex justify-content-between mt-2">
                            <small>Unbill</small>
                            <small>{{$unbill_not_normal}}%</small>
                        </div>                   
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: {{$unbill_not_normal}}%" aria-valuenow="{{$unbill_not_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">                                                
                        <div class="d-flex justify-content-between mt-2">
                            <small>Silver</small>
                            <small>{{$silver_not_normal}}%</small>
                        </div>
                        <div class="progress progress-sm mt-2">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$silver_not_normal}}%" aria-valuenow="{{$silver_not_normal}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>                                         
                    </div>
                </div> 
                <div class="card-body text-center">
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-4">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_notnormal[0] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Platinum</small>
                            </div>
                            <div class="col-4">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_notnormal[1] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Gold</small>
                            </div>
                            <div class="col-4">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_notnormal[2] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Silver</small>
                            </div>                            
                        </div>
                        <div class="row mt-1">  
                            <div class="col-6" style="margin-left: 35px">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_notnormal[3] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Reguler</small>
                            </div>       
                            <div class="col-6" style="margin-left: -60px">
                                <h6 style="font-size: 11px"><b>{{ @number_format($total_cluster_notnormal[4] , 0, ',', '.') ?? 0}}</b></h6>
                                <small style="font-size: 10px">Unbill</small>   
                            </div>                                                                                                             
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    </div>
    <div class="col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <div class="d-flex align-items-start justify-content-between">
                    <p class="card-title flex-grow">Total Pelanggan</p>
                    {{-- <div class="dropdown dropright card-menu-dropdown">
                        <button class="btn" type="button" id="cardMenuButton5" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardMenuButton5">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> --}}
                </div>     
                <canvas id="total-pelanggan-chart" class="chartjs-render-monitor" width="150" height="120" style="display: block; margin: 0 auto;"></canvas>          
                <div class="d-flex d-md-none d-xl-flex justify-content-between mt-4 mx-2">
                    <div class="d-flex flex-column align-items-center">
                        <h4 class="font-weight-bold">{{$seg_normal}}%</h4>
                        <small>Normal</small>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <h4 class="font-weight-bold">{{$seg_not_normal}}%</h4>
                        <small>Abnormal</small>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 grid-margin grid-margiin-md-0">
        <div class="card">
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <div class="d-flex align-items-start justify-content-between">
                    <p class="card-title flex-grow">Usia Pelanggan</p>
                    <div class="d-flex align-items-center">
                        {{-- <div class="dropdown dropright card-menu-dropdown">
                            <button class="btn" type="button" id="cardMenuButton4" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="cardMenuButton4">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start flex-wrap ">
                    <p class=" mb-0">Cluster Usia dari Seluruh Pelanggan</p>                    
                    <canvas id="online-revenue-chart-dark" width="604" height="302" class="chartjs-render-monitor"
                        style="display: block; width: 672px; height: 336px;"></canvas>
                </div>
            </div>
        </div>
        
        <div class="card" style="margin-top: 30px">
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <div class="d-flex align-items-start justify-content-between">
                    <p class="card-title flex-grow">Speed Internet</p>
                    {{-- <div class="dropdown dropright card-menu-dropdown">
                        <button class="btn" type="button" id="cardMenuButton9" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardMenuButton9" x-placement="right-start"
                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(25px, 0px, 0px);">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> --}}
                </div>
                <canvas id="purchases-chart-dark" height="250" width="450" class="chartjs-render-monitor"
                    style="display: block; height: 250px; width: 450px;"></canvas>                
            </div>
        </div>
        
    </div>
    <div class="col-lg-5 grid-margin">
        <div class="col-auto grid-margin">
            <div class="card" style="width: 103%;">
                <div class="card-body">  
                    <h4 class="card-title">Jenis Indihome</h4>                                      
                    <div class="d-flex justify-content-between">
                        <small>2P</small>
                        <small>{{ @number_format($total_cluster_indihome[0], 0, ',', '.') ?? 0}}</small>
                    </div>
                    <div class="progress progress-lg mt-2" style="border-radius: 10px">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$indihome_2p}}%" aria-valuenow="{{$indihome_2p}}"
                            aria-valuemin="0" aria-valuemax="100" id="progress-bar2p">{{$indihome_2p}}%</div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <small>3P</small>
                        <small>{{ @number_format($total_cluster_indihome[1], 0, ',', '.') ?? 0}}</small>
                    </div>
                    <div class="progress progress-lg mt-2" style="border-radius: 10px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$indihome_3p}}%" aria-valuenow="{{$indihome_3p}}"
                            aria-valuemin="0" aria-valuemax="100" id="progress-bar3p">{{$indihome_3p}}%</div>
                    </div>                                                                
                </div>
            </div>
        </div>
        <div class="col-auto grid-margin">
            <div class="card" style="width: 103%;">
                <div class="card-body">
                    <h4 class="card-title">Jenis Pelanggan Abnormal</h4>
                    <div class="row">
                        <div class="col-4 text-center">                            
                            <div style="display:inline;width:60px;height:60px;">                                
                                <input type="text" readonly="readonly" class="knob"
                                    id="tunggakan-knob" data-width="90" data-height="90" data-fgcolor="#516395"
                                    style="color: #516395;">
                            </div>                            
                        </div>                           
                        
                        <div class="col-4 text-center">
                            <div style="display:inline;width:60px;height:60px;">                                
                                <input type="text" readonly="readonly" class="knob"
                                    id="modem-mati-knob" data-width="90" data-height="90" data-fgcolor="#a8e063"
                                    style="color:  #a8e063;">
                            </div>                            
                        </div>                           
                        
                        <div class="col-4 text-center">
                            <div style="display:inline;width:60px;height:60px;">                                
                                <input type="text" readonly="readonly" class="knob"
                                    id="tunggakmodem-mati-knob" data-width="90" data-height="90" data-fgcolor="#48b1bf"
                                    style="color: #48b1bf;">
                            </div>   
                        </div>                                               
                    </div>  
                    <div class="card-body text-center">                                           
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-4">
                                    <h6><b>{{ @number_format($modem_off, 0, ',', '.') ?? 0}}</b></h6>
                                    <small>Tunggakan</small>
                                </div>
                                <div class="col-4">
                                    <h6><b>{{ @number_format($bill_off, 0, ',', '.') ?? 0}}</b></h6>
                                    <small>Modem Mati</small>
                                </div>
                                <div class="col-4">
                                    <h6><b>{{ @number_format($modemBill_off, 0, ',', '.') ?? 0}}</b></h6>
                                    <small>Tunggakan & Modem Mati</small>
                                </div>
                            </div>
                        </div>
                    </div>                 
                </div>
            </div>
        </div>  
        <div class="col-auto grid-margin">
            <div class="card" style="width: 103%;">
                <div class="card-body">
                    <h4 class="card-title">Usage Inet Last Month</h4>
                    <div class="row">
                        <div class="col-3 text-center">                            
                            <div style="display:inline;width:60px;height:60px;">                                
                                <input type="text" readonly="readonly" class="knob"
                                    id="usageInet1" data-width="90" data-height="90" data-fgcolor="#1777b5"
                                    style="color: #1777b5;">
                            </div>                            
                        </div>                           
                        
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">                                
                                <input type="text" readonly="readonly" class="knob"
                                    id="usageInet2" data-width="90" data-height="90" data-fgcolor="#5a883e"
                                    style="color:  #5a883e;">
                            </div>                            
                        </div>                           
                        
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">                                
                                <input type="text" readonly="readonly" class="knob"
                                    id="usageInet3" data-width="90" data-height="90" data-fgcolor="#f93366"
                                    style="color: #f93366;">
                            </div>   
                        </div>  
                        
                        <div class="col-3 text-center">
                            <div style="display:inline;width:60px;height:60px;">                                
                                <input type="text" readonly="readonly" class="knob"
                                    id="usageInet4" data-width="90" data-height="90" data-fgcolor="#d4a92f"
                                    style="color: #d4a92f;">
                            </div>   
                        </div>  
                    </div>  
                    <div class="card-body text-center">                                           
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-3">
                                    <h6><b>{{ @number_format($total_cluster_usageinet[0], 0, ',', '.') ?? 0}}</b></h6>
                                    <small>0 - 500 GB</small>
                                </div>
                                <div class="col-3">
                                    <h6><b>{{ @number_format($total_cluster_usageinet[1], 0, ',', '.') ?? 0}}</b></h6>
                                    <small>500 - 5.000 GB</small>
                                </div>
                                <div class="col-3">
                                    <h6><b>{{ @number_format($total_cluster_usageinet[2], 0, ',', '.') ?? 0}}</b></h6>
                                    <small>5.000 - 10.000 GB</small>
                                </div>
                                <div class="col-3">
                                    <h6><b>{{ @number_format($total_cluster_usageinet[3], 0, ',', '.') ?? 0}}</b></h6>
                                    <small>Lebih dari 10.000 GB</small>
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
<script src="{{ asset('public/js/chart.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.knob.min.js') }}"></script>
<script src="{{ asset('public/js/progressbar.min.js') }}"></script>
<script>
    $(document).ready(function () {
       
        if ($("#total-pelanggan-chart").length) {
            var areaData = {
                labels: ["Normal", "Abnormal"],
                datasets: [{
                    data: [{{$segmen_normal}}, {{$segmen_not_normal}}],
                    backgroundColor: [
                        "#4d83ff", "#1ad5c3"
                    ],
                    borderColor: "rgba(0,0,0,0)"
                }]
            };
            var areaOptions = {
                responsive: false,
                maintainAspectRatio: true,
                segmentShowStroke: false,
                cutoutPercentage: 55,
                elements: {
                    arc: {
                        borderWidth: 4
                    }
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var value = data['datasets'][0]['data'][tooltipItem['index']];
                            return ' ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }                        
                    },
                    enabled: true,
                    titleFontSize: 11,
                    bodyFontSize: 11,
                    // xAlign: 'top',
                }
            }
            var onlineSalesChartCanvas = $("#total-pelanggan-chart").get(0).getContext("2d");
            var onlineSalesChart = new Chart(onlineSalesChartCanvas, {
                type: 'doughnut',
                data: areaData,
                options: areaOptions,
            });
        }

        if ($('#online-revenue-chart-dark').length) {
            var onlineRevenueCanvas = $("#online-revenue-chart-dark").get(0).getContext("2d");

            var gradient1 = onlineRevenueCanvas.createLinearGradient(0, 0, 0, 350);
            gradient1.addColorStop(0, 'rgba(5, 541, 186, .5)');
            gradient1.addColorStop(1, 'rgba(0,0,0,0)');
            var gradient2 = onlineRevenueCanvas.createLinearGradient(0, 0, 0, 300);
            gradient2.addColorStop(0, 'rgba(98, 1, 237, .5)');
            gradient2.addColorStop(1, 'rgba(0,0,0,0)');

            var data = {
                labels: ["0-3 Bulan", "4-6 Bulan", "7-12 Bulan", "1-2 Tahun", "Lebih dari 2 Tahun"],
                datasets: [{
                    // label: 'Customer',
                    // data: [30243, 56659, 104413, 110859, 206932],
                    data: [{{$count_cluster_usia}}],
                    borderColor: [
                        '#00dac5'
                    ],
                    borderWidth: 4,
                    fill: true,
                    backgroundColor: gradient1
                }, ]
            };
            var options = {
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
                            labelString: "Jumlah Customer"
                        },
                        ticks: {
                            // min: 20000,
                            max: 250000,
                            stepSize: 50000,
                            fontColor: "#606A96",
                            fontSize: 11,
                            fontStyle: 400,
                            padding: 15,
                            callback: function (value, index, values) {
                                if (parseInt(value) >= 1000) {
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
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var value = data['datasets'][0]['data'][tooltipItem['index']];
                            return 'Customer: ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        },
                        afterLabel: function(tooltipItem, data) {
                            var dataset = data['datasets'][0];                        
                            var percent = Math.round((dataset['data'][tooltipItem['index']] / {{$totalcount_cluster_usia}}) * 100)
                            return 'Percentage: ' + percent + '%';
                        }                        
                    }                    
                },
                // legendCallback: function (chart) {
                //     var text = [];
                //     text.push('<div class="d-flex align-items-center">');
                //     text.push('<small>Usia</small>');
                //     text.push('<div class="ml-3" style="width: 12px; height: 12px; background-color: ' + chart.data.datasets[0].borderColor[0] + ' "></div>');
                //     text.push('</div>');
                //     // text.push('<div class="d-flex align-items-center mt-2">');
                //     // text.push('<small>Offline revenue</small>');
                //     // text.push('<div class="ml-3" style="width: 12px; height: 12px; background-color: ' + chart.data.datasets[1].borderColor[0] + ' "></div>');
                //     // text.push('</div>');
                //     return text.join('');
                // },
                elements: {
                    point: {
                        radius: 2,
                    },
                    line: {
                        tension: .35
                    }
                },
                stepsize: 1,
                layout: {
                    padding: {
                        top: 30,
                        bottom: 0,
                        left: 0,
                        right: 0
                    }
                }
            };
            var onlineRevenue = new Chart(onlineRevenueCanvas, {
                type: 'line',
                data: data,
                options: options
            });
            // document.getElementById('online-revenue-legend').innerHTML = onlineRevenue.generateLegend();
        }

        if ($("#purchases-chart-dark").length) {
            var purchasesChartCanvas = $("#purchases-chart-dark").get(0).getContext("2d");
            var purchasesChart = new Chart(purchasesChartCanvas, {
                type: 'bar',
                data: {
                    labels: ["< 10 Mbps", "10 Mbps", "20 Mbps", "30 Mbps", "40 Mbps", "> 50 Mbps"],
                    datasets: [{
                        // label: 'Jumlah',
                        data: [{{$count_cluster_speed}}],
                        backgroundColor: '#fbbc05'
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: true,
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            gridLines: {
                                drawBorder: false,
                                borderWidth: 1,
                                color: 'rgba(46, 50, 74, .7)',
                                zeroLineColor: 'rgba(46, 50, 74, .7)'
                            },
                            scaleLabel: {
                                display: true,
                                labelString: "Jumlah Customer"
                            },
                            ticks: {
                                display: true,
                                fontColor: "#606A96",
                                padding: 0,
                                callback: function (value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return value;
                                    }
                                }
                                // stepSize: 20,
                                // min: 0,
                                // max: 80
                            }
                        }],
                        xAxes: [{
                            stacked: true,
                            categoryPercentage: 1,
                            ticks: {
                                beginAtZero: true,
                                display: true,
                                padding: 10,
                                fontSize: 11,
                                fontColor: "#606A96"
                            },
                            gridLines: {
                                color: "rgba(46, 50, 74, .7)",
                                display: true
                            },
                            position: 'bottom',
                            barPercentage: 0.7
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var value = data['datasets'][0]['data'][tooltipItem['index']];
                                return 'Customer: ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            },
                            afterLabel: function(tooltipItem, data) {
                                var dataset = data['datasets'][0];                        
                                var percent = Math.round((dataset['data'][tooltipItem['index']] / {{$totalcount_cluster_usia}}) * 100)
                                return 'Percentage: ' + percent + '%';
                            }                        
                        }                    
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                }
            });
        }

        $(".knob").knob({
            'format' : function (value) {
                return value + '%';
            }
        });

        $('.knob').knob();
        $('#tunggakan-knob').val({{$modem_off_percent}}).trigger('change');
        $('#modem-mati-knob').val({{$bill_off_percent}}).trigger('change');
        $('#tunggakmodem-mati-knob').val({{$modemBill_off_percent}}).trigger('change');

        $('#usageInet1').val({{$usageInet1}}).trigger('change');
        $('#usageInet2').val({{$usageInet2}}).trigger('change');
        $('#usageInet3').val({{$usageInet3}}).trigger('change');
        $('#usageInet4').val({{$usageInet4}}).trigger('change');
    });
</script>
@endsection