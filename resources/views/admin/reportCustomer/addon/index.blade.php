@extends('layouts.admin')
@section('content')
<div class="content">
    @include('partials.navtab')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">
                        <h4>Performansi Addon Bulanan</h4>
                    </div>                
                    <div class="card-tools" style="float: right">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-filter-periode">
                            <i class="mdi mdi-filter-variant"></i>                              
                        </a>
                    </div>  
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">    
                                    <h3 class="card-title">MINIPACK</h3>            
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th rowspan="2" class="align-middle">Last Periode <p class="last_dt"></p></th>
                                                    <th colspan="3" class="text-center">Current Periode <p class="current_dt"></p></th>
                                                    <th rowspan="2" class="align-middle">%GMoM</th>                                            
                                                </tr>
                                                <tr>
                                                    <th>Plan</th>                                           
                                                    <th>Real</th>
                                                    <th>Ach</th>                                                                                                
                                                </tr>
                                            </thead>
                                            <tbody id="minipack">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">UPGRADE SPEED</h3>                               
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th rowspan="2" class="align-middle">Last Periode <p class="last_dt"><p></th>
                                                    <th colspan="3" class="text-center">Current Periode <p class="current_dt"></p></th>
                                                    <th rowspan="2" class="align-middle">%GMoM</th>
                                                </tr>
                                                <tr>
                                                    <th>Plan</th>                                           
                                                    <th>Real</th>
                                                    <th>Ach</th>                                                                                                
                                                </tr>
                                            </thead>
                                            <tbody id="upgrade">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">    
                                    <h3 class="card-title">Mig 2P-3P</h3>            
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th rowspan="2" class="align-middle">Last Periode <p class="last_dt"></p></th>
                                                    <th colspan="3" class="text-center">Current Periode <p class="current_dt"></p></th>
                                                    <th rowspan="2" class="align-middle">%GMoM</th>
                                                </tr>
                                                <tr>
                                                    <th>Plan</th>                                           
                                                    <th>Real</th>
                                                    <th>Ach</th>                                                                                                
                                                </tr>
                                            </thead>
                                            <tbody id="mig2p3p">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">STB TAMBAHAN</h3>                               
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th rowspan="2" class="align-middle">Last Periode <p class="last_dt"></p></th>
                                                    <th colspan="3" class="text-center">Current Periode <p class="current_dt"></p></th>
                                                    <th rowspan="2" class="align-middle">%GMoM</th>
                                                </tr>
                                                <tr>
                                                    <th>Plan</th>                                           
                                                    <th>Real</th>
                                                    <th>Ach</th>                                                                                                
                                                </tr>
                                            </thead>
                                            <tbody id="stb">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">    
                                    <h3 class="card-title">Mig 1P-2P</h3>            
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th rowspan="2" class="align-middle">Last Periode <p class="last_dt"></p></th>
                                                    <th colspan="3" class="text-center">Current Periode <p class="current_dt"></p></th>
                                                    <th rowspan="2" class="align-middle">%GMoM</th>
                                                </tr>
                                                <tr>
                                                    <th>Plan</th>                                           
                                                    <th>Real</th>
                                                    <th>Ach</th>                                                                                                
                                                </tr>
                                            </thead>
                                            <tbody id="mig1p2p">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">OTT</h3>                               
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Witel</th>
                                                    <th rowspan="2" class="align-middle">Last Periode <p class="last_dt"></p></th>
                                                    <th colspan="3" class="text-center">Current Periode <p class="current_dt"></p></th>
                                                    <th rowspan="2" class="align-middle">%GMoM</th>
                                                </tr>
                                                <tr>
                                                    <th>Plan</th>                                           
                                                    <th>Real</th>
                                                    <th>Ach</th>                                                                                                
                                                </tr>
                                            </thead>
                                            <tbody id="ottvideo">
                                            
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
<!-- Modal Filter Periode-->
<div class="modal fade" id="modal-filter-periode" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-filter-periode">Filter Periode AddOn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal no-margin" id="formfilterperiode" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">     
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Last Periode</label>
                                <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="last_periode" id="last_periode">                                               
                                    @foreach ($periodes as $id => $periode)
                                    <option value="{{ $periode->bulan }}" {{ old('periode') == $periode->bulan ? 'selected' : '' }}>{{$periode->bulan}}</option>
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
<script>
$(document).ready(function(){
    load_content();

    function load_content(last_periode='') {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.performance.addon') }}',
            'data': {
                last_periode: last_periode
            },
            'success': function(data) {    

                $('.last_dt').text('(' + data.last_dt + ')');
                $('.current_dt').text('(' + data.current_dt + ')');

                $('#minipack').empty();
                $.each(data.minipack, function(index,value){    
                    var target = value.target;
                    var real_current_month = value.real_current_month;
                    var real_last_month = value.real_last_month;

                    var ach = (Math.round((real_current_month / target) * 100));
                    if (ach > 100) {
                        var lb_ach = '<label class="badge badge-success">'+ ach +'%</label>'
                    } else {
                        var lb_ach = '<label class="badge badge-danger">'+ ach +'%</label>'
                    }

                    var gmom = (Math.round(((real_current_month - real_last_month) / real_last_month) * 100));  
                    if (gmom > 0) {
                        var lb_gmom = '<text style="color: #29c0b1">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gmom = '<text style="color: #ff3366">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }   

                    $('#minipack').append(`
                    <tr>
                        <td>`+value.witel+`</td>
                        <td>`+getNumber(real_last_month)+`</td>
                        <td>`+getNumber(target)+`</td>
                        <td>`+getNumber(real_current_month)+`</td>
                        <td>`+ lb_ach +`</td>
                        <td>`+ lb_gmom +`</td>   
                    </tr>`)
                });

                $('#upgrade').empty();
                $.each(data.upgrade, function(index,value){   
                    var target = value.target;
                    var real_current_month = value.real_current_month;
                    var real_last_month = value.real_last_month;

                    var ach = (Math.round((real_current_month / target) * 100));  
                    if (ach > 100) {
                        var lb_ach = '<label class="badge badge-success">'+ ach +'%</label>'
                    } else {
                        var lb_ach = '<label class="badge badge-danger">'+ ach +'%</label>'
                    }

                    var gmom = (Math.round(((real_current_month - real_last_month) / real_last_month) * 100)); 
                    if (gmom > 0) {
                        var lb_gmom = '<text style="color: #29c0b1">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gmom = '<text style="color: #ff3366">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }    

                    $('#upgrade').append(`
                    <tr>
                        <td>`+value.witel+`</td>
                        <td>`+getNumber(real_last_month)+`</td>
                        <td>`+getNumber(target)+`</td>
                        <td>`+getNumber(real_current_month)+`</td>
                        <td>`+ lb_ach +`</td>
                        <td>`+ lb_gmom +`</td>                                                                 
                    </tr>`)
                });

                $('#mig2p3p').empty();
                $.each(data.mig2p3p, function(index,value){   
                    var target = value.target;
                    var real_current_month = value.real_current_month;
                    var real_last_month = value.real_last_month;

                    var ach = (Math.round((real_current_month / target) * 100));  
                    if (ach > 100) {
                        var lb_ach = '<label class="badge badge-success">'+ ach +'%</label>'
                    } else {
                        var lb_ach = '<label class="badge badge-danger">'+ ach +'%</label>'
                    }

                    var gmom = (Math.round(((real_current_month - real_last_month) / real_last_month) * 100)); 
                    if (gmom > 0) {
                        var lb_gmom = '<text style="color: #29c0b1">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gmom = '<text style="color: #ff3366">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }    

                    $('#mig2p3p').append(`
                    <tr>
                        <td>`+value.witel+`</td>
                        <td>`+getNumber(real_last_month)+`</td>
                        <td>`+getNumber(target)+`</td>
                        <td>`+getNumber(real_current_month)+`</td>
                        <td>`+ lb_ach +`</td>
                        <td>`+ lb_gmom +`</td>                                                                 
                    </tr>`)
                });

                $('#stb').empty();
                $.each(data.stb, function(index,value){   
                    var target = value.target;
                    var real_current_month = value.real_current_month;
                    var real_last_month = value.real_last_month;

                    var ach = (Math.round((real_current_month / target) * 100));  
                    if (ach > 100) {
                        var lb_ach = '<label class="badge badge-success">'+ ach +'%</label>'
                    } else {
                        var lb_ach = '<label class="badge badge-danger">'+ ach +'%</label>'
                    }

                    var gmom = (Math.round(((real_current_month - real_last_month) / real_last_month) * 100));  
                    if (gmom > 0) {
                        var lb_gmom = '<text style="color: #29c0b1">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gmom = '<text style="color: #ff3366">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }   

                    $('#stb').append(`
                    <tr>
                        <td>`+value.witel+`</td>
                        <td>`+getNumber(real_last_month)+`</td>
                        <td>`+getNumber(target)+`</td>
                        <td>`+getNumber(real_current_month)+`</td>
                        <td>`+ lb_ach +`</td>
                        <td>`+ lb_gmom +`</td>                                                                 
                    </tr>`)
                });

                $('#mig1p2p').empty();
                $.each(data.mig1p2p, function(index,value){   
                    var target = value.target;
                    var real_current_month = value.real_current_month;
                    var real_last_month = value.real_last_month;

                    var ach = (Math.round((real_current_month / target) * 100));  
                    if (ach > 100) {
                        var lb_ach = '<label class="badge badge-success">'+ ach +'%</label>'
                    } else {
                        var lb_ach = '<label class="badge badge-danger">'+ ach +'%</label>'
                    }

                    var gmom = (Math.round(((real_current_month - real_last_month) / real_last_month) * 100));
                    if (gmom > 0) {
                        var lb_gmom = '<text style="color: #29c0b1">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gmom = '<text style="color: #ff3366">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }     

                    $('#mig1p2p').append(`
                    <tr>
                        <td>`+value.witel+`</td>
                        <td>`+getNumber(real_last_month)+`</td>
                        <td>`+getNumber(target)+`</td>
                        <td>`+getNumber(real_current_month)+`</td>
                        <td>`+ lb_ach +`</td>
                        <td>`+ lb_gmom +`</td>                                                                 
                    </tr>`)
                });

                $('#ottvideo').empty();
                $.each(data.ottvideo, function(index,value){   
                    var target = value.target;
                    var real_current_month = value.real_current_month;
                    var real_last_month = value.real_last_month;

                    var ach = (Math.round((real_current_month / target) * 100));  
                    if (ach > 100) {
                        var lb_ach = '<label class="badge badge-success">'+ ach +'%</label>'
                    } else {
                        var lb_ach = '<label class="badge badge-danger">'+ ach +'%</label>'
                    }

                    var gmom = (Math.round(((real_current_month - real_last_month) / real_last_month) * 100));  
                    if (gmom > 0) {
                        var lb_gmom = '<text style="color: #29c0b1">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-up" style="color: #29c0b1"></i>'
                    } else {
                        var lb_gmom = '<text style="color: #ff3366">'+ gmom +'%</text>'+" "+'<i class="mdi mdi-arrow-down" style="color: #ff3366"></i>'
                    }   

                    $('#ottvideo').append(`
                    <tr>
                        <td>`+value.witel+`</td>
                        <td>`+getNumber(real_last_month)+`</td>
                        <td>`+getNumber(target)+`</td>
                        <td>`+getNumber(real_current_month)+`</td>
                        <td>`+ lb_ach +`</td>
                        <td>`+ lb_gmom +`</td>                                                                 
                    </tr>`)
                });
            }
        })
    }

    $('#applyBtn').click(function(e) {
        var last_periode = $('#last_periode').val();            
        e.preventDefault();

        load_content(last_periode);
        $('#modal-filter-periode').modal('hide'); 
        $('#minipack').empty();
        $('#upgrade').empty();
        $('#mig2p3p').empty();
        $('#stb').empty();
        $('#mig1p2p').empty();
        $('#ottvideo').empty();
        $('.last_dt').empty();
        $('.current_dt').empty();
            
    });
})
function getNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}  
</script>
@endsection