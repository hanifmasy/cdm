@extends('layouts.admin')
@section('content')

<div class="col-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cari Data Pelanggan TREG6</h4>
            <form id="filterPerform" type="POST" action="{{url('admin/masterData/show')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                        {{-- <label for="exampleInputName1">Cari Data Pelanggan</label> --}}
                            <input class="form-control" type="text" name="notel" id="notel" placeholder="Masukkan No Inet">
                        </div>
                    </div>
                    <div class="col-md-3 mt-1">
                        <button type="submit" class="btn btn-primary mr-2">Search</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
@endsection