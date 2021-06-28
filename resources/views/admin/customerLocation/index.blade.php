@extends('layouts.admin')
@section('styles')
<style>
  #map {
    height: 90vh;        
    width: 100%;        
  }
  #legend {
    font-family: Arial, sans-serif;
    background: #fff;
    padding: 10px;
    margin: 10px;
    border: 3px solid #000;
  }
  #legend h4 {
    margin-top: 0;
  }
  #legend img {
    vertical-align: middle;
  }
</style>
@endsection

@section('content')
  <div class="col-md-12">
      <div id="map"></div>
      <div id="search-radius" style="display: none;"></div>
      <div id="legend" style="display: none;"></div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modal-filter-map" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Filter Map</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal no-margin" id="formfiltermap" action="#" method="post" enctype="multipart/form-data">
            <div>
              <h3>Step 1</h3>
              <section>
                {{-- <h3>Step 1</h3> --}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Witel</label>                          
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2" multiple="multiple" name="witel" id="witel" style="width:100%;">                                                             
                            @foreach($witels as $id => $witel)                                    
                            <option value="{{ $witel->nama_witel }}" {{ old('witel') == $witel->nama_witel ? 'selected' : '' }}>{{$witel->nama_witel}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Type Map</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="typeMap" id="typeMap" style="width:100%;">                                                         
                            @foreach($type_maps as $typeMap)                                    
                            <option value="{{ $typeMap }}" {{ old('typeMap') == $typeMap ? 'selected' : '' }}>{{$typeMap}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                </div>
              </section>
              <h3>Step 2</h3>
              <section>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Customer</label> 
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                         
                        <select onclick="getSegmen()" class="form-control select2" multiple="multiple" name="segmen" id="segmen" style="width:100%;">                                                                                       
                            @foreach($segmens as $segmen)                                    
                            <option value="{{ $segmen }}" {{ old('cluster') == $segmen ? 'selected' : '' }}>{{str_replace('_', ' ', $segmen)}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Unspec</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="unspec" id="unspec" style="width:100%;">                                                         
                            @foreach($unspecs as $unspec)                                    
                            <option value="{{ $unspec }}" {{ old('unspec') == $unspec ? 'selected' : '' }}>{{$unspec}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">NPS</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="nps" id="nps" style="width:100%;">                                                         
                            @foreach($npss as $nps)                                    
                            <option value="{{ $nps }}" {{ old('nps') == $nps ? 'selected' : '' }}>{{ str_replace('_', ' ', $nps) }}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Status Gangguan</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="gangguan" id="gangguan" style="width:100%;">                                                         
                            @foreach($gangguans as $gangguan)                                    
                            <option value="{{ $gangguan }}" {{ old('gangguan') == $gangguan ? 'selected' : '' }}>{{ str_replace('_', ' ', $gangguan) }}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Channel Bayar</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="channel_bayar" id="channel_bayar" style="width:100%;">                                                         
                            @foreach($channel_bayars as $channel_bayar)                                    
                            <option value="{{ $channel_bayar }}" {{ old('channel_bayar') == $channel_bayar ? 'selected' : '' }}>{{ str_replace('_', ' ', $channel_bayar) }}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Minipack</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="minipack" id="minipack" style="width:100%;">                                                         
                            @foreach($minipacks as $minipack)                                    
                            <option value="{{ $minipack }}" {{ old('minipack') == $minipack ? 'selected' : '' }}>{{$minipack}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">STB Tambahan</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="stb" id="stb" style="width:100%;">                                                         
                            @foreach($stbs as $stb)                                    
                            <option value="{{ $stb }}" {{ old('stb') == $stb ? 'selected' : '' }}>{{$stb}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                </div>
              </section>
              <h3>Step 3</h3>
              <section>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Customer</label> 
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                         
                        <select class="form-control select2" multiple="multiple" name="segmen_v2" id="segmen_v2" style="width:100%;">                                                                                       
                            @foreach($segmens as $segmen)                                    
                            <option value="{{ $segmen }}" {{ old('cluster') == $segmen ? 'selected' : '' }}>{{str_replace('_', ' ', $segmen)}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Unspec</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="unspec_v2" id="unspec_v2" style="width:100%;">                                                         
                            @foreach($unspecs as $unspec)                                    
                            <option value="{{ $unspec }}" {{ old('unspec') == $unspec ? 'selected' : '' }}>{{$unspec}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">NPS</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="nps_v2" id="nps_v2" style="width:100%;">                                                         
                            @foreach($npss as $nps)                                    
                            <option value="{{ $nps }}" {{ old('nps') == $nps ? 'selected' : '' }}>{{ str_replace('_', ' ', $nps) }}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Status Gangguan</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="gangguan_v2" id="gangguan_v2" style="width:100%;">                                                         
                            @foreach($gangguans as $gangguan)                                    
                            <option value="{{ $gangguan }}" {{ old('gangguan') == $gangguan ? 'selected' : '' }}>{{ str_replace('_', ' ', $gangguan) }}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Channel Bayar</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="channel_bayar_v2" id="channel_bayar_v2" style="width:100%;">                                                         
                            @foreach($channel_bayars as $channel_bayar)                                    
                            <option value="{{ $channel_bayar }}" {{ old('channel_bayar') == $channel_bayar ? 'selected' : '' }}>{{ str_replace('_', ' ', $channel_bayar) }}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Minipack</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="minipack_v2" id="minipack_v2" style="width:100%;">                                                         
                            @foreach($minipacks as $minipack)                                    
                            <option value="{{ $minipack }}" {{ old('minipack') == $minipack ? 'selected' : '' }}>{{$minipack}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">STB Tambahan</label>
                        <div style="padding-bottom: 4px">
                          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                          <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>                          
                        <select class="form-control select2" multiple="multiple" name="stb_v2" id="stb_v2" style="width:100%;">                                                         
                            @foreach($stbs as $stb)                                    
                            <option value="{{ $stb }}" {{ old('stb') == $stb ? 'selected' : '' }}>{{$stb}}</option>
                            @endforeach
                        </select>                                                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                </div>
              </section>
            </div>
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="applyBtn">
            <span>Apply</span>
          </button>
        </div> --}}
      </div>
    </div>
  </div>
  <!-- End Modal -->
@endsection

@section('scripts')
<script src="{{ asset('public/js/main.js') }}"></script>
<script src="{{ asset('public/js/measuretool.min.js') }}"></script>
<script src="{{ asset('public/js/custom-blockui.js') }}"></script>
<script src="{{ asset('public/js/jquery.blockui.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGTv7qRwxDV6-bOGhFpIr6w2i6if1fyCA&libraries=geometry" defer></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script>
      var latLng = "";

      var reqObjVal = {
        witelSelected_val: [],
        typeMapSelected_val: [],
      }

      var colorObjVal = {
          segmenSelected_val: [],
          unspecSelected_val: [],
          npsSelected_val: [],
          gangguanSelected_val: [],
          clbayarSelected_val: [],
          minipackSelected_val: [],
          stbSelected_val: [],
          warna_val: [],
      };

      var labelObjVal = {
        segmenSelected_val_v2: [],
        unspecSelected_val_v2: [],
        npsSelected_val_v2: [],
        gangguanSelected_val_v2: [],
        clbayarSelected_val_v2: [],
        minipackSelected_val_v2: [],
        stbSelected_val_v2: [],
        label_val: []
      };
    $(document).ready(function() {  
      $('#modal-filter-map').modal('show');  
      
      var form = $("#formfiltermap");

      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {
          // Disable validation on fields that are disabled or hidden.
          form.validate({
              rules: {
                typeMap: {
                  required: true
                }
              },
              errorPlacement: function (error, element) { 
                alert(error[0].innerHTML)
              }
          }).settings.ignore = ":disabled,:hidden";

          // Start validation; Prevent going forward if false
          return form.valid();
        },
        onFinished: function(event, currentIndex) {
            var witel = $('#witel').val();        
            var typeMap = $('#typeMap').val();

            var segmen = $('#segmen').val();
            var unspec = $('#unspec').val();
            var nps = $('#nps').val();
            var gangguan = $('#gangguan').val();
            var channel_bayar = $('#channel_bayar').val();
            var minipack = $('#minipack').val();
            var stb = $('#stb').val();

            var segmen_v2 = $('#segmen_v2').val();
            var unspec_v2 = $('#unspec_v2').val();
            var nps_v2 = $('#nps_v2').val();
            var gangguan_v2 = $('#gangguan_v2').val();
            var channel_bayar_v2 = $('#channel_bayar_v2').val();
            var minipack_v2 = $('#minipack_v2').val();
            var stb_v2 = $('#stb_v2').val();

            var latitudeLongitude = $('#latlong').val();
            // STEP 2
            if (witel != '') {
              reqObjVal.witelSelected_val.push(witel);
            }
            if (typeMap != '') {
              reqObjVal.typeMapSelected_val.push(typeMap);
            }
            if (segmen != '') {
              colorObjVal.segmenSelected_val.push(segmen);
              colorObjVal.warna_val.push(segmen);
            }
            if (unspec != '') {
              colorObjVal.unspecSelected_val.push(unspec);
              colorObjVal.warna_val.push(unspec);
            }
            if (nps != '') {
              colorObjVal.npsSelected_val.push(nps);
              colorObjVal.warna_val.push(nps);
            }
            if (gangguan != '') {
              colorObjVal.gangguanSelected_val.push(gangguan);
              colorObjVal.warna_val.push(gangguan);
            }
            if (channel_bayar != '') {
              colorObjVal.clbayarSelected_val.push(channel_bayar);
              colorObjVal.warna_val.push(channel_bayar);
            }
            if (minipack != '') {
              colorObjVal.minipackSelected_val.push(minipack);
              colorObjVal.warna_val.push(minipack);
            }
            if (stb != '') {
              colorObjVal.stbSelected_val.push(stb);
              colorObjVal.warna_val.push(stb);
            }

            // STEP 3
            if (segmen_v2 != '') {
              labelObjVal.segmenSelected_val_v2.push(segmen_v2);
              labelObjVal.label_val.push(segmen_v2)
            } 
            if (unspec_v2 != '') {
              labelObjVal.unspecSelected_val_v2.push(unspec_v2);
              labelObjVal.label_val.push(unspec_v2)
            } 
            if (nps_v2 != '') {
              labelObjVal.npsSelected_val_v2.push(nps_v2);
              labelObjVal.label_val.push(nps_v2)
            } 
            if (gangguan_v2 != '') {
              labelObjVal.gangguanSelected_val_v2.push(gangguan_v2);
              labelObjVal.label_val.push(gangguan_v2)
            } 
            if (channel_bayar_v2 != '') {
              labelObjVal.clbayarSelected_val_v2.push(channel_bayar_v2);
              labelObjVal.label_val.push(channel_bayar_v2)
            } 
            if (minipack_v2 != '') {
              labelObjVal.minipackSelected_val_v2.push(minipack_v2);
              labelObjVal.label_val.push(minipack_v2)
            }
            if (stb_v2 != '') {
              labelObjVal.stbSelected_val_v2.push(stb_v2);
              labelObjVal.label_val.push(stb_v2)
            }

            if(latitudeLongitude != ''){
              latLng = latitudeLongitude;
            }
            // hide modal  
            load_content(reqObjVal,colorObjVal,labelObjVal,latLng);
            
            $('#modal-filter-map').modal('hide');
        }
      });
      $("#segmen").change(function() {
        if ($('#segmen').val() != "") {
          $('#nps').prop('disabled', true);
          $('#unspec').prop('disabled', true);
          $('#gangguan').prop('disabled', true);
          $('#gangguan').prop('disabled', true);
          $('#channel_bayar').prop('disabled', true);
          $('#minipack').prop('disabled', true);
          $('#stb').prop('disabled', true);
        } else {
          $('#nps').prop('disabled', false);
          $('#unspec').prop('disabled', false);
          $('#gangguan').prop('disabled', false);
          $('#channel_bayar').prop('disabled', false);
          $('#minipack').prop('disabled', false);
          $('#stb').prop('disabled', false);
        }
      });

      $("#nps").change(function() {
        if ($('#nps').val() != "") {
          $('#segmen').prop('disabled', true);
          $('#unspec').prop('disabled', true);
          $('#gangguan').prop('disabled', true);
          $('#channel_bayar').prop('disabled', true);
          $('#minipack').prop('disabled', true);
          $('#stb').prop('disabled', true);
        } else {
          $('#segmen').prop('disabled', false);
          $('#unspec').prop('disabled', false);
          $('#gangguan').prop('disabled', false);
          $('#channel_bayar').prop('disabled', false);
          $('#minipack').prop('disabled', false);
          $('#stb').prop('disabled', false);
        }
      });

      $("#unspec").change(function() {
        if ($('#unspec').val() != "") {
          $('#segmen').prop('disabled', true);
          $('#nps').prop('disabled', true);
          $('#gangguan').prop('disabled', true);
          $('#channel_bayar').prop('disabled', true);
          $('#minipack').prop('disabled', true);
          $('#stb').prop('disabled', true);
        } else {
          $('#segmen').prop('disabled', false);
          $('#nps').prop('disabled', false);
          $('#gangguan').prop('disabled', false);
          $('#channel_bayar').prop('disabled', false);
          $('#minipack').prop('disabled', false);
          $('#stb').prop('disabled', false);
        }
      });

      $("#gangguan").change(function() {
        if ($('#gangguan').val() != "") {
          $('#segmen').prop('disabled', true);
          $('#nps').prop('disabled', true);
          $('#unspec').prop('disabled', true);
          $('#channel_bayar').prop('disabled', true);
          $('#minipack').prop('disabled', true);
          $('#stb').prop('disabled', true);
        } else {
          $('#segmen').prop('disabled', false);
          $('#nps').prop('disabled', false);
          $('#unspec').prop('disabled', false);
          $('#channel_bayar').prop('disabled', false);
          $('#minipack').prop('disabled', false);
          $('#stb').prop('disabled', false);
        }
      });

      $("#channel_bayar").change(function() {
        if ($('#channel_bayar').val() != "") {
          $('#segmen').prop('disabled', true);
          $('#nps').prop('disabled', true);
          $('#unspec').prop('disabled', true);
          $('#gangguan').prop('disabled', true);
          $('#minipack').prop('disabled', true);
          $('#stb').prop('disabled', true);
        } else {
          $('#segmen').prop('disabled', false);
          $('#nps').prop('disabled', false);
          $('#unspec').prop('disabled', false);
          $('#gangguan').prop('disabled', false);
          $('#minipack').prop('disabled', false);
          $('#stb').prop('disabled', false);
        }
      });

      $("#minipack").change(function() {
        if ($('#minipack').val() != "") {
          $('#segmen').prop('disabled', true);
          $('#nps').prop('disabled', true);
          $('#unspec').prop('disabled', true);
          $('#gangguan').prop('disabled', true);
          $('#channel_bayar').prop('disabled', true);
          $('#stb').prop('disabled', true);
        } else {
          $('#segmen').prop('disabled', false);
          $('#nps').prop('disabled', false);
          $('#unspec').prop('disabled', false);
          $('#gangguan').prop('disabled', false);
          $('#channel_bayar').prop('disabled', false);
          $('#stb').prop('disabled', false);
        }
      });

      $("#stb").change(function() {
        if ($('#stb').val() != "") {
          $('#segmen').prop('disabled', true);
          $('#nps').prop('disabled', true);
          $('#unspec').prop('disabled', true);
          $('#gangguan').prop('disabled', true);
          $('#channel_bayar').prop('disabled', true);
          $('#minipack').prop('disabled', true);
        } else {
          $('#segmen').prop('disabled', false);
          $('#nps').prop('disabled', false);
          $('#unspec').prop('disabled', false);
          $('#gangguan').prop('disabled', false);
          $('#channel_bayar').prop('disabled', false);
          $('#minipack').prop('disabled', false);
        }
      });

      // STEP 3
      $("#segmen_v2").change(function() {
        if ($('#segmen_v2').val() != "") {
          $('#nps_v2').prop('disabled', true);
          $('#unspec_v2').prop('disabled', true);
          $('#gangguan_v2').prop('disabled', true);
          $('#channel_bayar_v2').prop('disabled', true);
          $('#minipack_v2').prop('disabled', true);
        } else {
          $('#nps_v2').prop('disabled', false);
          $('#unspec_v2').prop('disabled', false);
          $('#gangguan_v2').prop('disabled', false);
          $('#channel_bayar_v2').prop('disabled', false);
          $('#minipack_v2').prop('disabled', false);
        }
      });

      $("#nps_v2").change(function() {
        if ($('#nps_v2').val() != "") {
          $('#segmen_v2').prop('disabled', true);
          $('#unspec_v2').prop('disabled', true);
          $('#gangguan_v2').prop('disabled', true);
          $('#channel_bayar_v2').prop('disabled', true);
          $('#minipack_v2').prop('disabled', true);
        } else {
          $('#segmen_v2').prop('disabled', false);
          $('#unspec_v2').prop('disabled', false);
          $('#gangguan_v2').prop('disabled', false);
          $('#channel_bayar_v2').prop('disabled', false);
          $('#minipack_v2').prop('disabled', false);
        }
      });

      $("#unspec_v2").change(function() {
        if ($('#unspec_v2').val() != "") {
          $('#segmen_v2').prop('disabled', true);
          $('#nps_v2').prop('disabled', true);
          $('#gangguan_v2').prop('disabled', true);
          $('#channel_bayar_v2').prop('disabled', true);
          $('#minipack_v2').prop('disabled', true);
          $('#stb_v2').prop('disabled', true);
        } else {
          $('#segmen_v2').prop('disabled', false);
          $('#nps_v2').prop('disabled', false);
          $('#gangguan_v2').prop('disabled', false);
          $('#channel_bayar_v2').prop('disabled', false);
          $('#minipack_v2').prop('disabled', false);
          $('#stb_v2').prop('disabled', false);
        }
      });

      $("#gangguan_v2").change(function() {
        if ($('#gangguan_v2').val() != "") {
          $('#segmen_v2').prop('disabled', true);
          $('#nps_v2').prop('disabled', true);
          $('#unspec_v2').prop('disabled', true);
          $('#channel_bayar_v2').prop('disabled', true);
          $('#minipack_v2').prop('disabled', true);
          $('#stb_v2').prop('disabled', true);
        } else {
          $('#segmen_v2').prop('disabled', false);
          $('#nps_v2').prop('disabled', false);
          $('#unspec_v2').prop('disabled', false);
          $('#channel_bayar_v2').prop('disabled', false);
          $('#minipack_v2').prop('disabled', false);
          $('#stb_v2').prop('disabled', false);
        }
      });

      $("#channel_bayar_v2").change(function() {
        if ($('#channel_bayar_v2').val() != "") {
          $('#segmen_v2').prop('disabled', true);
          $('#nps_v2').prop('disabled', true);
          $('#unspec_v2').prop('disabled', true);
          $('#gangguan_v2').prop('disabled', true);
          $('#minipack_v2').prop('disabled', true);
          $('#stb_v2').prop('disabled', true);
        } else {
          $('#segmen_v2').prop('disabled', false);
          $('#nps_v2').prop('disabled', false);
          $('#unspec_v2').prop('disabled', false);
          $('#gangguan_v2').prop('disabled', false);
          $('#minipack_v2').prop('disabled', false);
          $('#stb_v2').prop('disabled', false);
        }
      });

      $("#minipack_v2").change(function() {
        if ($('#minipack_v2').val() != "") {
          $('#segmen_v2').prop('disabled', true);
          $('#nps_v2').prop('disabled', true);
          $('#unspec_v2').prop('disabled', true);
          $('#gangguan_v2').prop('disabled', true);
          $('#channel_bayar_v2').prop('disabled', true);
          $('#stb_v2').prop('disabled', true);
        } else {
          $('#segmen_v2').prop('disabled', false);
          $('#nps_v2').prop('disabled', false);
          $('#unspec_v2').prop('disabled', false);
          $('#gangguan_v2').prop('disabled', false);
          $('#channel_bayar_v2').prop('disabled', false);
          $('#stb_v2').prop('disabled', false);
        }
      });

      $("#stb_v2").change(function() {
        if ($('#stb_v2').val() != "") {
          $('#segmen_v2').prop('disabled', true);
          $('#nps_v2').prop('disabled', true);
          $('#unspec_v2').prop('disabled', true);
          $('#gangguan_v2').prop('disabled', true);
          $('#channel_bayar_v2').prop('disabled', true);
          $('#minipack_v2').prop('disabled', true);
        } else {
          $('#segmen_v2').prop('disabled', false);
          $('#nps_v2').prop('disabled', false);
          $('#unspec_v2').prop('disabled', false);
          $('#gangguan_v2').prop('disabled', false);
          $('#channel_bayar_v2').prop('disabled', false);
          $('#minipack_v2').prop('disabled', false);
        }
      });

      $(".select2").select2();
      
      $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
      })
      $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
      })

      // load_content();
      function load_content(reqObjVal,colorObjVal,labelObjVal,latLng){
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.location.customer') }}',
            'data': {
              witel: reqObjVal.witelSelected_val[0] ?? '',
              typeMap: reqObjVal.typeMapSelected_val[0] ?? '',
              segmen: colorObjVal.segmenSelected_val[0] ?? '',
              unspec: colorObjVal.unspecSelected_val[0] ?? '',
              nps: colorObjVal.npsSelected_val[0] ?? '',
              gangguan: colorObjVal.gangguanSelected_val[0] ?? '',
              channel_bayar: colorObjVal.clbayarSelected_val[0] ?? '',
              minipack: colorObjVal.minipackSelected_val[0] ?? '',
              stb: colorObjVal.stbSelected_val[0] ?? '',
              segmen_v2: labelObjVal.segmenSelected_val_v2[0] ?? '',
              unspec_v2: labelObjVal.unspecSelected_val_v2[0] ?? '',
              nps_v2: labelObjVal.npsSelected_val_v2[0] ?? '',
              gangguan_v2: labelObjVal.gangguanSelected_val_v2[0] ?? '',
              channel_bayar_v2: labelObjVal.clbayarSelected_val_v2[0] ?? '',
              minipack_v2: labelObjVal.minipackSelected_val_v2[0] ?? '',   
              stb_v2: labelObjVal.stbSelected_val_v2[0] ?? '', 
              latlong: latLng ?? ''
            },
            'beforeSend': function() {
                var block = $('.content-wrapper');
                $(block).block({
                    message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i> Please Wait...</span>',
                    css: {
                        border: 'none',
                        padding: '23px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        width: '200px'
                    }
                });
            },
            'success': function(data) {             
                $('#legend').empty();
                
                initMap(data);                                
            },
            'complete': function(){
                var block = $('.content-wrapper');
                $(block).unblock();
                reqObjVal.witelSelected_val = [];
                reqObjVal.typeMapSelected_val = [];
                colorObjVal.segmenSelected_val = [];
                colorObjVal.unspecSelected_val = [];
                colorObjVal.npsSelected_val = [];
                colorObjVal.gangguanSelected_val = [];
                colorObjVal.clbayarSelected_val = [];
                colorObjVal.minipackSelected_val = [];
                colorObjVal.stbSelected_val = [];
                colorObjVal.warna_val = [];
                labelObjVal.segmenSelected_val_v2 = [];
                labelObjVal.unspecSelected_val_v2 = [];
                labelObjVal.npsSelected_val_v2 = [];
                labelObjVal.gangguanSelected_val_v2 = [];
                labelObjVal.clbayarSelected_val_v2 = [];
                labelObjVal.minipackSelected_val_v2 = [];
                labelObjVal.stbSelected_val_v2 = [];
                labelObjVal.label_val = [];
                latLng = "";
            },
        })
      }
        
    var myStyles = [
        {
            featureType: "poi",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
            ]
        }
    ];

    function initMap(data) {
        var radius = document.getElementById("search-radius");
        var legend = document.getElementById("legend");
        radius.style.display = "none";
        legend.style.display = "none";
        legend.innerHTML = "";
        radius.innerHTML = "";
        var measureTool;

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 6,
            center: new google.maps.LatLng(1.277126, 114.600230),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: myStyles
        });
        measureTool = new MeasureTool(map, {
    		unit: MeasureTool.UnitTypeId.METRIC
    	});
      
      radius.style.display = "block";
      legend.style.display = "block";
      
      var div = document.createElement("div");
      div.innerHTML = `<div class="col-md-12" style="top: 10px">
          <div class="form-group row">
            <div class="col-md-6">
              <input id="latlong" name="latlong" type="text" placeholder="Latitude,Longitude" class="form-control">
            </div>
            <div class="col-md-3 mt-1">
              <button id="radiusBtnSubmit" class="btn btn-primary" type="submit">Submit</button>
            </div>
            <div class="col-md-3 mt-1">
              <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modal-filter-map">
                <i style="color: white" class="mdi mdi-account-search"></i>                               
              </a>
            </div>
          </div></div>`;
      
      radius.appendChild(div);
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(radius);
      var color = "#000000";
      const warna = [];
      const colorCollection = ["red","blue","green","purple","magenta","cyan","orange","brown","maroon"];
      if(colorObjVal.warna_val[0]){
        for (let index = 0; index < colorObjVal.warna_val[0].length; index++) {
          var val_warna = colorObjVal.warna_val[0][index] ?? '';
          if(val_warna){
            warna.push({[val_warna] : colorCollection[index]});
          }
        }
      
        var ket = document.createElement("div");
        ket.innerHTML = '<h5 class="title text-center text-bold">Legends :</h5></br>'
        ket.innerHTML += '<span class="text-left text-bold">Shapes :</span><br><div class="row"><div class="col-md-6">'
        const legenda = reqObjVal.typeMapSelected_val[0].map((value,i) => {
          var sumbermap = [{"APPROX" : `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" version="1.1"><path d="M0,8a7,7 0 1,0 14,0a7,7 0 1,0 -14,0" fill="#000000"/></svg><span> APPROX</span>`}, {"REAL" : `<svg width="13" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 4 4"><path d="M -2,-2 2,-2 2,2 -2,2 z" fill="#000000"/></svg><span> REAL</span>`}];
          const symbol = sumbermap.find(item => value in item);
          ket.innerHTML += symbol[value]+"  ";
          return legend.appendChild(ket);
        });
        ket.innerHTML += '</div></div><br><span class="text-left text-bold">Colors :</span><br><div class="row"><div class="col-md-6">'
        for (let index = 0; index < colorObjVal.warna_val[0].length; index++) {
          ket.innerHTML += `<svg width="13" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 4 4"><path d="M -2,-2 2,-2 2,2 -2,2 z" fill="${colorCollection[index]}"/></svg><span>${colorObjVal.warna_val[0][index]}</span><br>`;
          legend.appendChild(ket);
        }
      }

      const labels = [];
      if(labelObjVal.label_val[0])
      {
        for (let index = 0; index < labelObjVal.label_val[0].length; index++) {
          var val_label = labelObjVal.label_val[0][index] ?? '';
          if(val_label != '')
          {
            labels.push({[val_label] : labelObjVal.label_val[0][index].substr(0,2)});
          }
        }
        ket.innerHTML += '</div></div><span class="text-left text-bold">Labels :</span><br><div class="row"><div class="col-md-6">';
        for (let index = 0; index < labelObjVal.label_val[0].length; index++) {
          ket.innerHTML += `<span class="text-black" style="font-weight:bold;">${labelObjVal.label_val[0][index].substr(0,2)}</span> <span class="text-black" style="font-weight:bold;"> = ${labelObjVal.label_val[0][index]}</span><br>`
          legend.appendChild(ket);
        }
      }

      ket.innerHTML += '</div></div><br>'
      legend.appendChild(ket);
      map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
      
      var infowindow = new google.maps.InfoWindow();        
      var maps = map;
      
      const markers = data.locations.map((value, i) => {
        const segmenColor = warna.find(item => value.segmen_hvc in item) ?? warna.find(item => value.spek_underspek in item) ?? warna.find(item => value.nps in item) ?? warna.find(item => value.map_gangguan in item) ?? warna.find(item => value.map_channel_bayar in item) ?? warna.find(item => value.map_minipack in item) ?? warna.find(item => value.map_stb_tambahan in item) ?? '';
        const segmenLabel = labels.find(item => value.segmen_hvc in item) ?? labels.find(item => value.spek_underspek in item) ?? labels.find(item => value.nps in item) ?? labels.find(item => value.map_gangguan in item) ?? labels.find(item => value.map_channel_bayar in item) ?? labels.find(item => value.map_minipack in item) ?? labels.find(item => value.map_stb_tambahan in item) ?? '';
          var marker = new google.maps.Marker({
              position: new google.maps.LatLng(parseFloat(value.latitude_map), parseFloat(value.longitude_map)),
              map: maps,
              icon: {
                path: (value.sumber_map === "APPROX") ? "M-2,0a2,2 0 1,0 4,0a2,2 0 1,0 -4,0" : "M -2,-2 2,-2 2,2 -2,2 z",                
                fillColor: segmenColor ? segmenColor[Object.keys(segmenColor)[0]] :color,
                fillOpacity: 1,
                strokeOpacity: 0,
                scale: 4,
                size: new google.maps.Size(0, 0),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0),
              },
              label: {
                text: segmenLabel ? segmenLabel[Object.keys(segmenLabel)[0]] : '',
                color: '#FFFFFF',
                fontSize: '9px',
                fontWeight: 'bold'
              },
              notel: value.notel ? value.notel : '',
              nama: value.nama_pelanggan_bynoss ? value.nama_pelanggan_bynoss : '',
              email: value.email_myih ? value.email_myih : '',
              no_hp: value.nohp_pcf ? value.nohp_pcf : '',
              alamat: value.alamat_gabungan ? value.alamat_gabungan : '',
              type_map: value.sumber_map ? value.sumber_map : '',
              nama_odp: value.odp_name ? value.odp_name : '',
              lcat_name: value.lcat_name ? value.lcat_name : '',
              segmen_hvc: value.segmen_hvc ? value.segmen_hvc : '',
              rev_trems_ncli: value.rev_trems_ncli ? value.rev_trems_ncli : '',
              tipe : value.tipe_1p_2p_3p ? value.tipe_1p_2p_3p : '',
              speed_pcrf : value.speed_pcrf ? value.speed_pcrf : '',
              alpro_onustatus : value.alpro_onustatus ? value.alpro_onustatus : '',
              alpro_rxpoweronu : value.alpro_rxpoweronu ? value.alpro_rxpoweronu : '',
              alpro_gpon : value.alpro_gpon ? value.alpro_gpon : '',
              alpro_portolt : value.alpro_portolt ? value.alpro_portolt : '',
              usage_inet_current_month : value.usage_inet_current_month ? value.usage_inet_current_month : '',
              curr_usage : value.usage_inet_timestamp_curr ? value.usage_inet_timestamp_curr : '',
            });
            google.maps.event.addListener(marker, 'click', function() {                
            infowindow.setContent(
                `<div id="infowindow">
                    <div class="col-md-12"> 
                        <div class="row">
                            <div class="col-md-12">
                                <span style="font-weight: bold">No Inet : </span>`+marker.notel+`<br/>
                                <span style="font-weight: bold">Nama : </span>`+marker.nama+`<br/>
                                <span style="font-weight: bold">Email : </span>`+marker.email+`<br/>
                                <span style="font-weight: bold">No Hp : </span>`+marker.no_hp+`<br/>
                                <span style="font-weight: bold">Alamat : </span>`+marker.alamat+`<br/>
                                <span style="font-weight: bold">Type : </span>`+marker.type_map+`<br/>
                                <span style="font-weight: bold">Nama ODP : </span>`+marker.nama_odp+`<br/>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <span style="font-weight: bold">LCAT Name : </span>`+marker.lcat_name+`<br/>
                                <span style="font-weight: bold">Segmen : </span>`+marker.segmen_hvc+`<br/>
                                <span style="font-weight: bold">Revenue : </span>`+toCommas(marker.rev_trems_ncli)+`<br/>
                                <span style="font-weight: bold">Tipe : </span>`+marker.tipe+`<br/>
                                <span style="font-weight: bold">Speed : </span>`+toCommas(marker.speed_pcrf)+` Kbps<br/>
                            </div>
                            <div class="col-md-6">
                            <span style="font-weight: bold">Alpro Status : </span>`+marker.alpro_onustatus+`<br/>
                                <span style="font-weight: bold">Redaman : </span>`+marker.alpro_rxpoweronu+` dBm<br/>
                                <span style="font-weight: bold">GPON : </span>`+marker.alpro_gpon+`<br/>
                                <span style="font-weight: bold">Port OLT : </span>`+marker.alpro_portolt+`<br/>
                                <span style="font-weight: bold">Current Usage : </span>`+toCommas(marker.usage_inet_current_month)+` GB (`+marker.curr_usage+`)<br/>
                            </div>
                        </div>
                    </div>
                </div>`);      
            infowindow.open(map, marker);
          }); 
          return marker;
      });
      // add this
      $('#radiusBtnSubmit').on('click', function() {
        var witel = $('#witel').val();        
        var typeMap = $('#typeMap').val();

        var segmen = $('#segmen').val();
        var unspec = $('#unspec').val();
        var nps = $('#nps').val();
        var gangguan = $('#gangguan').val();
        var channel_bayar = $('#channel_bayar').val();
        var minipack = $('#minipack').val();
        var stb = $('#stb').val();

        var segmen_v2 = $('#segmen_v2').val();
        var unspec_v2 = $('#unspec_v2').val();
        var nps_v2 = $('#nps_v2').val();
        var gangguan_v2 = $('#gangguan_v2').val();
        var channel_bayar_v2 = $('#channel_bayar_v2').val();
        var minipack_v2 = $('#minipack_v2').val();
        var stb_v2 = $('#stb_v2').val();

        var latitudeLongitude = $('#latlong').val();
        // STEP 2
        if (witel != '') {
          reqObjVal.witelSelected_val.push(witel);
        }
        if (typeMap != '') {
          reqObjVal.typeMapSelected_val.push(typeMap);
        }
        if (segmen != '') {
          colorObjVal.segmenSelected_val.push(segmen);
          colorObjVal.warna_val.push(segmen);
        }
        if (unspec != '') {
          colorObjVal.unspecSelected_val.push(unspec);
          colorObjVal.warna_val.push(unspec);
        }
        if (nps != '') {
          colorObjVal.npsSelected_val.push(nps);
          colorObjVal.warna_val.push(nps);
        }
        if (gangguan != '') {
          colorObjVal.gangguanSelected_val.push(gangguan);
          colorObjVal.warna_val.push(gangguan);
        }
        if (channel_bayar != '') {
          colorObjVal.clbayarSelected_val.push(channel_bayar);
          colorObjVal.warna_val.push(channel_bayar);
        }
        if (minipack != '') {
          colorObjVal.minipackSelected_val.push(minipack);
          colorObjVal.warna_val.push(minipack);
        }
        if (stb != '') {
          colorObjVal.stbSelected_val.push(stb);
          colorObjVal.warna_val.push(stb);
        }

        // STEP 3
        if (segmen_v2 != '') {
          labelObjVal.segmenSelected_val_v2.push(segmen_v2);
        } 
        if (unspec_v2 != '') {
          labelObjVal.unspecSelected_val_v2.push(unspec_v2);
        } 
        if (nps_v2 != '') {
          labelObjVal.npsSelected_val_v2.push(nps_v2);
        } 
        if (gangguan_v2 != '') {
          labelObjVal.gangguanSelected_val_v2.push(gangguan_v2);
        } 
        if (channel_bayar_v2 != '') {
          labelObjVal.clbayarSelected_val_v2.push(channel_bayar_v2);
        } 
        if (minipack_v2 != '') {
          labelObjVal.minipackSelected_val_v2.push(minipack_v2);
        }
        if (stb_v2 != '') {
          labelObjVal.stbSelected_val_v2.push(stb_v2);
        }

        if(latitudeLongitude != ''){
          latLng = latitudeLongitude;
        }
        // hide modal  
        load_content(reqObjVal,colorObjVal,labelObjVal,latLng);
      });
      new MarkerClusterer(map, markers, {
          imagePath:"https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
          gridSize:30,
          maxZoom:15,
      });
    }
    
    function toCommas(value) {
      if(value) return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      else return "";
    }
  });
</script>
@endsection