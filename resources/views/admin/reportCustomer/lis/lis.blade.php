@extends('layouts.admin')
@section('content')
<style>
.card {
        border-radius: 10px;
    }
</style>
<!-- row total_allkw  -->
<div>
<div class="col-12 grid-margin stretch-card">
		<div class="card icon-card-light">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-account"></i>
					</div>
					<p class="font-weight-medium mb-0">Total All Kw</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($data_alltotal->total_allkw , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
</div>
<!-- row total_kw1 s.d. 4 -->
<div class="row">
	<div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-danger">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-account"></i>
					</div>
					<p class="font-weight-medium mb-0">KW-1</p>
                    <p class="card-text">No Bill No Usage</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($data_alltotal->total_kw1 , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
    <div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-primary">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-account"></i>
					</div>
					<p class="font-weight-medium mb-0">KW-2</p>
                    <p class="card-text">Bill No Usage</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($data_alltotal->total_kw2 , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
    <div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-warning">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-account"></i>
					</div>
					<p class="font-weight-medium mb-0">KW-3</p>
                    <p class="card-text">Usage No Bill</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($data_alltotal->total_kw3 , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
    <div class="col-12 col-sm-6 col-lg-3 grid-margin stretch-card">
		<div class="card icon-card-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
						<i class="mdi mdi-account"></i>
					</div>
					<p class="font-weight-medium mb-0">KW-4</p>
                    <p class="card-text">Usage Bill</p>
				</div>
				<div class="d-flex align-items-center mt-3 flex-wrap">
					<h3 class="font-weight-medium mb-0 mr-2"><b>{{number_format($data_alltotal->total_kw4 , 0, ',', '.')}}</b></h3>					
				</div>				
			</div>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-6">
        <div class="table-responsive">
            <table id="order-listing-kw3" class="table table-bordered table-hover datatable" style="width: 50%;">
            <caption>KW-3 Usage No Bill</caption>
                <thead>
                    <tr>
                        <th>Witel</th>
                        <th>2P</th>
                        <th>3P</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="col-6">
        <div class="table-responsive">
            <table id="order-listing-kw4" class="table table-bordered table-hover datatable" style="width: 50%;">
            <caption>KW-4 Usage Bill</caption>
                <thead>
                    <tr>
                        <th>Witel</th>
                        <th>2P</th>
                        <th>3P</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="table-responsive">
            <table id="order-listing-kw1" class="table table-bordered table-hover datatable" style="width: 50%;">
            <caption>KW-1 No Bill No Usage</caption>
                <thead>
                    <tr>
                        <th>Witel</th>
                        <th>2P</th>
                        <th>3P</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="col-6">
        <div class="table-responsive">
            <table id="order-listing-kw2" class="table table-bordered table-hover datatable" style="width: 50%;">
            <caption>KW-2 Bill No Usage</caption>
                <thead>
                    <tr>
                        <th>Witel</th>
                        <th>2P</th>
                        <th>3P</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script>
$(document).ready(function(){
    $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': "{{ route('admin.reporting.lis') }}",
            'success': function(data) {     
                    $.each(data.datatable_kw1, function(index,value){                                      
                    $('#order-listing-kw1').append(
                        `<tr>
                        <td>`+value.witel+`</td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/2p') }}">`+getNumber(value.a_2p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/3p') }}">`+getNumber(value.b_3p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/') }}">`+getNumber(value.total)+`</a></td>
                        </tr>`
                    )});
                    $.each(data.datatable_kw2, function(index,value){                                      
                    $('#order-listing-kw2').append(
                        `<tr>
                        <td>`+value.witel+`</td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/2p') }}">`+getNumber(value.a_2p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/3p') }}">`+getNumber(value.b_3p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/') }}">`+getNumber(value.total)+`</a></td>
                        </tr>`
                    )});
                    $.each(data.datatable_kw3, function(index,value){                                      
                    $('#order-listing-kw3').append(
                        `<tr>
                        <td>`+value.witel+`</td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/2p') }}">`+getNumber(value.a_2p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/3p') }}">`+getNumber(value.b_3p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/') }}">`+getNumber(value.total)+`</a></td>
                        </tr>`
                    )});
                    $.each(data.datatable_kw4, function(index,value){                                      
                    $('#order-listing-kw4').append(
                        `<tr>
                        <td>`+value.witel+`</td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/2p') }}">`+getNumber(value.a_2p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/3p') }}">`+getNumber(value.b_3p)+`</a></td>
                        <td><a href="{{ url('admin/reporting/speed/detail/`+value.witel+`/') }}">`+getNumber(value.total)+`</a></td>
                        </tr>`
                    )});
            }
    })
})
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}  
</script>
@endsection