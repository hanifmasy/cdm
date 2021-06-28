@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Provisioning Plasa</h4>
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
                                <th>Witel</th>
                                <td>{{$data->witel_str ? $data->witel_str : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>STO</th>
                                <td>{{$data->sto ? $data->sto : "-"}}</td>
                            </tr> 
                            <tr>
                                <th>Segmen</th>
                                <td>{{$data->segmen ? $data->segmen : "-" }}</td>
                            </tr>                                                       
                            <tr>
                                <th>LCAT</th>
                                <td>{{$data->lcat ? $data->lcat : "-"}}</td>
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
                                <th>Item</th>
                                <td>{{$data->item ? $data->item : "-"}}</td>
                            </tr>                                                      
                            <tr>
                                <th>Order Type ID</th>
                                <td>{{$data->order_type_id ? $data->order_type_id : "-"}}</td>
                            </tr>  
                            <tr>
                                <th>Durasi</th>
                                <td>{{$data->durasijam ? $data->durasijam . " jam" : "-"}}</td>
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
            <a style="color: white" class="btn btn-secondary" href="{{ route('admin.performance.provisioning_plasa') }}">
                <i class="mdi mdi-chevron-left">Kembali</i>
            </a>
        </div>
    </div>  
</div>
@endsection


