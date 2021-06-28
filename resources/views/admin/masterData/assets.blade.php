@extends('layouts.admin')
@section('content')

<div class="col-md-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cari Asset Pelanggan TREG6</h4>
            {{-- <form class="form-horizontal no-margin" id="formfilterassets" action="#" method="post" enctype="multipart/form-data" novalidate="novalidate"> --}}
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">                    
                            <input class="form-control" type="text" name="notel" id="notel" placeholder="NoTelp/Inet">
                        </div>
                    </div>
                    <div class="col-md-3 mt-1">
                        <button type="button" class="btn btn-info mr-2" id="applyBtn">Search</button>
                    </div>
                </div>                            
            {{-- </form> --}}
        </div>
    </div>
</div>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div style="float: left" id="event_inet">
                
            </div>
            <div style="float: right" id="rev_inet">
                <h3>Total : 0</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">                    
                    <tr>
                        <th style="text-align: right; width: 5%">No</th>
                        <th style="text-align: left">Product Name</th>                                
                        <th style="text-align: left">Desc Item</th>
                        <th style="text-align: right">RP</th>
                        <th>Status</th>
                        <th>Date Activated</th>                        
                    </tr>
                    <tbody id="table-assets-internet">
                        
                    </tbody>
                </table>
            </div>                        
        </div>
    </div>
</div>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div style="float: left" id="event_tlp">
                
            </div>
            <div style="float: right" id="rev_tlp">
                <h3>Total : 0
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">                    
                    <tr>
                        <th style="text-align: right; width: 5%">No</th>
                        <th style="text-align: left; ">Product Name</th>                                
                        <th style="text-align: left">Desc Item</th>
                        <th style="text-align: right">RP</th>
                        <th>Status</th>
                        <th>Date Activated</th>                        
                    </tr>
                    <tbody id="table-assets-tlp">
                        
                    </tbody>
                </table>
            </div>                        
        </div>
    </div>
</div>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header" id="header_rev">
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">                    
                    <tr>
                        <th style="text-align: right; width: 5%">No</th>
                        <th>NPER</th>                                
                        <th>ND</th>
                        <th>Payment Date</th>
                        <th>Payment</th>
                        <th>Type</th>
                        <th style="text-align: right">Billing Amount</th> 
                        <th style="text-align: right">Payment Amount</th>                        
                    </tr>
                    <tbody id="table-revenue">
                        
                    </tbody>
                </table>
            </div>                        
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
$(document).ready(function() {
    load_content();

    function load_content(notel='') {
        $.ajax({
            'type': "GET",
            'dataType': "JSON",
            'url': '{{ route('admin.customer.assets') }}',
            'data': {
                notel: notel,
            },
            'success': function(data) {
                $('#table-assets-internet').empty();
                $('#table-assets-tlp').empty();
                $('#table-revenue').empty();

                var number = 1; 
                var no = 1;
                var num = 1;

                var event_inet = data.cust_reference['nd_reference'];
                var event_tlp = data.cust['nd_reference'];
                var rev_inet = data.cust['revenue_trems'] ? parseInt(data.cust['revenue_trems']) : 0;
                var rev_tlp = data.cust_reference['revenue_trems'] ? parseInt(data.cust_reference['revenue_trems']) : 0;

                var total_inet = rev_inet ? formatNumber(rev_inet) : 0;
                var total_tlp = rev_tlp ? formatNumber(rev_tlp) : 0;              
                
                if (event_inet != null) {
                    $('#event_inet').append(`
                        <h3>`+ event_inet +`</h3>
                    `);
                }
                
                if (event_tlp != null) {
                    $('#event_tlp').append(`
                        <h3>`+ event_tlp +`</h3>
                    `);
                }

                $('#rev_inet').append(`
                    <h3>Total : `+total_inet+`</h3>
                `);


                $('#rev_tlp').append(`
                    <h3>Total : `+total_tlp+`</h3>
                `);


                $('#header_rev').append(`
                    <h3>Payment Revenue</h3>
                `);

                $.each(data.assets_internet, function(index,value){   
                    // console.log(value.product_code);  
                    var getRp = value.child_asset_amount_x.replace(/\.?0+$/, '');

                    $('#table-assets-internet').append(`
                    <tr>
                        <td style="text-align: right; width: 5%">`+ number++ +`.</td>
                        <td style="text-align: left">`+value.product_code+`</td>
                        <td style="text-align: left">`+value.asset_name+`</td>
                        <td style="text-align: right">`+formatNumber(getRp)+`</td>
                        <td>`+value.root_status+`</td>
                        <td>`+value.active_date+`</td>                                                                       
                    </tr>`)
                });

                $.each(data.assets_telp, function(index,value){   
                    // console.log(value.product_code);  
                    var getRp = value.child_asset_amount_x.replace(/\.?0+$/, '');                                 
                    $('#table-assets-tlp').append(`
                    <tr>
                        <td style="text-align: right; width: 5%">`+ no++ +`.</td>
                        <td style="text-align: left">`+value.product_code+`</td>
                        <td style="text-align: left">`+value.asset_name+`</td>
                        <td style="text-align: right">`+formatNumber(getRp)+`</td>
                        <td>`+value.root_status+`</td>
                        <td>`+value.active_date+`</td>                                                                       
                    </tr>`)
                });

                $.each(data.trems_payment, function(index,value){   
                    // console.log(value.product_code);  
                    var getBillingAmount = value.billing_amount.replace(/\.?0+$/, ''); 
                    var getPaymentAmount = value.billing_amount.replace(/\.?0+$/, '');                                 
                    $('#table-revenue').append(`
                    <tr>
                        <td style="text-align: right; width: 5%">`+ num++ +`.</td>
                        <td>`+value.nper+`</td>
                        <td>`+value.telp+`</td>
                        <td>`+value.payment_date+`</td>
                        <td>`+value.l_bank+`</td>
                        <td>`+value.jenis+`</td>
                        <td style="text-align: right">`+formatNumber(getBillingAmount)+`</td>
                        <td style="text-align: right">`+formatNumber(getPaymentAmount)+`</td>                                                    
                    </tr>`)
                });
            }
        })
    }

    $('#applyBtn').click(function(e) {
        var notel_val = $('#notel').val();            
        e.preventDefault();

        load_content(notel_val);
        $('#event_inet').empty();
        $('#rev_inet').empty(); 
        $('#table-assets-internet').empty(); 
        $('#event_tlp').empty();
        $('#rev_tlp').empty();       
        $('#table-assets-tlp').empty();  
        $('#header_rev').empty();  
        $('#table-revenue').empty();  
    });
});

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}  
</script>
@parent
@endsection