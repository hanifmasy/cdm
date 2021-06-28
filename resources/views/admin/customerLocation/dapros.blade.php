@extends('layouts.admin')
@section('styles')
<style>
    #map {
        height: 90vh;        
        width: 100%;        
    }
    .map-overlay {
        position: absolute;
        top: 0;
        left: 0;
        padding: 20px;
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
    <div id="legend">
        <div id="ket"></div>
    </div>
    <div class="map-overlay" id="search-map" style="width: 700px; z-index: 0; position: absolute; top: 0px; left: 205px;">
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-md-3 mt-1">
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modal-filter-map">
                        <i style="color: white" class="mdi mdi-account-search"></i>                               
                    </a>
                </div>                                    
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-filter-map" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Filter Map</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal no-margin" id="formfiltermap" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate">
            <div class="col-sm-12">
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
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Pilih Peta</label>      
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="gangguan" value="gangguan">
                                Gangguan
                            <i class="input-helper"></i>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="underspec" value="underspec">
                                Underspec
                            <i class="input-helper"></i>
                        </label>
                    </div>      
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="ct0" value="ct0">
                                Pra-pra CT0
                            <i class="input-helper"></i>
                        </label>
                    </div>      
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="qcnvalid" value="qcnvalid">
                                QC 2 Not Valid
                            <i class="input-helper"></i>
                        </label>
                    </div>      
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="minipack" value="minipack">
                                Dapros Minipack
                            <i class="input-helper"></i>
                        </label>
                    </div>      
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="stb" value="stb">
                                Dapros STB Tambahan
                            <i class="input-helper"></i>
                        </label>
                    </div>      
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="upgrade" value="upgrade">
                                Upgrade Speed
                            <i class="input-helper"></i>
                        </label>
                    </div>   
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="dapros" id="mig2p3p" value="mig2p3p">
                                Migrasi 2P3P
                            <i class="input-helper"></i>
                        </label>
                    </div>                                               
                </div>
            </div>                  
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="applyBtn">
                <span>Apply</span>
            </button>
        </div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGTv7qRwxDV6-bOGhFpIr6w2i6if1fyCA&libraries=geometry" defer></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script>
    var features = []; 
    var witelSelected_val = [];
    var daprosSelected_val = [];

    var measureTool;

    $(document).ready(function() {  
      $(".select2").select2();
      
      $('#modal-filter-map').modal('show');  

      // load_content();
      function load_content(witelSelected_val='', daprosSelected_val='') {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.location.customerDapros') }}',
            'data': {
                witel: witelSelected_val,
                dapros: daprosSelected_val
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
                $('#ket').empty();    
                // $('#search-map').empty();    
                
                var title = document.createElement("div");
                var keterangan = document.createElement("div"); 
                title.innerHTML = '<h4>Icons</h4>';
                
                // keterangan.innerHTML = '<h5>Ket : </h5>';
                legend.appendChild(title);
                // legend.appendChild(keterangan);              
                initMap(data);                                
            },
            'complete': function(){
                var block = $('.content-wrapper');
                $(block).unblock();
            },
        })
      }

      $('#applyBtn').click(function(e) {
        e.preventDefault();
        var witel = $('#witel').val();        
        // var dapros = $('#dapros').val();
        var dapros = $("input[name='dapros']:checked").val();

        console.log(witel);
        console.log(dapros);

        if (witel != null) {
            witelSelected_val.push(witel);
        }
        if (dapros != null) {
            daprosSelected_val.push(dapros);
        }
        
        load_content(witel, dapros); 

        // hide modal                 
        $('#modal-filter-map').modal('hide');   
                
      });
    });
        
    var legend = document.getElementById("legend");   
    // var searchM = document.getElementById("search-map");   
    // var iconBase = "https://maps.google.com/mapfiles/kml/paddle/";
    var icon = "{{asset('public/assets/icons')}}/";

    var icons = {    
        cl_platinum: {
            // name: "Platinum (Real)",
            icon: icon + "cr_platinum.png",
        },
        cl_gold: {
            // name: "Platinum Spec (Real)",
            icon: icon + "cr_gold.png",
        },
        cl_silver: {
            // name: "Platinum Underspec (Real)",
            icon: icon + "cr_silver.png",
        },
    };

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
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 6,
            center: new google.maps.LatLng(1.277126, 114.600230),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: myStyles
        });
        measureTool = new MeasureTool(map, {
    		unit: MeasureTool.UnitTypeId.METRIC
    	});
        // map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('search-map'));
        const features = [];
        
        // console.log(data.locations);

        $.each(data.locations, function(index,value) {
            if (value.segmen_hvc === 'HVC_PLATINUM') {
                var feed = {position: new google.maps.LatLng(parseFloat(value.latitude_map), parseFloat(value.longitude_map)), 
                type: "cl_platinum", 
                notel_pelanggan: value.notel ? value.notel : "-", 
                email_pelanggan: value.email_myih ? value.email_myih : "-", 
                nama_pelanggan: value.nama_pelanggan_bynoss ? value.nama_pelanggan_bynoss : "-",
                noHp_pelanggan: value.nohp_pcf ? value.nohp_pcf : "-",
                alamat_pelanggan: value.alamat_gabungan ? value.alamat_gabungan : "-",
                sumber_map : value.sumber_map ? value.sumber_map : "-",
                nama_odp : value.odp_name ? value.odp_name : "-",
                lcat_name : value.lcat_name ? value.lcat_name : "-",
                segmen_hvc : value.segmen_hvc ? value.segmen_hvc : "-",
                rev_trems_ncli : value.rev_trems_ncli ? value.rev_trems_ncli : "-",
                tipe : value.tipe_1p_2p_3p ? value.tipe_1p_2p_3p : "-",
                speed_pcrf : value.speed_pcrf ? value.speed_pcrf : "-",
                alpro_onustatus : value.alpro_onustatus ? value.alpro_onustatus : "-",
                alpro_rxpoweronu : value.alpro_rxpoweronu ? value.alpro_rxpoweronu : "-",
                alpro_gpon : value.alpro_gpon ? value.alpro_gpon : "-",
                alpro_portolt : value.alpro_portolt ? value.alpro_portolt : "-",
                usage_inet_current_month : value.usage_inet_current_month ? value.usage_inet_current_month : "-",
                curr_usage : value.usage_inet_timestamp_curr ? value.usage_inet_timestamp_curr : "-"
                };
                features.push(feed);
            }
            if (value.segmen_hvc === 'HVC_GOLD') {
                var feed = {position: new google.maps.LatLng(parseFloat(value.latitude_map), parseFloat(value.longitude_map)), 
                type: "cl_gold", 
                notel_pelanggan: value.notel ? value.notel : "-", 
                email_pelanggan: value.email_myih ? value.email_myih : "-", 
                nama_pelanggan: value.nama_pelanggan_bynoss ? value.nama_pelanggan_bynoss : "-",
                noHp_pelanggan: value.nohp_pcf ? value.nohp_pcf : "-",
                alamat_pelanggan: value.alamat_gabungan ? value.alamat_gabungan : "-",
                sumber_map : value.sumber_map ? value.sumber_map : "-",
                nama_odp : value.odp_name ? value.odp_name : "-",
                lcat_name : value.lcat_name ? value.lcat_name : "-",
                segmen_hvc : value.segmen_hvc ? value.segmen_hvc : "-",
                rev_trems_ncli : value.rev_trems_ncli ? value.rev_trems_ncli : "-",
                tipe : value.tipe_1p_2p_3p ? value.tipe_1p_2p_3p : "-",
                speed_pcrf : value.speed_pcrf ? value.speed_pcrf : "-",
                alpro_onustatus : value.alpro_onustatus ? value.alpro_onustatus : "-",
                alpro_rxpoweronu : value.alpro_rxpoweronu ? value.alpro_rxpoweronu : "-",
                alpro_gpon : value.alpro_gpon ? value.alpro_gpon : "-",
                alpro_portolt : value.alpro_portolt ? value.alpro_portolt : "-",
                usage_inet_current_month : value.usage_inet_current_month ? value.usage_inet_current_month : "-",
                curr_usage : value.usage_inet_timestamp_curr ? value.usage_inet_timestamp_curr : "-"

                };
                features.push(feed);
            }
            if (value.segmen_hvc === 'HVC_SILVER') {
                var feed = {position: new google.maps.LatLng(parseFloat(value.latitude_map), parseFloat(value.longitude_map)), 
                type: "cl_silver", 
                notel_pelanggan: value.notel ? value.notel : "-", 
                email_pelanggan: value.email_myih ? value.email_myih : "-", 
                nama_pelanggan: value.nama_pelanggan_bynoss ? value.nama_pelanggan_bynoss : "-",
                noHp_pelanggan: value.nohp_pcf ? value.nohp_pcf : "-",
                alamat_pelanggan: value.alamat_gabungan ? value.alamat_gabungan : "-",
                sumber_map : value.sumber_map ? value.sumber_map : "-",
                nama_odp : value.odp_name ? value.odp_name : "-",
                lcat_name : value.lcat_name ? value.lcat_name : "-",
                segmen_hvc : value.segmen_hvc ? value.segmen_hvc : "-",
                rev_trems_ncli : value.rev_trems_ncli ? value.rev_trems_ncli : "-",
                tipe : value.tipe_1p_2p_3p ? value.tipe_1p_2p_3p : "-",
                speed_pcrf : value.speed_pcrf ? value.speed_pcrf : "-",
                alpro_onustatus : value.alpro_onustatus ? value.alpro_onustatus : "-",
                alpro_rxpoweronu : value.alpro_rxpoweronu ? value.alpro_rxpoweronu : "-",
                alpro_gpon : value.alpro_gpon ? value.alpro_gpon : "-",
                alpro_portolt : value.alpro_portolt ? value.alpro_portolt : "-",
                usage_inet_current_month : value.usage_inet_current_month ? value.usage_inet_current_month : "-",
                curr_usage : value.usage_inet_timestamp_curr ? value.usage_inet_timestamp_curr : "-"

                };
                features.push(feed);
            }
        });
             
        // add this
        var infowindow = new google.maps.InfoWindow();        
        var maps = map;
        var markers = features.map((feature, i) => {
          var marker = new google.maps.Marker({
            type: feature.type,
            position: feature.position,
            map: maps,
            icon: icons[feature.type].icon,
            notel: feature.notel_pelanggan,
            nama: feature.nama_pelanggan,
            email: feature.email_pelanggan,
            no_hp: feature.noHp_pelanggan,
            alamat: feature.alamat_pelanggan,
            type_map: feature.sumber_map,
            nama_odp: feature.nama_odp,
            lcat_name: feature.lcat_name,
            segmen_hvc: feature.segmen_hvc,
            rev_trems_ncli: feature.rev_trems_ncli,
            tipe : feature.tipe,
            speed_pcrf : feature.speed_pcrf,
            alpro_onustatus : feature.alpro_onustatus,
            alpro_rxpoweronu : feature.alpro_rxpoweronu,
            alpro_gpon : feature.alpro_gpon,
            alpro_portolt : feature.alpro_portolt,
            usage_inet_current_month : feature.usage_inet_current_month,
            curr_usage : feature.curr_usage,
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
                  
        var ket = document.createElement("div");
        ket.innerHTML = 
        `<img src="`+ icon + "clr_platinum.png" +`"> <span style="margin-right: 26px">Platinum</span> 
            <br>
              <img src="`+ icon + "clr_gold.png" +`"> <span style="margin-right: 52px">Gold</span> 
            <br>
              <img src="`+ icon + "clr_silver.png" +`"> <span style="margin-right: 41px">Silver</span> 
            `;
        legend.appendChild(ket);
        new MarkerClusterer(map, markers, {
            imagePath:"https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
            gridSize:30,
            maxZoom:15,
        });
        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
    }
    
    function toCommas(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endsection