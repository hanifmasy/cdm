@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-3 grid-margin">
        <!-- Profile Image -->
        <div class="card card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('public\assets\img\icon.jpg') }}" alt="User profile picture">
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-success mt-4">
            <div class="card-header">
                <h3 class="card-title">Account Info</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong>
                    <i class="mdi mdi-phone mr-1"></i> Telephone
                </strong>
                <p></p>
                <p class="text-muted">Hp 1 : {{$customer->no_hp ? $customer->no_hp : "-"}}</p>
                <p class="text-muted">Hp 2 : {{$customer->hp_pelapor_ticket ? $customer->hp_pelapor_ticket : "-"}}</p>
                <p class="text-muted">Hp 3 : {{$customer->hp_myih ? $customer->hp_myih : "-"}}</p>    
                @foreach ($arr_nohp_pcf as $key => $no_hp)                 
                        <p class="text-muted">Hp PCF {{$key+1}} : {{$no_hp ? $no_hp : "-"}}</p>       
                @endforeach
                
                {{-- @if ($no_tlp != null)
                @foreach ($arr_tlp as $key => $item)
                <li class="text-muted">{{$item}}</li>
                @endforeach
                @elseif($customer->no_hp != null)
                <li class="text-muted">{{$customer->no_hp}}</li>
                @else
                <p class="text-muted">-</p>
                @endif --}}

                <hr>

                <strong>
                    <i class="mdi mdi-email mr-1"></i> Email
                </strong>
                <p class="text-muted">{{$customer->email ? $customer->email : "-"}}</p>

                <hr>

                <strong>
                    <i class="mdi mdi-map-marker mr-1"></i> Location
                </strong>
                <p class="text-muted">{{$customer->alamat ? $customer->alamat : "-"}}</p>

                <hr>

                <strong>
                    <i class="mdi mdi-account-card-details"></i> KContact
                </strong>
                <p class="text-muted">{{$customer->psb_kcontact ? $customer->psb_kcontact : "-"}}</p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-9 grid-margin">
        <div class="card">
            <div class="card-header p-2">
                <div class="mt-4 py-2 border-top border-bottom">
                    <ul class="nav profile-navbar">
                        <li class="nav-item">
                            <a class="nav-link active" href="#identity" data-toggle="tab">
                                <i class="mdi mdi-account-outline"></i>
                                Identity
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#addon" data-toggle="tab">
                                <i class="mdi mdi-newspaper"></i>
                                Assets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#payment" data-toggle="tab">
                                <i class="mdi mdi-cash-usd"></i>
                                Payment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#report" data-toggle="tab">
                                <i class="mdi mdi-volume-medium"></i>
                                Complaint
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#provisioning" data-toggle="tab">
                                <i class="mdi mdi-paperclip"></i>
                                Provisioning
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#status_modem" data-toggle="tab">
                                <i class="mdi mdi-package"></i>
                                Status Modem
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#usage_inet" data-toggle="tab">
                                <i class="mdi mdi-access-point-network"></i>
                                Usage Inet
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#usage_tv" data-toggle="tab">
                                <i class="mdi mdi-television"></i>
                                Usage TV
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <!-- <h4 class="card-title">Horizontal Two column</h4> -->
                <form class="form-sample">
                    <!-- <p class="card-description">
                        Personal info
                    </p> -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="identity">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No Internet</label>
                                        <input class="form-control text-black" id="notel" placeholder="ND Internet" value="{{ $customer->notel ? $customer->notel : '-'}}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No Reference</label>
                                        <input type="text" class="form-control text-black" id="nd_reference" placeholder="ND Reference" value="{{$customer->nd_reference ? $customer->nd_reference : "-"}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Witel</label>
                                        <input type="text" class="form-control text-black" id="witel" placeholder="Witel" value="{{$customer->witel_str ? $customer->witel_str : "-"}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Datel</label>
                                        <input type="text" class="form-control text-black" id="datel" placeholder="Datel" value="{{$customer->datel_str ? $customer->datel_str : "-"}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">STO</label>
                                        <input type="text" class="form-control text-black" id="sto" placeholder="STO" value="{{$customer->abrv_repart ? $customer->abrv_repart : "-"}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control text-black" id="name" placeholder="Name" value="{{$customer->nama_plggn ? $customer->nama_plggn : "-"}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tempat / Tanggal Lahir</label>
                                        <input type="text" class="form-control text-black" id="ttl" placeholder="TTL" readonly value="{{$customer->tempat_lahir ? $customer->tempat_lahir : "-"}} / {{$customer->tgl_lahir ? $customer->tgl_lahir : "-"}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Channel PSB</label>
                                        <input type="text" class="form-control text-black" id="channel_psb" value="{{$customer->psb_channel_sales ? $customer->psb_channel_sales : "-"}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Usia Berlangganan</label>
                                        <input type="text" class="form-control text-black" id="usia_berlangganan" value="{{$customer->usia_ps ? $customer->usia_ps : "-"}} Bln" placeholder="Usia Berlangganan" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input type="text" class="form-control text-black" id="status" value="{{$customer->root_status ? $customer->root_status : "-"}}" placeholder="Status" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tanggal Berlangganan</label>
                                        <input type="text" class="form-control text-black" id="tgl_berlangganan" value="{{$customer->tgl_verifikasi ? (date('d F Y', strtotime(@$customer->tgl_verifikasi))) : "-"}}" placeholder="Tanggal Berlangganan" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">STP Target</label>
                                        <input type="text" class="form-control text-black" id="stp_target" placeholder="STP Target" value="{{$customer->stp_target ? $customer->stp_target : "-"}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Speed Inet</label>
                                        <input type="text" class="form-control text-black" id="speed_inet" placeholder="Speed Inet" value="{{$customer->speed_inet ? $customer->speed_inet : '-'}} / {{ $customer->speed_pcrf ? $customer->speed_pcrf : '-' }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Jenis Indihome<b> [1P, 2P, 3P]</b></label>
                                        @if (@$customer->paket_benefit_telp != null)
                                        <div class="form-check">
                                            <input class="form-check-input" style="margin-left: 0px" type="checkbox" checked disabled>
                                            <div class="row">
                                                <div class="col-md-2 ml-4">
                                                    <text class="text-md">Telephone</text>
                                                </div>
                                                <div class="col-md-8">
                                                    <span class="badge badge badge-pill badge-info">
                                                        <text class="text-sm" style="color: white">{{$customer->paket_benefit_telp}}</text>
                                                    </span>
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <span class="badge badge-pill badge-primary">
                                                        <text class="text-sm" style="color: white">{{$customer->usage_voice ? $customer->usage_voice." Menit" : "-"}}</text>
                                                    </span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <input class="form-check-input" style="margin-left: 0px" type="checkbox" disabled="">
                                            <div class="row">
                                                <div class="col-md-2 ml-4">
                                                    <text class="text-md">Telephone</text>
                                                </div>
                                                <div class="col-md-8">
                                                    <span class="badge badge badge-pill badge-info">
                                                        <text class="text-sm" style="color: white"></text>
                                                    </span>
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <span class="badge badge-pill badge-primary">
                                                        <text class="text-sm" style="color: white"></text>
                                                    </span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        @endif

                                        @if (@$customer->paket_inet != null)
                                        <div class="form-check">
                                            <input class="form-check-input" style="margin-left: 0px" type="checkbox" checked disabled>
                                            <div class="row">
                                                <div class="col-md-2 ml-4">
                                                    <text class="text-md">Internet</text>
                                                </div>
                                                <div class="col-md-8">
                                                    <span class="badge badge badge-pill badge-info">
                                                        <text class="text-sm" style="color: white">{{$customer->paket_inet}}</text>
                                                    </span>
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <span class="badge badge badge-pill badge-primary">
                                                        <text class="text-sm" style="color: white">{{$customer->usage_inet ? $customer->usage_inet." KB" : "-"}}</text>
                                                    </span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <input class="form-check-input" style="margin-left: 0px" type="checkbox" disabled="">
                                            <div class="row">
                                                <div class="col-md-2 ml-4">
                                                    <text class="text-md">Internet</text>
                                                </div>
                                                <div class="col-md-8">
                                                    <span class="badge badge badge-pill badge-info">
                                                        <text class="text-sm" style="color: white"></text>
                                                    </span>
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <span class="badge badge badge-pill badge-primary">
                                                        <text class="text-sm" style="color: white"></text>
                                                    </span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        @endif

                                        @if (@$customer->jenis_useetv != null)
                                        <div class="form-check">
                                            <input class="form-check-input" style="margin-left: 0px" type="checkbox" checked disabled>
                                            <div class="row">
                                                <div class="col-md-2 ml-4">
                                                    <text class="text-md">UseeTV</text>
                                                </div>
                                                <div class="col-md-8">
                                                    <span class="badge badge badge-pill badge-info">
                                                        <text class="text-sm" style="color: white">{{$customer->jenis_useetv}}</text>
                                                    </span>
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <span class="badge badge badge-pill badge-primary">
                                                        <text class="text-sm" style="color: white">{{$customer->usage_tv ? $customer->usage_tv." Menit" : "-"}}</text>
                                                    </span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <input class="form-check-input" style="margin-left: 0px" type="checkbox" disabled="">
                                            <div class="row">
                                                <div class="col-md-2 ml-4">
                                                    <text class="text-md">UseeTV</text>
                                                </div>
                                                <div class="col-md-8" hidden>
                                                    <span class="badge badge badge-pill badge-info">
                                                        <text class="text-sm" style="color: white"></text>
                                                    </span>
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <span class="badge badge badge-pill badge-primary">
                                                        <text class="text-sm" style="color: white"></text>
                                                    </span>
                                                </div> --}}                                                
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="addon">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Main Asset</h3>
                                    <div class="card-tools">
                                        <button type="button" style="padding-top:15px" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-secondary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Internet</h3>
                                                    <div class="card-tools">
                                                        <button type="button" style="padding-top:15px" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(@$customer->paket_inet != null)
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{$customer->paket_inet}}</td>
                                                                    <td>{{"Rp. ".number_format($customer->tarif_inet,0,",",".")}}</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">UseeTV</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (@$customer->desc_stb != null)
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{$customer->desc_stb}}</td>
                                                                    <td>{{"Rp. ".number_format($customer->tarif_stb,0,",",".")}}</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">POTS</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (@$customer->akses_jaringan_voice != null)
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{$customer->akses_jaringan_voice}}</td>
                                                                    <td>{{"Rp. ".number_format($customer->tarif_abo_voice,0,",",".")}}</td>
                                                                </tr>
                                                                @endif
                                                                @if (@$customer->paket_benefit_telp != null)
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>{{$customer->paket_benefit_telp}}</td>
                                                                    <td>{{"Rp. ".number_format($customer->tarif_benefit_telp,0,",",".")}}</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-default mt-4">
                                <div class="card-header">
                                    <h3 class="card-title">Addon Asset</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (@$customer->minipack != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">Minipack</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->                                                
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($arr_minipack as $key => $value)
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td>{{$value}}</td>
                                                                    <td>-</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if (@$customer->plc != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">PLC</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th width="70%">Nama Produk</th>
                                                                    <th width="20%">Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($arr_plc as $key => $value)
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td width="70%">{{$value}}</td>
                                                                    <td width="20%">-</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if (@$customer->wifi_ext != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">Wifi Extender</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th width="70%">Nama Produk</th>
                                                                    <th width="20%">Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($arr_wifiExt as $key => $value)
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td width="70%">{{$value}}</td>
                                                                    <td width="20%">-</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if (@$customer->ket_utv != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">UTV</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th width="70%">Nama Produk</th>
                                                                    <th width="20%">Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td width="70%">{{$customer->ket_utv}}</td>
                                                                    <td width="20%">-</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if (@$customer->ih_smart != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">IH Smart</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th width="70%">Nama Produk</th>
                                                                    <th width="20%">Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td width="70%">{{$customer->ket_utv}}</td>
                                                                    <td width="20%">-</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if (@$customer->movin_seamless != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">Movin Seamless</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th width="70%">Nama Produk</th>
                                                                    <th width="20%">Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($arr_movinSeamless as $key => $value)
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td width="70%">{{$value}}</td>
                                                                    <td width="20%">-</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if (@$customer->homewifi_brite != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">Homewifi Brite</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th width="70%">Nama Produk</th>
                                                                    <th width="20%">Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td width="70%">{{$customer->homewifi_brite}}</td>
                                                                    <td width="20%">-</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if (@$customer->desc_stb != null)
                                            <div class="card card-secondary mt-3">
                                                <div class="card-header">
                                                    <h3 class="card-title">Set Top Box</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" style="padding-top:15px" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th width="70%">Nama Produk</th>
                                                                    <th width="20%">Biaya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td width="70%">{{$customer->desc_stb}}</td>
                                                                    <td width="20%">-</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="payment">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Bulan Tagihan</label>
                                        <div class="col-sm-6">
                                            <span class="badge badge-danger"><text class="text-sm" style="color: white">{{$customer->nper ? (date('F Y', strtotime($customer->nper))) : "-"}}</text></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                        <div class="col-sm-6">
                                            <span class="badge badge-danger"><text class="text-sm" style="color: white">{{$customer->payment_date ? (date('d F Y', strtotime($customer->payment_date))) : "-"}}</text></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Loket Pembayaran</label>
                                        <div class="col-sm-6">
                                            <span class="badge badge-secondary"><text class="text-sm" style="color: white">{{$customer->l_bank ? $customer->l_bank : "-"}}</text></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Total Tagihan</label>
                                        <div class="col-sm-6">
                                            <span class="badge badge-danger"><text class="text-sm" style="color: white">{{$total_bill ? "Rp. ".number_format($total_bill,0,",",".") : "-"}}</text></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Total Pembayaran</label>
                                        <div class="col-sm-6">
                                            <span class="badge badge-success"><text class="text-sm" style="color: white">{{$total_payment ? "Rp. ".number_format($total_payment,0,",",".") : "-"}}</text></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-6">
                                            @if ($status == "Lunas")
                                            <span class="badge badge-info"><text class="text-sm" style="color: white">{{$status}}</text></span>
                                            @else
                                            <span class="badge badge-danger"><text class="text-sm" style="color: white">{{$status}}</text></span>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="report">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Tanggal Report</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control text-black" id="tgl_report" placeholder="Tanggal Report" value="{{$customer->timestamps_status ? (date('d F Y', strtotime($customer->timestamps_status))) : "-"}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Status Report</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control text-black" id="status_report" placeholder="Status Report" value="{{$customer->status_gangguan ? $customer->status_gangguan : "-"}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Nama Pelapor</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control text-black" id="nama_pelapor" placeholder="Nama Pelapor" value="{{$customer->nama_pelapor ? $customer->nama_pelapor : "-"}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Email Pelapor</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control text-black" id="email_pelapor" placeholder="Email Pelapor" value="{{$customer->email_pelapor ? $customer->email_pelapor : "-"}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Contact Pelapor</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control text-black" id="cp_pelapor" placeholder="Contact Pelapor" value="{{$customer->cp_pelapor ? $customer->cp_pelapor : "-"}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Penyebab Gangguan</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control text-black" id="penyebab_gangguan" readonly placeholder="Penyebab Gangguan">{{$customer->ticket_penyebab_ggn ? $customer->ticket_penyebab_ggn : "-"}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Analisis HD</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control text-black" id="solusi" readonly placeholder="Solusi">{{$customer->ticket_solusi != null ? $customer->ticket_solusi : "-"}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="provisioning">
                            <form class="form-horizontal">
                                <div class="card-body">

                                    <div class="col-md-12">
                                        <div class="row">
                                            <label for="">Status Order</label>
                                        </div>
                                        <div class="row">
                                            <span class="badge badge-success"><text class="text-sm" style="color: white">{{$customer->orderactivities_status ? $customer->orderactivities_status : "-"}}</text></span>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nomer Order Baru </label>
                                                <input type="text" class="form-control text-black" id="neworder_nomor_sc" placeholder="Nomer Order Baru" value="{{$customer->neworder_nomor_sc ? $customer->neworder_nomor_sc : "-"}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Inputter Order Baru </label>
                                                <input type="text" class="form-control text-black" id="neworder_inputter" placeholder="Inputter Order Baru" value="{{$customer->neworder_inputter ? $customer->neworder_inputter : "-"}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Tanggal Order Baru</label>
                                                <input type="text" class="form-control text-black" id="neworder_created" placeholder="ND Reference" value="{{$customer->neworder_createdtm ? (date('d F Y', strtotime(@$customer->neworder_createdtm))) : "-"}}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Type Addon</label>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="">Type Indihome</label>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="">Product Desc</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            @if ($customer->neworder_typeaddon != null)
                                            <ul>
                                                @foreach ($arr_newTypeAddon as $key => $value)
                                                <li>{{$key+1}}. {{$value}}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            @if ($customer->neworder_typeindihome != null)
                                            <ul>
                                                @foreach ($arr_newTypeIndihome as $key => $value)
                                                <li>{{$key+1}}. {{$value}}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            @if ($customer->neworder_product_desc != null)
                                            <ul>
                                                @foreach ($arr_newProductDesc as $key => $value)
                                                <li>{{$key+1}}. {{$value}}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="status_modem">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Tanggal Update</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Waktu Update</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <span class="badge badge-secondary"><text class="text-sm" style="color: white">{{$customer->alpro_dataupdate ? (date('d F Y', strtotime($customer->alpro_dataupdate))) : "-"}}</text></span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="badge badge-secondary"><text class="text-sm" style="color: white">{{$customer->alpro_dataupdate ? (date('H:i:s', strtotime($customer->alpro_dataupdate))) : "-"}}</text></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Status Modem</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Status Ukur</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Receive Daya</label>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (@$customer->alpro_onustatus == "ONLINE")
                                    <div class="col-md-3">
                                        <span class="badge badge-pill badge-success" style="font-size: 13px">{{$customer->alpro_onustatus ? $customer->alpro_onustatus : "-"}}</span>
                                    </div>
                                    @elseif (@$customer->alpro_onustatus == "OFFLINE")
                                    <div class="col-md-3">
                                        <span class="badge badge-pill badge-danger" style="font-size: 13px">{{$customer->alpro_onustatus ? $customer->alpro_onustatus : "-"}}</span>
                                    </div>
                                    @else
                                    <div class="col-md-3">
                                        <span class="badge badge-pill badge-warning" style="font-size: 13px; font-color: white">{{$customer->alpro_onustatus ? $customer->alpro_onustatus : "-"}}</span>
                                    </div>
                                    @endif
                                    @if (@$customer->alpro_statusukur == "OK")
                                    <div class="col-md-3">
                                        <span class="badge badge-pill badge-success" style="font-size: 13px">{{$customer->alpro_statusukur ? $customer->alpro_statusukur : "-"}}</span>
                                    </div>
                                    @else
                                    <div class="col-md-3">
                                        <span class="badge badge-pill badge-danger" style="font-size: 13px">{{$customer->alpro_statusukur ? $customer->alpro_statusukur : "-"}}</span>
                                    </div>
                                    @endif
                                    <div class="col-md-3">
                                        <span class="badge badge-pill badge-info" style="font-size: 13px">{{$customer->alpro_rxpoweronu ? $customer->alpro_rxpoweronu. " dBm" : "-"}}</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">Nama GPON</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control text-black" id="status_report" placeholder="Nama GPON" value="{{$customer->alpro_gpon ? $customer->alpro_gpon : "-"}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Port</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control text-black" id="port" placeholder="Port" value="{{$customer->alpro_portolt ? $customer->alpro_portolt : "-"}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control text-black" id="modem_type" placeholder="Type Modem" value="{{$customer->alpro_onutype ? $customer->alpro_onutype : "-"}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Serial Number</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control text-black" id="modem_sn" placeholder="Serial Number Modem" value="{{$customer->alpro_onusn ? $customer->alpro_onusn : "-"}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="usage_inet">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Inet NCX</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control text-black" id="inet_ncx" placeholder="Inet NCX" value="{{$customer->speed_inet ? $customer->speed_inet : "-"}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Inet PCRF</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control text-black" id="inet_pcrf" placeholder="Inet PCRF" value="{{$customer->packet_inet_pcrf ? $customer->packet_inet_pcrf : "-"}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Speed Inet</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control text-black" id="speed_inet" placeholder="Speed Inet" value="{{$customer->speed_pcrf ? $customer->speed_pcrf : "-"}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kuota Inet</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control text-black" id="kuota_inet" placeholder="Kuota Inet" value="{{$customer->kuota_speed_ncx ? $customer->kuota_speed_ncx : "-"}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-5 col-form-label">Usage Current Month</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control text-black" id="usage_inet_current_month" placeholder="Usage Current Month" value="{{$customer->usage_inet_current_month ? $customer->usage_inet_current_month : "-"}} GB" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-5 col-form-label">Usage Last Month</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control text-black" id="usage_inet_last_month" placeholder="Usage Last Month" value="{{$customer->usage_inet_last_month ? $customer->usage_inet_last_month : "-"}} GB" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Update DateTime Current Month</label>
                                                <input class="form-control" id="update_date_inet_current_month" placeholder="Update Date Current Month" value="{{ $customer->usage_inet_timestamp_curr ? $customer->usage_inet_timestamp_curr : '-'}}" readonly>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Update DateTime Last Month</label>
                                                <input type="text" class="form-control text-black" id="update_date_inet_last_month" placeholder="Update Date Last Month" value="{{$customer->usage_inet_timestamp_lastm ? $customer->usage_inet_timestamp_lastm : "-"}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="usage_tv">
                            <form class="form-horizontal">
                                <div class="card-body">                                                                                                               
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Total ganti Channel Bulan ini</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control text-center text-black" id="total_ganti_channel_current_month" placeholder="Total Ganti Channel Current Month" value="{{ $customer->usage_tv_channel_current_month ? $customer->usage_tv_channel_current_month : '-'}} x" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Total ganti Channel Bulan kemarin</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control text-center text-black" id="total_ganti_channel_last_month" placeholder="Total Ganti Channel Last Month" value="{{$customer->usage_tv_channel_last_month ? $customer->usage_tv_channel_last_month : "-"}} x" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Total penggunaan TV Bulan ini</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control text-center text-black" id="total_penggunaan_tv_current_month" placeholder="Total Penggunaan TV Current Month" value="{{ $customer->usage_tv_current_month ? $customer->usage_tv_current_month : '-'}} day" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Total penggunaan TV Bulan kemarin</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control text-center text-black" id="total_penggunaan_tv_last_month" placeholder="Total Penggunaan TV Last Month" value="{{$customer->usage_tv_last_month ? $customer->usage_tv_last_month : "-"}} day" readonly>
                                        </div>
                                    </div>
                                    <br>                                  
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Update DateTime Bulan ini</label>
                                        <div class="col-sm-4">
                                            <input class="form-control text-black" id="update_date_tv_current_month" placeholder="Update Date Current Month" value="{{ $customer->usage_tv_timestamp_curr ? $customer->usage_tv_timestamp_curr : '-'}}"readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Update DateTime Bulan kemarin</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control text-black" id="update_date_tv_last_month" placeholder="Update Date Last Month" value="{{$customer->usage_tv_timestamp_lastm ? $customer->usage_tv_timestamp_lastm : "-"}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
@endsection