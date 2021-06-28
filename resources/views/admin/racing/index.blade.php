@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div style="float: left">
                    <h4>Racing SVM</h4>
                </div>                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">    
                                <h3 class="card-title">{{$dt_bln['dt_bln1']}}</h3>            
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>                                                
                                                <th rowspan="2" class="align-middle">Rank</th>
                                                <th rowspan="2" class="align-middle">Witel</th>                                                
                                                <th colspan="5" class="text-center">SVM</th>
                                                <th rowspan="2" class="align-middle">Total <br><br>PSB</th>                                            
                                                <th rowspan="2" class="align-middle">Score</th>                                            
                                            </tr>
                                            <tr>
                                                <th class="text-center">Fraud</th>                                           
                                                <th class="text-center">Null</th>                                           
                                                <th class="text-center">0</th>
                                                <th class="text-center">1</th>     
                                                <th class="text-center">2</th>                                                                                                
                                            </tr>
                                        </thead>
                                        <tbody id="racing1">
                                            @foreach($racing1 as $index => $val)
                                            <tr>                                                                                                                                           
                                                <td><b>{{$index+1}}</b></td>                                                                               
                                                <td><b>{{$val->witel}}</b></td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'fraud')}}">
                                                    {{number_format($val->svmfraud, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'NULL')}}">
                                                    {{number_format($val->svmnull, 0, ',', '.')}}</a>
                                                </td>
                                                <td>                                                   
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 0)}}">
                                                        {{number_format($val->svm0, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 1)}}">
                                                        {{number_format($val->svm1, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 2)}}">
                                                        {{number_format($val->svm2, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'ALL')}}">
                                                        {{number_format($val->totalpsb, 0, ',', '.')}}</a>
                                                </td>
                                                @if ($index === 0)
                                                    <td><label class="badge badge-success">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 1)
                                                    <td><label class="badge badge-info">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 2)
                                                    <td><label class="badge badge-warning">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @else
                                                    <td><label class="badge badge-danger">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @endif                                                
                                            </tr> 
                                            @endforeach                                                                                      
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{$dt_bln['dt_bln2']}}</h3>            
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="align-middle">Rank</th>
                                                <th rowspan="2" class="align-middle">Witel</th>                                                
                                                <th colspan="5" class="text-center">SVM</th>
                                                <th rowspan="2" class="align-middle">Total <br><br>PSB</th></th>
                                                <th rowspan="2" class="align-middle">Score</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Fraud</th>                                           
                                                <th class="text-center">Null</th>                                           
                                                <th class="text-center">0</th>
                                                <th class="text-center">1</th>     
                                                <th class="text-center">2</th>                                                                                             
                                            </tr>
                                        </thead>
                                        <tbody id="racing2">
                                            @foreach($racing2 as $index => $val)
                                            <tr>                                               
                                                <td><b>{{$index+1}}</b></td>                                                                               
                                                <td><b>{{$val->witel}}</b></td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'fraud')}}">
                                                    {{number_format($val->svmfraud, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'NULL')}}">
                                                    {{number_format($val->svmnull, 0, ',', '.')}}</a>
                                                </td>
                                                <td>                                                   
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 0)}}">
                                                        {{number_format($val->svm0, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 1)}}">
                                                        {{number_format($val->svm1, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 2)}}">
                                                        {{number_format($val->svm2, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'ALL')}}">
                                                        {{number_format($val->totalpsb, 0, ',', '.')}}</a>
                                                </td>
                                                @if ($index === 0)
                                                    <td><label class="badge badge-success">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 1)
                                                    <td><label class="badge badge-info">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 2)
                                                    <td><label class="badge badge-warning">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @else
                                                    <td><label class="badge badge-danger">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @endif  
                                            </tr> 
                                            @endforeach     
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
                                <h3 class="card-title">{{$dt_bln['dt_bln3']}}</h3>            
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="align-middle">Rank</th>
                                                <th rowspan="2" class="align-middle">Witel</th>                                                
                                                <th colspan="5" class="text-center">SVM</th>
                                                <th rowspan="2" class="align-middle">Total <br><br>PSB</th></th>
                                                <th rowspan="2" class="align-middle">Score</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Fraud</th>   
                                                <th class="text-center">Null</th>                                           
                                                <th class="text-center">0</th>
                                                <th class="text-center">1</th>     
                                                <th class="text-center">2</th>                                                                                             
                                            </tr>
                                        </thead>
                                        <tbody id="racing3">
                                            @foreach($racing3 as $index => $val)
                                            <tr>                                               
                                                <td><b>{{$index+1}}</b></td>                                                                               
                                                <td><b>{{$val->witel}}</b></td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'fraud')}}">
                                                    {{number_format($val->svmfraud, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'NULL')}}">
                                                    {{number_format($val->svmnull, 0, ',', '.')}}</a>
                                                </td>
                                                <td>                                                   
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 0)}}">
                                                        {{number_format($val->svm0, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 1)}}">
                                                        {{number_format($val->svm1, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 2)}}">
                                                        {{number_format($val->svm2, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'ALL')}}">
                                                        {{number_format($val->totalpsb, 0, ',', '.')}}</a>
                                                </td>
                                                @if ($index === 0)
                                                    <td><label class="badge badge-success">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 1)
                                                    <td><label class="badge badge-info">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 2)
                                                    <td><label class="badge badge-warning">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @else
                                                    <td><label class="badge badge-danger">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @endif  
                                            </tr> 
                                            @endforeach     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{$dt_bln['dt_bln4']}}</h3>            
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="align-middle">Rank</th>
                                                <th rowspan="2" class="align-middle">Witel</th>                                                
                                                <th colspan="5" class="text-center">SVM</th>
                                                <th rowspan="2" class="align-middle">Total <br><br>PSB</th></th>
                                                <th rowspan="2" class="align-middle">Score</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Fraud</th>  
                                                <th class="text-center">Null</th>                                           
                                                <th class="text-center">0</th>
                                                <th class="text-center">1</th>     
                                                <th class="text-center">2</th>                                                                                               
                                            </tr>
                                        </thead>
                                        <tbody id="racing4">
                                            @foreach($racing4 as $index => $val)
                                            <tr>                                               
                                                <td><b>{{$index+1}}</b></td>                                                                               
                                                <td><b>{{$val->witel}}</b></td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'fraud')}}">
                                                    {{number_format($val->svmfraud, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'NULL')}}">
                                                    {{number_format($val->svmnull, 0, ',', '.')}}</a>
                                                </td>
                                                <td>                                                   
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 0)}}">
                                                        {{number_format($val->svm0, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 1)}}">
                                                        {{number_format($val->svm1, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 2)}}">
                                                        {{number_format($val->svm2, 0, ',', '.')}}</a>
                                                </td>
                                                <td>
                                                    <a style="color: black" href="{{url('admin/performance/show/racing_mic/' . $val->blnpsb . '/'. $val->witel . '/' . 'ALL')}}">
                                                        {{number_format($val->totalpsb, 0, ',', '.')}}</a>
                                                </td>
                                                @if ($index === 0)
                                                    <td><label class="badge badge-success">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 1)
                                                    <td><label class="badge badge-info">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @elseif ($index === 2)
                                                    <td><label class="badge badge-warning">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @else
                                                    <td><label class="badge badge-danger">{{number_format((float)$val->skor,2,'.','')}}</label></td>
                                                @endif  
                                            </tr> 
                                            @endforeach     
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
@endsection
@section('scripts')
@parent
@endsection