@extends('layouts.admin')
@section('content')

<div class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
                This is HOME.
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
</script>
@endsection
