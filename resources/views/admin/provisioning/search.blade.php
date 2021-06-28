@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Provisioning</h4>
    </div>

    <div class="card-body">
        @if (isset($data)) 
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">                               
                    <table class="table table-bordered table-striped">                    
                        <tbody>
                            <tr>
                                <th>Order ID</th>
                                <td>{{$data->order_id ? $data->order_id : "-"}}</td>
                            </tr>    
                            <tr>
                                <th>No Inet</th>
                                <td>{{$data->internet ? $data->internet : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>POTS</th>
                                <td>{{$data->pots ? $data->pots : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>Customer Desc</th>
                                <td>{{$data->customer_desc ? $data->customer_desc : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>Create User ID</th>
                                <td>{{$data->create_user_id ? $data->create_user_id : "-"}}</td>
                            </tr>                             
                            <tr>
                                <th>No HP</th>
                                <td>{{$data->no_hp ? $data->no_hp : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>Witel</th>
                                <td>{{$data->witel_master ? $data->witel_master : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>STO</th>
                                <td>{{$data->sto_str ? $data->sto_str : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>Segmen</th>
                                <td>{{$data->segmen ? $data->segmen : "-" }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pelanggan</th>
                                <td>{{$data->plclbl_trems ? $data->plclbl_trems : "-" }}</td>
                            </tr>
                            <tr>
                                <th>CCAT</th>
                                <td>{{$data->ccat ? $data->ccat : "-"}}</td>
                            </tr>
                            <tr>
                                <th>LCAT</th>
                                <td>{{$data->lcat_name ? $data->lcat_name : "-"}}</td>
                            </tr>
                            <tr>
                                <th>Item</th>
                                <td>{{$data->item ? $data->item : "-"}}</td>
                            </tr>                                                   
                        </tbody>
                    </table>                                      
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">                               
                    <table class="table table-bordered table-striped">                    
                        <tbody>
                            <tr>
                                <th>Status Order</th>
                                <td>{{$data->status_order ? $data->status_order : "-" }}</td>
                            </tr>
                            <tr>
                                <th>KContact</th>                                
                                <td>
                                    <div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;width:100px" data-toggle="tooltip" title="{{$data->kcontact ? $data->kcontact : "-" }}">{{$data->kcontact ? $data->kcontact : "-" }}</div>
                                </td>
                            </tr>                           
                            <tr>
                                <th>Latitude</th>
                                <td>{{$data->latitude ? $data->latitude : "-"}}</td>
                            </tr>
                            <tr>
                                <th>Longitude</th>
                                <td>{{$data->longitude ? $data->longitude : "-"}}</td>
                            </tr>
                            <tr>
                                <th>Minipack</th>
                                <td>{{$data->minipack ? $data->minipack : "-"}}</td>
                            </tr>
                            <tr>
                                <th>Upgrade</th>
                                <td>{{$data->upgrade ? $data->upgrade : "-"}}</td>
                            </tr>
                            <tr>
                                <th>Mig2P3P</th>
                                <td>{{$data->mig2p3p ? $data->mig2p3p : "-"}}</td>
                            </tr>
                            <tr>
                                <th>STB Tambahan</th>
                                <td>{{$data->stb_tambahan ? $data->stb_tambahan : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>PLC</th>
                                <td>{{$data->plc ? $data->plc : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>Durasi</th>
                                <td>{{$data->durasijam ? $data->durasijam . " jam" : "-"}}</td>
                            </tr>  
                            <tr>
                                <th>Speed Before</th>
                                <td>{{$data->speed_before ? $data->speed_before . " Mbps" : "-"}}</td>
                            </tr>  
                            <tr>
                                <th>Speed Request</th>
                                <td>{{$data->speed_req ? $data->speed_req . " Mbps" : "-"}}</td>
                            </tr>  
                            <tr>
                                <th>Create Date</th>
                                <td>{{$data->create_dtm ? $data->create_dtm : "-"}}</td>
                            </tr>   
                            <tr>
                                <th>Status Update</th>
                                <td>{{$data->update_dtm ? $data->update_dtm : "-"}}</td>
                            </tr> 
                        </tbody>
                    </table>                                      
                </div>
            </div>
        </div>
        @else
        <div class="row d-flex justify-content-center">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Data not found !!!</h4>
                <p>Data yang anda cari tidak dapat ditemukan oleh sistem kami. Silahkan Input Order ID atau No. Internet lainnya</p>
                <hr>                
            </div>
        </div>
        @endif

        <div class="form-group text-center mt-3">
            <a style="color: white" class="btn btn-secondary" href="{{ route('admin.performance.provisioning') }}">
                <i class="mdi mdi-chevron-left">Kembali</i>
            </a>
        </div>
    </div>  
</div>
@endsection


