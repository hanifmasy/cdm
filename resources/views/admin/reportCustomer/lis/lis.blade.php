@extends('layouts.admin')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')
<div class="row" style="margin:0 auto;">
  <div class="col-3 p-3 text-white" style="width:30%;">
        <div class="card text-center p-3" style="width: 20rem;background-color:#ffd542;">
          <div class="card-body">
            <h4>KW-3</h4>
             <div class="card-text">
              <p><i>Tanpa Tagihan, Ada Usage</i></p>
            </div>
            @foreach($data['total_kw'] as $val)
			<div class="h4">
				<a class="link-light" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw3_usagenobill']) }}">{{number_format($val->c_kw3 , 0, ',', '.')}}</a>
			</div>
			@endforeach
          </div>
        </div>
		<br>
		<div class="card text-center p-3" style="width: 20rem;background-color:#ff4242;">
          <div class="card-body">
            <h4>KW-1</h4>
            <div class="card-text">
              <p><i>Tanpa Tagihan, Tidak Ada Usage</i></p>
            </div>
            @foreach($data['total_kw'] as $val)
			<div class="h4">
				<a class="link-light" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw1_nobillnousage']) }}">{{number_format($val->a_kw1 , 0, ',', '.')}}</a>
			</div>
			@endforeach
          </div>
        </div>
  </div>
  <div class="col-3 p-3 text-white" style="width:30%;">
		<div class="card text-center p-3" style="width: 20rem;background-color:#42ddff;">
          <div class="card-body">
            <h4>KW-4</h4>
             <div class="card-text">
              <p><i>Ada Usage, Dengan Tagihan</i></p>
            </div>
            @foreach($data['total_kw'] as $val)
			<div class="h4">
				<a class="link-light" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw4_usagebill']) }}">{{number_format($val->d_kw4 , 0, ',', '.')}}</a>
			</div>
			@endforeach
          </div>
        </div>
		<br>
		<div class="card text-center p-3" style="width: 20rem;background-color:#4282ff;">
          <div class="card-body">
            <h4>KW-2</h4>
             <div class="card-text">
              <p><i>Tidak Ada Usage, Dengan Tagihan</i></p>
            </div>
            @foreach($data['total_kw'] as $val)
		   <div class="h4">
				<a class="link-light" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw2_billnousage']) }}">{{number_format($val->b_kw2 , 0, ',', '.')}}</a>
			</div>
			@endforeach
			
          </div>
        </div>
  </div>
  
	<div class="col-3 p-5">
		<div class="card text-center p-5 border" style="width: 20rem;">
          <div class="card-body">
            <h4>TOTAL LIS</h4>
            @foreach($data['total_kw'] as $val)
			<div class="h4">
				<a class="link-dark" href="{{ route('admin.reporting.lis.detail') }}">{{number_format($val->e_total , 0, ',', '.')}}</a>
			</div>
			@endforeach
          </div>
        </div>
	</div>
  </div>
  <br>
  
<div class="row text-center">
<div class="col">
	<!-- KW-3 -->
	<div class="table-responsive">
	<h5 class="text-md-center">LIS KW-3</h5>
    <table class="table table-striped table-condensed datatable" style="width: 30rem;">
      <tr>
        <th>Witel</th>
        <th>2P</th>
        <th>3P</th>
        <th>Total</th>
      </tr>
      @foreach($data['table_kw3'] as $val)
      <tr>
        <td>{{ $val->witel }}</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw3_usagenobill','witel'=>$val->witel,'tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw3_usagenobill','witel'=>$val->witel,'tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw3_usagenobill','witel'=>$val->witel]) }}">{{ $val->c_total }}</a></td>
      </tr>
      @endforeach
      @foreach($data['grand_kw3'] as $val)
      <tr>
        <td>GRAND TOTAL</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw3_usagenobill','tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw3_usagenobill','tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw3_usagenobill']) }}">{{ $val->total }}</a></td>
      </tr>
      @endforeach
    </table>
	</div>
	</div>

	<div class="col">
	<!-- KW-4 -->
	<div class="table-responsive">
	<h5>LIS KW-4</h5>
    <table class="table table-striped table-condensed datatable" style="width: 30rem;">
      <tr>
        <th>Witel</th>
        <th>2P</th>
        <th>3P</th>
        <th>Total</th>
      </tr>
      @foreach($data['table_kw4'] as $val)
      <tr>
        <td>{{ $val->witel }}</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw4_usagebill','witel'=>$val->witel,'tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw4_usagebill','witel'=>$val->witel,'tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw4_usagebill','witel'=>$val->witel]) }}">{{ $val->c_total }}</a></td>
      </tr>
      @endforeach
      @foreach($data['grand_kw4'] as $val)
      <tr>
        <td>GRAND TOTAL</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw4_usagebill','tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw4_usagebill','tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw4_usagebill']) }}">{{ $val->total }}</a></td>
      </tr>
      @endforeach
    </table>
	</div>
	</div>
</div>

 <div class="row text-center">
  <div class="col">
	<!-- KW-1 -->
	<div class="table-responsive">
	<h5>LIS KW-1</h5>
    <table class="table table-striped table-condensed datatable" style="width: 30rem;">
      <tr>
        <th>Witel</th>
        <th>2P</th>
        <th>3P</th>
        <th>Total</th>
      </tr>
      @foreach($data['table_kw1'] as $val)
      <tr>
        <td>{{ $val->witel }}</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw1_nobillnousage','witel'=>$val->witel,'tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw1_nobillnousage','witel'=>$val->witel,'tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw1_nobillnousage','witel'=>$val->witel]) }}">{{ $val->c_total }}</a></td>
      </tr>
      @endforeach
      @foreach($data['grand_kw1'] as $val)
      <tr>
        <td>GRAND TOTAL</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw1_nobillnousage','tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw1_nobillnousage','tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw1_nobillnousage']) }}">{{ $val->total }}</a></td>
      </tr>
      @endforeach
    </table>
	</div>
	</div>
	
	<div class="col">
	<!-- KW-2 -->
	<div class="table-responsive">
	<h5>LIS KW-2</h5>
    <table class="table table-striped table-condensed datatable" style="width: 30rem;">
      <tr>
        <th>Witel</th>
        <th>2P</th>
        <th>3P</th>
        <th>Total</th>
      </tr>
      @foreach($data['table_kw2'] as $val)
      <tr>
        <td>{{ $val->witel }}</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw2_billnousage','witel'=>$val->witel,'tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw2_billnousage','witel'=>$val->witel,'tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw2_billnousage','witel'=>$val->witel]) }}">{{ $val->c_total }}</a></td>
      </tr>
      @endforeach
      @foreach($data['grand_kw2'] as $val)
      <tr>
        <td>GRAND TOTAL</td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw2_billnousage','tipe2p3p'=>'2P']) }}">{{ $val->a_2p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw2_billnousage','tipe2p3p'=>'3P']) }}">{{ $val->b_3p }}</a></td>
        <td><a class="nav-link" href="{{ route('admin.reporting.lis.detail',['tipe_kw'=>'kw2_billnousage']) }}">{{ $val->total }}</a></td>
      </tr>
      @endforeach
    </table>
	</div>
	</div>

</div>
@endsection

