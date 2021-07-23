@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="container-fluid">
        @include('partials.navtab')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="padding-left: 5%;padding-top:5%;">
                        <div id="p1" style="overflow: hidden; position: relative; background-color: white; width: 100%; height: 519px;">
        
                            <!-- Begin shared CSS values -->
                            <style class="shared-css" type="text/css">
                                .t {
                                    transform-origin: bottom left;
                                    z-index: 2;
                                    position: absolute;
                                    white-space: pre;
                                    overflow: visible;
                                    line-height: 1.5;
                                }
        
                                .text-container {
                                    white-space: pre;
                                }
        
                                @supports (-webkit-touch-callout: none) {
                                    .text-container {
                                        white-space: normal;
                                    }
                                }
                            </style>
                            <!-- End shared CSS values -->
        
        
                            <!-- Begin inline CSS -->
                            <style type="text/css">
                                #t1_1 {
                                    left: 643px;
                                    bottom: 235px;
                                    letter-spacing: 0.1px;
                                    word-spacing: -0.02px;
                                }
        
                                #t2_1 {
                                    left: 643px;
                                    bottom: 238px;
                                    letter-spacing: 0.1px;
                                    word-spacing: -0.02px;
                                }
        
                                #t3_1 {
                                    left: 456px;
                                    bottom: 481px;
                                    letter-spacing: 0.09px;
                                }
        
                                #t4_1 {
                                    left: 456px;
                                    bottom: 484px;
                                    letter-spacing: 0.09px;
                                }
        
                                #t5_1 {
                                    left: 775px;
                                    bottom: 20px;
                                    letter-spacing: 0.16px;
                                }
        
                                #t6_1 {
                                    left: 775px;
                                    bottom: 23px;
                                    letter-spacing: 0.16px;
                                }
        
                                #t7_1 {
                                    left: 948px;
                                    bottom: 68px;
                                    letter-spacing: 0.16px;
                                }
        
                                #t8_1 {
                                    left: 948px;
                                    bottom: 70px;
                                    letter-spacing: 0.16px;
                                }
        
                                #t9_1 {
                                    left: 241px;
                                    bottom: 354px;
                                    letter-spacing: -0.09px;
                                    word-spacing: 0.19px;
                                }
        
                                #ta_1 {
                                    left: 259px;
                                    bottom: 339px;
                                    letter-spacing: 0.16px;
                                }
        
                                #tb_1 {
                                    left: 241px;
                                    bottom: 357px;
                                    letter-spacing: -0.09px;
                                    word-spacing: 0.19px;
                                }
        
                                #tc_1 {
                                    left: 259px;
                                    bottom: 342px;
                                    letter-spacing: 0.16px;
                                }
        
                                #td_1 {
                                    left: 434px;
                                    bottom: 427px;
                                    letter-spacing: 0.14px;
                                }
        
                                #te_1 {
                                    left: 434px;
                                    bottom: 430px;
                                    letter-spacing: 0.14px;
                                }
        
                                #tf_1 {
                                    left: 432px;
                                    bottom: 271px;
                                    letter-spacing: 0.12px;
                                    word-spacing: -0.03px;
                                }
        
                                #tg_1 {
                                    left: 432px;
                                    bottom: 273px;
                                    letter-spacing: 0.12px;
                                    word-spacing: -0.03px;
                                }
        
                                #th_1 {
                                    left: 616px;
                                    bottom: 352px;
                                    letter-spacing: 0.07px;
                                    word-spacing: 0.05px;
                                }
        
                                #ti_1 {
                                    left: 609px;
                                    bottom: 338px;
                                    letter-spacing: 0.1px;
                                }
        
                                #tj_1 {
                                    left: 616px;
                                    bottom: 355px;
                                    letter-spacing: 0.07px;
                                    word-spacing: 0.05px;
                                }
        
                                #tk_1 {
                                    left: 609px;
                                    bottom: 340px;
                                    letter-spacing: 0.1px;
                                }
        
                                #tl_1 {
                                    left: 636px;
                                    bottom: 189px;
                                    letter-spacing: 0.09px;
                                }
        
                                #tm_1 {
                                    left: 650px;
                                    bottom: 174px;
                                    letter-spacing: 0.13px;
                                }
        
                                #tn_1 {
                                    left: 636px;
                                    bottom: 192px;
                                    letter-spacing: 0.09px;
                                }
        
                                #to_1 {
                                    left: 650px;
                                    bottom: 177px;
                                    letter-spacing: 0.13px;
                                }
        
                                #tp_1 {
                                    left: 651px;
                                    bottom: 397px;
                                    letter-spacing: 0.09px;
                                }
        
                                #tq_1 {
                                    left: 651px;
                                    bottom: 399px;
                                    letter-spacing: 0.09px;
                                }
        
                                #tr_1 {
                                    left: 935px;
                                    bottom: 229px;
                                    letter-spacing: 0.09px;
                                }
        
                                #ts_1 {
                                    left: 938px;
                                    bottom: 215px;
                                    letter-spacing: 0.16px;
                                }
        
                                #tt_1 {
                                    left: 935px;
                                    bottom: 232px;
                                    letter-spacing: 0.09px;
                                }
        
                                #tu_1 {
                                    left: 938px;
                                    bottom: 217px;
                                    letter-spacing: 0.16px;
                                }
        
                                #tv_1 {
                                    left: 930px;
                                    bottom: 130px;
                                    letter-spacing: 0.09px;
                                    word-spacing: -0.01px;
                                }
        
                                #tw_1 {
                                    left: 940px;
                                    bottom: 115px;
                                    letter-spacing: 0.18px;
                                }
        
                                #tx_1 {
                                    left: 930px;
                                    bottom: 133px;
                                    letter-spacing: 0.09px;
                                    word-spacing: -0.01px;
                                }
        
                                #ty_1 {
                                    left: 940px;
                                    bottom: 118px;
                                    letter-spacing: 0.18px;
                                }
        
                                #tz_1 {
                                    left: 532px;
                                    bottom: 79px;
                                    letter-spacing: 0.08px;
                                }
        
                                #t10_1 {
                                    left: 529px;
                                    bottom: 64px;
                                    letter-spacing: 0.13px;
                                }
        
                                #t11_1 {
                                    left: 532px;
                                    bottom: 82px;
                                    letter-spacing: 0.08px;
                                }
        
                                #t12_1 {
                                    left: 529px;
                                    bottom: 67px;
                                    letter-spacing: 0.13px;
                                }
        
                                #t13_1 {
                                    left: 759px;
                                    bottom: 79px;
                                    letter-spacing: 0.06px;
                                }
        
                                #t14_1 {
                                    left: 778px;
                                    bottom: 64px;
                                    letter-spacing: 0.18px;
                                }
        
                                #t15_1 {
                                    left: 759px;
                                    bottom: 82px;
                                    letter-spacing: 0.06px;
                                }
        
                                #t16_1 {
                                    left: 778px;
                                    bottom: 67px;
                                    letter-spacing: 0.18px;
                                }
        
                                #t17_1 {
                                    left: 242px;
                                    bottom: 189px;
                                    letter-spacing: -0.07px;
                                    word-spacing: 0.17px;
                                }
        
                                #t18_1 {
                                    left: 273px;
                                    bottom: 175px;
                                }
        
                                #t19_1 {
                                    left: 242px;
                                    bottom: 192px;
                                    letter-spacing: -0.07px;
                                    word-spacing: 0.17px;
                                }
        
                                #t1a_1 {
                                    left: 273px;
                                    bottom: 178px;
                                }
        
                                #t1b_1 {
                                    left: 69px;
                                    bottom: 280px;
                                    letter-spacing: 0.09px;
                                    word-spacing: -0.01px;
                                }
        
                                #t1c_1 {
                                    left: 70px;
                                    bottom: 265px;
                                    letter-spacing: 0.16px;
                                }
        
                                #t1d_1 {
                                    left: 69px;
                                    bottom: 282px;
                                    letter-spacing: 0.09px;
                                    word-spacing: -0.01px;
                                }
        
                                #t1e_1 {
                                    left: 70px;
                                    bottom: 268px;
                                    letter-spacing: 0.16px;
                                }
        
                                .textPrior1 {
                                    font-size: 12px;
                                    font-family: Carlito_27;
                                    color: #000;
                                }
        
                                .textPrior2 {
                                    font-size: 12px;
                                    font-family: Carlito_27;
                                    color: #FFF;
                                }
                            </style>
                            <!-- End inline CSS -->
        
                            <!-- Begin embedded font definitions -->
                            <style id="fonts" type="text/css">
                                @font-face {
                                    font-family: Carlito_27;
                                    src: url("{{ asset('public/fonts/Carlito_27.woff') }}") format("woff");
                                }
                            </style>
                            <!-- End embedded font definitions -->
        
                            <!-- Begin page background -->
                            <div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
                            <div id="pg1" style="-webkit-user-select: none;"><object width="1039" height="519" data="{{ asset('public/1.svg') }}" type="image/svg+xml" id="pdf1" style="width:1039px; height:519px; -moz-transform:scale(1); z-index: 0;"></object></div>
                            <!-- End page background -->
        
        
                            <!-- Begin text definitions (Positioned/styled in CSS) -->
                            <div class="text-container"><span id="t1_1" class="t textPrior1">CTB , OBC </span>
                                <span id="t2_1" class="t textPrior2">CTB , OBC </span>
                                <span id="t3_1" class="t textPrior1">ROC </span>
                                <span id="t4_1" class="t textPrior2">ROC </span>
                                <span id="t5_1" class="t textPrior1">RAM </span>
                                <span id="t6_1" class="t textPrior2">RAM </span>
                                <span id="t7_1" class="t textPrior1">CC </span>
                                <span id="t8_1" class="t textPrior2">CC </span>
                                <span id="t9_1" class="t textPrior1">BELUM BAYAR </span>
                                <span id="ta_1" class="t textPrior1">{{ number_format($total_belum_bayar) }} </span>
                                <span id="tb_1" class="t textPrior2">BELUM BAYAR </span>
                                <span id="tc_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP' }}" target="_blank">{{ number_format($total_belum_bayar) }}</a></span>
                                <span id="td_1" class="t textPrior1">OFFLINE: {{ number_format($total_offline) }} </span>
                                <span id="te_1" class="t textPrior2">OFFLINE: <a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=OFFLINE' }}" target="_blank">{{ number_format($total_offline) }}</a></span>
                                <span id="tf_1" class="t textPrior1">ONLINE: {{ number_format($total_online) }} </span>
                                <span id="tg_1" class="t textPrior2">ONLINE: <a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=ONLINE' }}" target="_blank">{{ number_format($total_online) }}</a></span>
                                <span id="th_1" class="t textPrior1">No Use 8 Days: {{ number_format($total_no_use8_days) }}</span>
                                <span id="ti_1" class="t textPrior1">No_Use_Month:  </span>
                                <span id="tj_1" class="t textPrior2">No Use 8 Days: <a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=ONLINE&detectusage=NO_USE_8DAYS' }}" target="_blank">{{ number_format($total_no_use8_days) }}</a></span>
                                <span id="tk_1" class="t textPrior2">No_Use_Month:  </span>
                                <span id="tl_1" class="t textPrior1">Normal Use </span>
                                <span id="tm_1" class="t textPrior1">{{ number_format($total_normal_use) }} </span>
                                <span id="tn_1" class="t textPrior2">Normal Use </span>
                                <span id="to_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=ONLINE&detectusage=NORMAL_USE' }}" target="_blank">{{ number_format($total_normal_use) }}</a></span>
                                <span id="tp_1" class="t textPrior1">ROC </span>
                                <span id="tq_1" class="t textPrior2">ROC </span>
                                <span id="tr_1" class="t textPrior1">Normal </span>
                                <span id="ts_1" class="t textPrior1">{{ number_format($total_normal_fup) }} </span>
                                <span id="tt_1" class="t textPrior2">Normal </span>
                                <span id="tu_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=ONLINE&detectusage=NORMAL_USE&statusfup=NORMAL' }}" target="_blank">{{ number_format($total_normal_fup) }}</a></span>
                                <span id="tv_1" class="t textPrior1">Over FUP </span>
                                <span id="tw_1" class="t textPrior1">{{ number_format($total_over_fup) }} </span>
                                <span id="tx_1" class="t textPrior2">Over FUP </span>
                                <span id="ty_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=ONLINE&detectusage=NORMAL_USE&statusfup=OVER_FUP' }}" target="_blank">{{ number_format($total_over_fup) }}</a></span>
                                <span id="tz_1" class="t textPrior1">Spec </span>
                                <span id="t10_1" class="t textPrior1">{{ number_format($total_spek) }} </span>
                                <span id="t11_1" class="t textPrior2">Spec </span>
                                <span id="t12_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=ONLINE&detectusage=NORMAL_USE&spekunspek=SPEK' }}" target="_blank">{{ number_format($total_spek) }}</a></span>
                                <span id="t13_1" class="t textPrior1">Underspec </span>
                                <span id="t14_1" class="t textPrior1">{{ number_format($total_unspek) }} </span>
                                <span id="t15_1" class="t textPrior2">Underspec </span>
                                <span id="t16_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=TETAP&onoff=ONLINE&detectusage=NORMAL_USE&spekunspek=UNSPEK' }}" target="_blank">{{ number_format($total_unspek) }}</a></span>
                                <span id="t17_1" class="t textPrior1">SUDAH BAYAR </span>
                                <span id="t18_1" class="t textPrior1">{{ number_format($total_sudah_bayar) }} </span>
                                <span id="t19_1" class="t textPrior2">SUDAH BAYAR </span>
                                <span id="t1a_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') .'?pergerakan_bill=BERGERAK' }}" target="_blank">{{ number_format($total_sudah_bayar) }}</a> </span>
                                <span id="t1b_1" class="t textPrior1">PRIO. 1 </span>
                                <span id="t1c_1" class="t textPrior1">{{ number_format($total_sudah_bayar + $total_belum_bayar) }} </span>
                                <span id="t1d_1" class="t textPrior2">PRIO. 1 </span>
                                <span id="t1e_1" class="t textPrior2"><a style="text-decoration: none;color:white" href="{{ route('admin.machine-learning.ct0-details') }}" target="_blank">{{ number_format($total_belum_bayar + $total_sudah_bayar) }}</a> </span>
                            </div>
                            <!-- End text definitions -->
        
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@endsection