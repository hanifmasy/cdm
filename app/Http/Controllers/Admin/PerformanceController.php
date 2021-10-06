<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PerformanceCsrdetailExport;
use App\Exports\PerformanceCsrExport;
use App\Exports\PerformancePlasaExport;
use App\Exports\ProvisioningExport;
use App\Exports\ProvisioningPlasaExport;
use App\Exports\RacingSvmExport;
use App\Exports\ReportPdaExport;
use App\Exports\ReportPedExport;
use App\Http\Controllers\Controller;
use App\Models\MigHomeWifi;
use App\Models\MigNonIndibox;
use App\Models\ReportPda;
use App\Models\ScAddonStatus;
use App\Models\ScPlasa;
use App\Models\StbTambahan;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Witel;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Rap2hpoutre\FastExcel\FastExcel;

class PerformanceController extends Controller
{
    public function addon(Request $request)
    {
        $current_month = date('Ym', strtotime('-1 day'));
        $last_month = date('Ym', strtotime('-1 month - 4 day'));

        $current_dt = date('M y', strtotime('-1 day'));
        $last_dt = date('M y', strtotime('-1 month - 4 day'));

        if ($request->ajax()) {

            $target_minipack = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'MINIPACK');

            $target_upgrade = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'UPGRADE SPEED');

            $target_mig2p3p = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'MIGRASI 3P');

            $target_stb = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'STB');

            $target_mig1p2p = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'MIGRASI 2P');

            $target_ottvideo = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'OTT VIDEO');

            if ($request->last_periode != '') {
                $last_periode = $request->last_periode;
                $filter_periode = $last_periode.'01';
                $next_periode = Carbon::parse($filter_periode)->addMonth(1)->format('Ym');
                $lb_next_periode = $next_periode.'01';
            }

            $current_dt = $request->last_periode ? Carbon::parse($lb_next_periode)->format('M y') : date('M y', strtotime('-1 day'));
            $last_dt = $request->last_periode ? Carbon::parse($filter_periode)->format('M y') : date('M y', strtotime('-1 month - 4 day'));


            if ($request->last_periode != '') {

                $target_minipack = $target_minipack->where('bulan', $next_periode);
                $target_upgrade = $target_upgrade->where('bulan', $next_periode);
                $target_mig2p3p = $target_mig2p3p->where('bulan', $next_periode);
                $target_stb = $target_stb->where('bulan', $next_periode);
                $target_mig1p2p = $target_mig1p2p->where('bulan', $next_periode);
                $target_ottvideo = $target_ottvideo->where('bulan', $next_periode);

                $minipack = DB::connection('pg2')->table('ditcons_minipack_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_periode' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$next_periode' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $upgrade = DB::connection('pg2')->table('ditcons_upgradespeed_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_periode' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$next_periode' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $mig2p3p = DB::connection('pg2')->table('ditcons_mig_2p3p_non_indibox_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_periode' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$next_periode' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $stb = DB::connection('pg2')->table('ditcons_stb_tambahan_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_periode' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$next_periode' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $mig1p2p = DB::connection('pg2')->table('ditcons_mig_1p2p_homewifi_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_periode' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$next_periode' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $ottvideo = DB::connection('pg2')->table('ditcons_ott_video_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_periode' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$next_periode' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

            } else {

                $target_minipack = $target_minipack->where('bulan', $current_month);
                $target_upgrade = $target_upgrade->where('bulan', $current_month);
                $target_mig2p3p = $target_mig2p3p->where('bulan', $current_month);
                $target_stb = $target_stb->where('bulan', $current_month);
                $target_mig1p2p = $target_mig1p2p->where('bulan', $current_month);
                $target_ottvideo = $target_ottvideo->where('bulan', $current_month);

                $minipack = DB::connection('pg2')->table('ditcons_minipack_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_month' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$current_month' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $upgrade = DB::connection('pg2')->table('ditcons_upgradespeed_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_month' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$current_month' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $mig2p3p = DB::connection('pg2')->table('ditcons_mig_2p3p_non_indibox_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_month' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$current_month' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $stb = DB::connection('pg2')->table('ditcons_stb_tambahan_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_month' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$current_month' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $mig1p2p = DB::connection('pg2')->table('ditcons_mig_1p2p_homewifi_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_month' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$current_month' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

                $ottvideo = DB::connection('pg2')->table('ditcons_ott_video_fixed')
                ->select(
                    DB::raw("(CASE
                        WHEN c_witel = '42' THEN 'KALBAR'
                        WHEN c_witel = '43' THEN 'KALTENG'
                        WHEN c_witel = '44' THEN 'KALSEL'
                        WHEN c_witel = '45' THEN 'BALIKPAPAN'
                        WHEN c_witel = '46' THEN 'SAMARINDA'
                        WHEN c_witel = '47' THEN 'KALTARA'
                        END) as witel"),
                    DB::raw("sum(CASE when report_month = '$last_month' and psb = '1' then 1 ELSE 0 END) as real_last_month"),
                    DB::raw("sum(CASE when report_month = '$current_month' and psb = '1' then 1 ELSE 0 END) as real_current_month"),
                );

            }

            $target_minipack = $target_minipack->groupBy('witel', 'bulan')->orderBy('witel', 'asc')->get()->toArray();
            $target_upgrade = $target_upgrade->groupBy('witel', 'bulan')->orderBy('witel', 'asc')->get()->toArray();
            $target_mig2p3p = $target_mig2p3p->groupBy('witel', 'bulan')->orderBy('witel', 'asc')->get()->toArray();
            $target_stb = $target_stb->groupBy('witel', 'bulan')->orderBy('witel', 'asc')->get()->toArray();
            $target_mig1p2p = $target_mig1p2p->groupBy('witel', 'bulan')->orderBy('witel', 'asc')->get()->toArray();
            $target_ottvideo = $target_ottvideo->groupBy('witel', 'bulan')->orderBy('witel', 'asc')->get()->toArray();

            $minipack = $minipack->groupBy('witel')->orderBy('witel', 'asc')->get()->toArray();
            $upgrade = $upgrade->groupBy('witel')->orderBy('witel', 'asc')->get()->toArray();
            $mig2p3p = $mig2p3p->groupBy('witel')->orderBy('witel', 'asc')->get()->toArray();
            $stb = $stb->groupBy('witel')->orderBy('witel', 'asc')->get()->toArray();
            $mig1p2p = $mig1p2p->groupBy('witel')->orderBy('witel', 'asc')->get()->toArray();
            $ottvideo = $ottvideo->groupBy('witel')->orderBy('witel', 'asc')->get()->toArray();

            for ($i = 0; $i < 6; $i++) {
                $minipack[$i]->target = $target_minipack[$i]->count;
                $upgrade[$i]->target = $target_upgrade[$i]->count;
                $mig2p3p[$i]->target = $target_mig2p3p[$i]->count;
                $stb[$i]->target = $target_stb[$i]->count;
                $mig1p2p[$i]->target = $target_mig1p2p[$i]->count;
                $ottvideo[$i]->target = $target_ottvideo[$i]->count;
            }

            $total_last_month_minipack = 0;
            $total_current_month_minipack = 0;
            $total_target_minipack = 0;

            $total_last_month_upgrade = 0;
            $total_current_month_upgrade = 0;
            $total_target_upgrade = 0;

            $total_last_month_mig2p3p = 0;
            $total_current_month_mig2p3p = 0;
            $total_target_mig2p3p = 0;

            $total_last_month_stb = 0;
            $total_current_month_stb = 0;
            $total_target_stb = 0;

            $total_last_month_mig1p2p = 0;
            $total_current_month_mig1p2p = 0;
            $total_target_mig1p2p = 0;

            $total_last_month_ottvideo = 0;
            $total_current_month_ottvideo = 0;
            $total_target_ottvideo = 0;

            foreach ($minipack as $val_minipack) {
                $total_last_month_minipack += $val_minipack->real_last_month;
                $total_current_month_minipack += $val_minipack->real_current_month;
                $total_target_minipack += $val_minipack->target;
            };

            foreach ($upgrade as $val_upgrade) {
                $total_last_month_upgrade += $val_upgrade->real_last_month;
                $total_current_month_upgrade += $val_upgrade->real_current_month;
                $total_target_upgrade += $val_upgrade->target;
            };

            foreach ($mig2p3p as $val_mig2p3p) {
                $total_last_month_mig2p3p += $val_mig2p3p->real_last_month;
                $total_current_month_mig2p3p += $val_mig2p3p->real_current_month;
                $total_target_mig2p3p += $val_mig2p3p->target;
            };

            foreach ($stb as $val_stb) {
                $total_last_month_stb += $val_stb->real_last_month;
                $total_current_month_stb += $val_stb->real_current_month;
                $total_target_stb += $val_stb->target;
            };

            foreach ($mig1p2p as $val_mig1p2p) {
                $total_last_month_mig1p2p += $val_mig1p2p->real_last_month;
                $total_current_month_mig1p2p += $val_mig1p2p->real_current_month;
                $total_target_mig1p2p += $val_mig1p2p->target;
            };

            foreach ($ottvideo as $val_ottvideo) {
                $total_last_month_ottvideo += $val_ottvideo->real_last_month;
                $total_current_month_ottvideo += $val_ottvideo->real_current_month;
                $total_target_ottvideo += $val_ottvideo->target;
            };


            $total_minipack[] = [
                'witel' => "TOTAL",
                'real_last_month' => $total_last_month_minipack,
                'real_current_month' => $total_current_month_minipack,
                'target' => $total_target_minipack
            ];

            $total_upgrade[] = [
                'witel' => "TOTAL",
                'real_last_month' => $total_last_month_upgrade,
                'real_current_month' => $total_current_month_upgrade,
                'target' => $total_target_upgrade
            ];

            $total_mig2p3p[] = [
                'witel' => "TOTAL",
                'real_last_month' => $total_last_month_mig2p3p,
                'real_current_month' => $total_current_month_mig2p3p,
                'target' => $total_target_mig2p3p
            ];

            $total_stb[] = [
                'witel' => "TOTAL",
                'real_last_month' => $total_last_month_stb,
                'real_current_month' => $total_current_month_stb,
                'target' => $total_target_stb
            ];

            $total_mig1p2p[] = [
                'witel' => "TOTAL",
                'real_last_month' => $total_last_month_mig1p2p,
                'real_current_month' => $total_current_month_mig1p2p,
                'target' => $total_target_mig1p2p
            ];

            $total_ottvideo[] = [
                'witel' => "TOTAL",
                'real_last_month' => $total_last_month_ottvideo,
                'real_current_month' => $total_current_month_ottvideo,
                'target' => $total_target_ottvideo
            ];

            $minipack = array_merge($minipack, $total_minipack);
            $upgrade = array_merge($upgrade, $total_upgrade);
            $mig2p3p = array_merge($mig2p3p, $total_mig2p3p);
            $stb = array_merge($stb, $total_stb);
            $mig1p2p = array_merge($mig1p2p, $total_mig1p2p);
            $ottvideo = array_merge($ottvideo, $total_ottvideo);

            $data = [
                'minipack' => $minipack,
                'upgrade' => $upgrade,
                'mig2p3p' => $mig2p3p,
                'stb' => $stb,
                'mig1p2p' => $mig1p2p,
                'ottvideo' => $ottvideo,
                'last_dt' => $last_dt,
                'current_dt' => $current_dt,
            ];

            return response()->json($data);

        }

        $periodes = DB::connection('pg2')->table('target_addon_2021')
            ->select('bulan')->where('bulan', '<', $current_month)->orderBy('bulan', 'desc')->distinct()->get();

        return view ('admin.reportCustomer.addon.index', compact('current_dt', 'last_dt', 'periodes'));
    }

    public function psaddon(Request $request)
    {
      $current = date('d M Y', strtotime('-1 day'));
      $last_m = date('d M Y', strtotime('-1 day -1 month'));
      $last_y = date('d M Y', strtotime('-1 day -1 year'));
      if($request->ajax()){
        $dt_alladdon = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(SUM(gr_fm*10)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(SUM(ach_mtd*10)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(SUM(gr_mtd*10)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(SUM(gr_yfm*10)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(SUM(ach_fy*10)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(SUM(ach_ytd*10)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(SUM(gr_ytd*10)::NUMERIC,1) as gr_ytd"),
        ))->groupBy("witel_str");
        $dt_minipack = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(SUM(gr_fm*100)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(SUM(ach_mtd*100)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(SUM(gr_mtd*100)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(SUM(gr_yfm*100)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(SUM(ach_fy*100)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(SUM(ach_ytd*100)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(SUM(gr_ytd*100)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','minipack')->groupBy("witel_str");
        $dt_upgrade = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(SUM(gr_fm*100)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(SUM(ach_mtd*100)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(SUM(gr_mtd*100)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(SUM(gr_yfm*100)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(SUM(ach_fy*100)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(SUM(ach_ytd*100)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(SUM(gr_ytd*100)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','upgrade')->groupBy("witel_str");
        $dt_stbtambahan = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(SUM(gr_fm*100)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(SUM(ach_mtd*100)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(SUM(gr_mtd*100)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(SUM(gr_yfm*100)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(SUM(ach_fy*100)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(SUM(ach_ytd*100)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(SUM(gr_ytd*100)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','stbtambahan')->groupBy("witel_str");
        $dt_ott = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(SUM(gr_fm*100)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(SUM(ach_mtd*100)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(SUM(gr_mtd*100)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(SUM(gr_yfm*100)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(SUM(ach_fy*100)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(SUM(ach_ytd*100)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(SUM(gr_ytd*100)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','ott')->groupBy("witel_str");
        $dt_mig2p3p = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(SUM(gr_fm*100)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(SUM(ach_mtd*100)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(SUM(gr_mtd*100)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(SUM(gr_yfm*100)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(SUM(ach_fy*100)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(SUM(ach_ytd*100)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(SUM(gr_ytd*100)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','mig2p3p')->groupBy("witel_str");
        $dt_mig1p2p = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(SUM(gr_fm*100)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(SUM(ach_mtd*100)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(SUM(gr_mtd*100)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(SUM(gr_yfm*100)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(SUM(ach_fy*100)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(SUM(ach_ytd*100)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(SUM(gr_ytd*100)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','mig1p2p')->groupBy("witel_str");

        $dt_total_alladdon = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("'TOTAL'::TEXT AS witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(((SUM(gr_fm*10))/6)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(((SUM(ach_mtd*10))/6)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(((SUM(gr_mtd*10))/6)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(((SUM(gr_yfm*10))/6)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(((SUM(ach_fy*10))/6)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(((SUM(ach_ytd*10))/6)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(((SUM(gr_ytd*10))/6)::NUMERIC,1) as gr_ytd"),
        ));
        $dt_total_minipack = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("'TOTAL'::TEXT AS witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(((SUM(gr_fm*100))/6)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(((SUM(ach_mtd*100))/6)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(((SUM(gr_mtd*100))/6)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(((SUM(gr_yfm*100))/6)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(((SUM(ach_fy*100))/6)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(((SUM(ach_ytd*100))/6)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(((SUM(gr_ytd*100))/6)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','minipack');
        $dt_total_upgrade = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("'TOTAL'::TEXT AS witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(((SUM(gr_fm*100))/6)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(((SUM(ach_mtd*100))/6)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(((SUM(gr_mtd*100))/6)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(((SUM(gr_yfm*100))/6)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(((SUM(ach_fy*100))/6)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(((SUM(ach_ytd*100))/6)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(((SUM(gr_ytd*100))/6)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','upgrade');
        $dt_total_stbtambahan = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("'TOTAL'::TEXT AS witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(((SUM(gr_fm*100))/6)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(((SUM(ach_mtd*100))/6)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(((SUM(gr_mtd*100))/6)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(((SUM(gr_yfm*100))/6)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(((SUM(ach_fy*100))/6)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(((SUM(ach_ytd*100))/6)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(((SUM(gr_ytd*100))/6)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','stbtambahan');
        $dt_total_ott = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("'TOTAL'::TEXT AS witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(((SUM(gr_fm*100))/6)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(((SUM(ach_mtd*100))/6)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(((SUM(gr_mtd*100))/6)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(((SUM(gr_yfm*100))/6)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(((SUM(ach_fy*100))/6)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(((SUM(ach_ytd*100))/6)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(((SUM(gr_ytd*100))/6)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','ott');
        $dt_total_mig2p3p = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("'TOTAL'::TEXT AS witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(((SUM(gr_fm*100))/6)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(((SUM(ach_mtd*100))/6)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(((SUM(gr_mtd*100))/6)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(((SUM(gr_yfm*100))/6)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(((SUM(ach_fy*100))/6)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(((SUM(ach_ytd*100))/6)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(((SUM(gr_ytd*100))/6)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','mig2p3p');
        $dt_total_mig1p2p = DB::connection('pg2')->table('daily_reporting_realisasi_target')->select(array(
          DB::raw("'TOTAL'::TEXT AS witel_str"),
          DB::raw("SUM(mtd_bln_lalu) as mtd_bln_lalu"),
          DB::raw("SUM(full_bln_lalu) as full_bln_lalu"),
          DB::raw("ROUND(((SUM(gr_fm*100))/6)::NUMERIC,1) as gr_fm"),
          DB::raw("SUM(target_fm) as target_fm"),
          DB::raw("SUM(mtd_bln_ini) as mtd_bln_ini"),
          DB::raw("ROUND(((SUM(ach_mtd*100))/6)::NUMERIC,1) as ach_mtd"),
          DB::raw("ROUND(((SUM(gr_mtd*100))/6)::NUMERIC,1) as gr_mtd"),
          DB::raw("SUM(ytd_thn_lalu) as ytd_thn_lalu"),
          DB::raw("SUM(full_thn_lalu) as full_thn_lalu"),
          DB::raw("ROUND(((SUM(gr_yfm*100))/6)::NUMERIC,1) as gr_yfm"),
          DB::raw("SUM(target_fy) as target_fy"),
          DB::raw("ROUND(((SUM(ach_fy*100))/6)::NUMERIC,1) as ach_fy"),
          DB::raw("SUM(target_ytd) as target_ytd"),
          DB::raw("SUM(ytd_thn_ini) as ytd_thn_ini"),
          DB::raw("ROUND(((SUM(ach_ytd*100))/6)::NUMERIC,1) as ach_ytd"),
          DB::raw("ROUND(((SUM(gr_ytd*100))/6)::NUMERIC,1) as gr_ytd"),
        ))->where('jenis_addon','mig1p2p');

        $table_alladdon = $dt_alladdon->get()->toArray();
        $total_alladdon = $dt_total_alladdon->get()->toArray();
        $table_minipack = $dt_minipack->get()->toArray();
        $total_minipack = $dt_total_minipack->get()->toArray();
        $table_upgrade = $dt_upgrade->get()->toArray();
        $total_upgrade = $dt_total_upgrade->get()->toArray();
        $table_stbtambahan = $dt_stbtambahan->get()->toArray();
        $total_stbtambahan = $dt_total_stbtambahan->get()->toArray();
        $table_ott = $dt_ott->get()->toArray();
        $total_ott = $dt_total_ott->get()->toArray();
        $table_mig2p3p = $dt_mig2p3p->get()->toArray();
        $total_mig2p3p = $dt_total_mig2p3p->get()->toArray();
        $table_mig1p2p = $dt_mig1p2p->get()->toArray();
        $total_mig1p2p = $dt_total_mig1p2p->get()->toArray();

        $alladdon = array_merge($table_alladdon,$total_alladdon);
        $minipack = array_merge($table_minipack,$total_minipack);
        $upgrade = array_merge($table_upgrade,$total_upgrade);
        $stbtambahan = array_merge($table_stbtambahan,$total_stbtambahan);
        $ott = array_merge($table_ott,$total_ott);
        $mig2p3p = array_merge($table_mig2p3p,$total_mig2p3p);
        $mig1p2p = array_merge($table_mig1p2p,$total_mig1p2p);

        $data = [
          'alladdon' => $alladdon,
          'minipack' => $minipack,
          'upgrade' => $upgrade,
          'stbtambahan' => $stbtambahan,
          'ott' => $ott,
          'mig2p3p' => $mig2p3p,
          'mig1p2p' => $mig1p2p,
        ];

        return response()->json($data);
      }

      return view('admin.reportCustomer.addon.psaddon', compact('current','last_m','last_y'));
    }

    public function psaddon_detail(Request $request){
      $query = DB::connection('pg2');

      if($request->ajax()){
        if(in_array($request->column,array('mtd_bln_lalu','full_bln_lalu','mtd_bln_ini','ytd_thn_lalu','full_thn_lalu','ytd_thn_ini'))){
            $query = $query->table(DB::raw("(
              SELECT *, 'upgrade'::TEXT AS jenis_addon FROM ditcons_upgradespeed_fixed UNION ALL
              SELECT *, 'minipack'::TEXT AS jenis_addon FROM ditcons_minipack_fixed UNION ALL
              SELECT *, 'stbtambahan'::TEXT AS jenis_addon FROM ditcons_stb_tambahan_fixed UNION ALL
              SELECT *, 'ott'::TEXT AS jenis_addon FROM ditcons_ott_video_fixed UNION ALL
              SELECT *, 'mig2p3p'::TEXT AS jenis_addon FROM ditcons_mig_2p3p_fixed UNION ALL
              SELECT *, 'mig1p2p'::TEXT AS jenis_addon FROM ditcons_mig_1p2p_fixed
              ) AS sub"))->select(DB::raw("sub.*"));
            if($request->addon != 'alladdon'){$query = $query->where(DB::raw("sub.jenis_addon"),'=',$request->addon);}
            if($request->witel_str == 'KALBAR'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'42'::TEXT"));}
            if($request->witel_str == 'KALTENG'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'43'::TEXT"));}
            if($request->witel_str == 'KALSEL'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'44'::TEXT"));}
            if($request->witel_str == 'BALIKPAPAN'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'45'::TEXT"));}
            if($request->witel_str == 'SAMARINDA'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'46'::TEXT"));}
            if($request->witel_str == 'KALTARA'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'47'::TEXT"));}
            if($request->column == 'mtd_bln_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=', DB::raw("TO_CHAR(DATE_TRUNC('MONTH'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 MON'::INTERVAL MONTH), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 MON'::INTERVAL MONTH - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
            if($request->column == 'full_bln_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMM'::TEXT)"),'=', DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 MON'::INTERVAL MONTH, 'YYYYMM'::TEXT)"));}
            if($request->column == 'mtd_bln_ini'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=',DB::raw("TO_CHAR(DATE_TRUNC('MONTH'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
            if($request->column == 'ytd_thn_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=',DB::raw("TO_CHAR(DATE_TRUNC('YEAR'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 YEAR'::INTERVAL YEAR), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 YEAR'::INTERVAL YEAR - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
            if($request->column == 'full_thn_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYY'::TEXT)"),'=',DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 YEAR'::INTERVAL YEAR, 'YYYY'::TEXT)"));}
            if($request->column == 'ytd_thn_ini'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=',DB::raw("TO_CHAR(DATE_TRUNC('YEAR'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
        }
        $query = $query->orderBy(DB::raw("sub.tgl_ps"),'desc');
        $data = $query->get();

        $table = DataTables::of($data);

        $table->addIndexColumn();

        $table->editColumn('ndinet', function ($row) {
            return $row->ndinet ? $row->ndinet : "";
        });
        $table->editColumn('ndem', function ($row) {
            return $row->ndem ? $row->ndem : "";
        });
        $table->editColumn('coper', function ($row) {
            return $row->coper ? $row->coper : "";
        });
        $table->editColumn('kcontact', function ($row) {
            return $row->kcontact ? $row->kcontact : "";
        });
        $table->editColumn('jenis_addon', function ($row) {
            return $row->jenis_addon ? $row->jenis_addon : "";
        });
        $table->editColumn('item', function ($row) {
            return $row->item ? $row->item : "";
        });
        $table->editColumn('cpack', function ($row) {
            return $row->cpack ? $row->cpack : "";
        });
        $table->editColumn('psb', function ($row) {
            return $row->psb ? $row->psb : "";
        });
        $table->editColumn('cbt', function ($row) {
            return $row->cbt ? $row->cbt : "";
        });
        $table->editColumn('mig', function ($row) {
            return $row->mig ? $row->mig : "";
        });
        $table->editColumn('price_psb', function ($row) {
            return $row->price_psb ? $row->price_psb : "";
        });
        $table->editColumn('price_cbt', function ($row) {
            return $row->price_cbt ? $row->price_cbt : "";
        });
        $table->editColumn('price_mig', function ($row) {
            return $row->price_mig ? $row->price_mig : "";
        });
        $table->editColumn('tgl_ps', function ($row) {
            return $row->tgl_ps ? $row->tgl_ps : "";
        });
        $table->editColumn('report_month', function ($row) {
            return $row->report_month ? $row->report_month : "";
        });

        return $table->make(true);
      }

      return view('admin.reportCustomer.addon.detail');
    }

    public function downloadPsaddonDetail(Request $request){
      $query = DB::connection('pg2');
        if(in_array($request->column,array('mtd_bln_lalu','full_bln_lalu','mtd_bln_ini','ytd_thn_lalu','full_thn_lalu','ytd_thn_ini'))){
            $query = $query->table(DB::raw("(
              SELECT *, 'upgrade'::TEXT AS jenis_addon FROM ditcons_upgradespeed_fixed UNION ALL
              SELECT *, 'minipack'::TEXT AS jenis_addon FROM ditcons_minipack_fixed UNION ALL
              SELECT *, 'stbtambahan'::TEXT AS jenis_addon FROM ditcons_stb_tambahan_fixed UNION ALL
              SELECT *, 'ott'::TEXT AS jenis_addon FROM ditcons_ott_video_fixed UNION ALL
              SELECT *, 'mig2p3p'::TEXT AS jenis_addon FROM ditcons_mig_2p3p_fixed UNION ALL
              SELECT *, 'mig1p2p'::TEXT AS jenis_addon FROM ditcons_mig_1p2p_fixed
              ) AS sub"))->select(DB::raw("sub.*"));
            if($request->addon != 'alladdon'){$query = $query->where(DB::raw("sub.jenis_addon"),'=',$request->addon);}
            if($request->witel_str == 'KALBAR'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'42'::TEXT"));}
            if($request->witel_str == 'KALTENG'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'43'::TEXT"));}
            if($request->witel_str == 'KALSEL'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'44'::TEXT"));}
            if($request->witel_str == 'BALIKPAPAN'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'45'::TEXT"));}
            if($request->witel_str == 'SAMARINDA'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'46'::TEXT"));}
            if($request->witel_str == 'KALTARA'){$query = $query->where(DB::raw("sub.c_witel::TEXT"),'=',DB::raw("'47'::TEXT"));}
            if($request->column == 'mtd_bln_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=', DB::raw("TO_CHAR(DATE_TRUNC('MONTH'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 MON'::INTERVAL MONTH), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 MON'::INTERVAL MONTH - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
            if($request->column == 'full_bln_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMM'::TEXT)"),'=', DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 MON'::INTERVAL MONTH, 'YYYYMM'::TEXT)"));}
            if($request->column == 'mtd_bln_ini'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=',DB::raw("TO_CHAR(DATE_TRUNC('MONTH'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
            if($request->column == 'ytd_thn_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=',DB::raw("TO_CHAR(DATE_TRUNC('YEAR'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 YEAR'::INTERVAL YEAR), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 YEAR'::INTERVAL YEAR - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
            if($request->column == 'full_thn_lalu'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYY'::TEXT)"),'=',DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY - '1 YEAR'::INTERVAL YEAR, 'YYYY'::TEXT)"));}
            if($request->column == 'ytd_thn_ini'){$query = $query->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'>=',DB::raw("TO_CHAR(DATE_TRUNC('YEAR'::TEXT, CURRENT_DATE - '1 DAY'::INTERVAL DAY), 'YYYYMMDD'::TEXT)"))->where(DB::raw("TO_CHAR(sub.tgl_ps, 'YYYYMMDD'::TEXT)"),'<=',DB::raw("TO_CHAR(CURRENT_DATE - '1 DAY'::INTERVAL DAY, 'YYYYMMDD'::TEXT)"));}
        }
        $query = $query->orderBy(DB::raw("sub.tgl_ps"),'desc');
        $data = $query->get();

        return (new FastExcel($data))->download('psaddon_detail.xlsx', function ($val) {
            return [
                'Nd Inet' => $val->ndinet,
                'Ndem' => $val->ndem,
                'Coper' => $val->coper,
                'Kcontact' => $val->kcontact,
                'Jenis Addon' => $val->jenis_addon,
                'Witel' => $val->c_witel,
                'STO' => $val->sto,
                'Channel' => $val->chanel,
                'Alpro' => $val->alpro,
                'Item' => $val->item,
                'Cpack' => $val->cpack,
                'PSB' => $val->psb,
                'CBT' => $val->cbt,
                'MIG' => $val->mig,
                'Price PSB' => $val->price_psb,
                'Price CBT' => $val->price_cbt,
                'Price MIG' => $val->price_mig,
                'Tgl PS' => $val->tgl_ps,
                'Report Month' => $val->report_month,
            ];
        });
  }

    public function racing_mic(Request $request)
    {
        $bulan1 = date('Ym', strtotime("-4 day"));
        $bulan2 = date('Ym', strtotime("-1 month - 4 day"));
        $bulan3 = date('Ym', strtotime("-2 month - 4 day"));
        $bulan4 = date('Ym', strtotime("-3 month - 4 day"));

        $dt_bln1 = date('F Y', strtotime("-4 day"));
        $dt_bln2 = date('F Y', strtotime("-1 month - 4 day"));
        $dt_bln3 = date('F Y', strtotime("-2 month - 4 day"));
        $dt_bln4 = date('F Y', strtotime("-3 month - 4 day"));

        $racing1 =  DB::connection('pg14')->table('racing_svm_fraud_score_fixed')->where('blnpsb', $bulan1)->orderBy('skor', 'desc')->get();
        $racing2 =  DB::connection('pg14')->table('racing_svm_fraud_score_fixed')->where('blnpsb', $bulan2)->orderBy('skor', 'desc')->get();
        $racing3 =  DB::connection('pg14')->table('racing_svm_fraud_score_fixed')->where('blnpsb', $bulan3)->orderBy('skor', 'desc')->get();
        $racing4 =  DB::connection('pg14')->table('racing_svm_fraud_score_fixed')->where('blnpsb', $bulan4)->orderBy('skor', 'desc')->get();

        $dt_bln = [
            'dt_bln1' => $dt_bln1,
            'dt_bln2' => $dt_bln2,
            'dt_bln3' => $dt_bln3,
            'dt_bln4' => $dt_bln4
        ];

        return view ('admin.racing.index', compact('racing1','racing2','racing3',
            'racing4', 'dt_bln'));
    }

    public function show_mic($blnpsb, $witel, $svm, Request $request)
    {
        if ($request->ajax()) {
            $query = DB::connection('pg14')->table('psb_join_svm_fraud_fixed')
            ->select(
                "nd_speedy", "inet_telp", "nama", "hape", "email", "witel", "agency", "chanel", "status_demand", "citem_speedy",
                "desc_pack_speedy", "reg_date", "tgl_ps", "channel_kcontack", "status_svm", 'hp_kcontact', 'status_svm_fraud'
            )
            ->where(DB::raw("TO_CHAR(tgl_ps, 'YYYYMM')"), $blnpsb)
            ->where('witel', $witel);

            if ($svm == "ALL") {
                $query = $query;
            } else if ($svm == "NULL") {
                $query = $query->whereNull('status_svm_fraud');
            } else {
                $query = $query->where('status_svm_fraud', $svm);
            }

            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('nd_speedy', function ($row) {
                return $row->nd_speedy ? $row->nd_speedy : "";
            });
            $table->editColumn('inet_telp', function ($row) {
                return $row->inet_telp ? $row->inet_telp : "";
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : "";
            });
            $table->editColumn('hape', function ($row) {
                return $row->hape ? $row->hape : "";
            });
            $table->editColumn('hp_kcontact', function ($row) {
                return $row->hp_kcontact ? $row->hp_kcontact : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('witel', function ($row) {
                return $row->witel ? $row->witel : "";
            });
            $table->editColumn('agency', function ($row) {
                return $row->agency ? $row->agency : "";
            });
            $table->editColumn('chanel', function ($row) {
                return $row->chanel ? $row->chanel : "";
            });
            $table->editColumn('status_demand', function ($row) {
                return $row->status_demand ? $row->status_demand : "";
            });
            $table->editColumn('citem_speedy', function ($row) {
                return $row->citem_speedy ? $row->citem_speedy : "";
            });
            $table->editColumn('desc_pack_speedy', function ($row) {
                return $row->desc_pack_speedy ? $row->desc_pack_speedy : "";
            });
            $table->editColumn('reg_date', function ($row) {
                return $row->reg_date ? $row->reg_date : "";
            });
            $table->editColumn('tgl_ps', function ($row) {
                return $row->tgl_ps ? $row->tgl_ps : "";
            });
            $table->editColumn('channel_kcontack', function ($row) {
                return $row->channel_kcontack ? $row->channel_kcontack : "";
            });
            $table->editColumn('status_svm', function ($row) {
                return $row->status_svm_fraud ? $row->status_svm_fraud : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }

        return view ('admin.racing.show');
    }

    public function downloadRacingSvm($blnpsb, $witel, $svm, Request $request)
    {
        $request['blnpsb'] = $blnpsb;
        $request['witel'] = $witel;
        $request['svm'] = $svm;

        return Excel::download(new RacingSvmExport($request->all()),'RacingSvm.xlsx');
    }

    public function provisioning(Request $request)
    {
        if ($request->ajax()) {
            // $request->session()->put('params', $request->all());

            if ($request->witel != '') {

                // if (($request->addon != '') && ($request->addon != 'minipack')) {
                //     $addon = $request->addon;
                // } else {
                //     $addon = 'minipack';
                // }

                // $query = DB::connection('pg15')->table('dashboard_provisioning_fixed')
                // ->select(
                //     "sto_str", "status_order",
                //     DB::raw("sum(total_$addon) as total"),
                // )
                // ->whereNotNull('status_order')
                // ->whereNotNull('witel_str')
                // ->groupBy("witel_str", "status_order")
                // ->get();

            } else {

                $q_total = DB::connection('pg15')->table('dashboard_provisioning');
                $query = DB::connection('pg15')->table('dashboard_provisioning');

                if (($request->addon != '') && ($request->addon != 'ALL_ADDON')) {
                    $addon = $request->addon;
                    $q_total = $q_total->select(
                        "status_order",
                        DB::raw("sum(total_$addon) as total"),
                    );

                    $query = $query->select(
                        "witel_str", "status_order",
                        DB::raw("sum(total_$addon) as total"),
                    );
                } else {
                    $q_total = $q_total->select(
                        "status_order",
                        DB::raw("sum(total) as total"),
                    );

                    $query = $query->select(
                        "witel_str", "status_order",
                        DB::raw("sum(total) as total"),
                    );
                }

                if (($request->segmen != '') && ($request->segmen != 'ALL_SEGMEN')) {
                    $segmen = $request->segmen;
                    $q_total = $q_total->where('plclbl_trems', $segmen);
                    $query = $query->where('plclbl_trems', $segmen);
                }

                $q_total = $q_total->whereNotNull('status_order')
                ->whereNotNull('witel_str')
                ->groupBy("status_order")
                ->get();

                $query = $query->whereNotNull('status_order')
                ->whereNotNull('witel_str')
                ->groupBy("witel_str", "status_order")
                ->get();

                foreach ($q_total as $item) {
                    $stats = $item->status_order;

                    if ($stats === "Wait For Approval Paperless") {
                        $wfap_total = $item->total;
                    } else if ($stats === "Wait For Upload Document Paperless") {
                        $wfudp_total = $item->total;
                    } else if ($stats === "MYCX  SEND OPEN PAPERLESS") {
                        $msop_total = $item->total;
                    } else if ($stats === "MYCX  FAIL") {
                        $mf_total = $item->total;
                    } else if ($stats === "FCC  HD1A  INVALID IDENTITY") {
                        $fhii_total = $item->total;
                    } else if ($stats === "ADDON  FAIL PROV") {
                        $afp_total = $item->total;
                    } else if ($stats === "4  NCX  CREATE ORDERFAIL") {
                        $ncof_total = $item->total;
                    } else if ($stats === "4  NCX  CREATE ORDER") {
                        $nco_total = $item->total;
                    } else if ($stats === "5  OSS  PROVISIONING START") {
                        $ops_total = $item->total;
                    } else if ($stats === "6  OSS  PROVISIONING DESAIN") {
                        $opd_total = $item->total;
                    } else if ($stats === "7  OSS  FALLOUT") {
                        $of_total = $item->total;
                    } else if ($stats === "7  OSS  PROVISIONING ISSUED") {
                        $opi_total = $item->total;
                    } else if ($stats === "Fallout Activation") {
                        $fa_total = $item->total;
                    } else if ($stats === "Fallout UIM") {
                        $fu_total = $item->total;
                    } else if ($stats === "Fallout WFM") {
                        $fw_total = $item->total;
                    } else if ($stats === "9  WFM  ACTIVATION COMPLETE") {
                        $wac_total = $item->total;
                    } else if ($stats === "OSS  TESTING SERVICE") {
                        $ots_total = $item->total;
                    } else if ($stats === "8  OSS  PONR") {
                        $op_total = $item->total;
                    } else if ($stats === "10  OSS  PROVISIONING COMPLETE") {
                        $opc_total = $item->total;
                    } else if ($stats === "11  TIBS  FULFILL BILLING FAIL") {
                        $tfbf_total = $item->total;
                    } else if ($stats === "11  TIBS  FULFILL BILLING START") {
                        $tfbs_total = $item->total;
                    } else if ($stats === "12  TIBS  FULFILL BILLING COMPLETED") {
                        $tfbc_total = $item->total;
                    }
                }

                foreach ($query as $val) {
                    $status = $val->status_order;

                    if ($val->witel_str == 'BALIKPAPAN') {
                        if ($status === "Wait For Approval Paperless") {
                            $wfap_balikpapan = $val->total;
                        } else if ($status === "Wait For Upload Document Paperless") {
                            $wfudp_balikpapan = $val->total;
                        } else if ($status === "MYCX  SEND OPEN PAPERLESS") {
                            $msop_balikpapan = $val->total;
                        } else if ($status === "MYCX  FAIL") {
                            $mf_balikpapan = $val->total;
                        } else if ($status === "FCC  HD1A  INVALID IDENTITY") {
                            $fhii_balikpapan = $val->total;
                        } else if ($status === "ADDON  FAIL PROV") {
                            $afp_balikpapan = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDERFAIL") {
                            $ncof_balikpapan = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDER") {
                            $nco_balikpapan = $val->total;
                        } else if ($status === "5  OSS  PROVISIONING START") {
                            $ops_balikpapan = $val->total;
                        } else if ($status === "6  OSS  PROVISIONING DESAIN") {
                            $opd_balikpapan = $val->total;
                        } else if ($status === "7  OSS  FALLOUT") {
                            $of_balikpapan = $val->total;
                        } else if ($status === "7  OSS  PROVISIONING ISSUED") {
                            $opi_balikpapan = $val->total;
                        } else if ($status === "Fallout Activation") {
                            $fa_balikpapan = $val->total;
                        } else if ($status === "Fallout UIM") {
                            $fu_balikpapan = $val->total;
                        } else if ($status === "Fallout WFM") {
                            $fw_balikpapan = $val->total;
                        } else if ($status === "9  WFM  ACTIVATION COMPLETE") {
                            $wac_balikpapan = $val->total;
                        } else if ($status === "OSS  TESTING SERVICE") {
                            $ots_balikpapan = $val->total;
                        } else if ($status === "8  OSS  PONR") {
                            $op_balikpapan = $val->total;
                        } else if ($status === "10  OSS  PROVISIONING COMPLETE") {
                            $opc_balikpapan = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING FAIL") {
                            $tfbf_balikpapan = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING START") {
                            $tfbs_balikpapan = $val->total;
                        } else if ($status === "12  TIBS  FULFILL BILLING COMPLETED") {
                            $tfbc_balikpapan = $val->total;
                        }
                    }
                    else if ($val->witel_str == 'KALBAR') {
                        if ($status === "Wait For Approval Paperless") {
                            $wfap_kalbar = $val->total;
                        } else if ($status === "Wait For Upload Document Paperless") {
                            $wfudp_kalbar = $val->total;
                        } else if ($status === "MYCX  SEND OPEN PAPERLESS") {
                            $msop_kalbar = $val->total;
                        } else if ($status === "MYCX  FAIL") {
                            $mf_kalbar = $val->total;
                        } else if ($status === "FCC  HD1A  INVALID IDENTITY") {
                            $fhii_kalbar = $val->total;
                        } else if ($status === "ADDON  FAIL PROV") {
                            $afp_kalbar = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDERFAIL") {
                            $ncof_kalbar = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDER") {
                            $nco_kalbar = $val->total;
                        } else if ($status === "5  OSS  PROVISIONING START") {
                            $ops_kalbar = $val->total;
                        } else if ($status === "6  OSS  PROVISIONING DESAIN") {
                            $opd_kalbar = $val->total;
                        } else if ($status === "7  OSS  FALLOUT") {
                            $of_kalbar = $val->total;
                        } else if ($status === "7  OSS  PROVISIONING ISSUED") {
                            $opi_kalbar = $val->total;
                        } else if ($status === "Fallout Activation") {
                            $fa_kalbar = $val->total;
                        } else if ($status === "Fallout UIM") {
                            $fu_kalbar = $val->total;
                        } else if ($status === "Fallout WFM") {
                            $fw_kalbar = $val->total;
                        } else if ($status === "9  WFM  ACTIVATION COMPLETE") {
                            $wac_kalbar = $val->total;
                        } else if ($status === "OSS  TESTING SERVICE") {
                            $ots_kalbar = $val->total;
                        } else if ($status === "8  OSS  PONR") {
                            $op_kalbar = $val->total;
                        } else if ($status === "10  OSS  PROVISIONING COMPLETE") {
                            $opc_kalbar = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING FAIL") {
                            $tfbf_kalbar = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING START") {
                            $tfbs_kalbar = $val->total;
                        } else if ($status === "12  TIBS  FULFILL BILLING COMPLETED") {
                            $tfbc_kalbar = $val->total;
                        }
                    }
                    else if ($val->witel_str == 'KALSEL') {
                        if ($status === "Wait For Approval Paperless") {
                            $wfap_kalsel = $val->total;
                        } else if ($status === "Wait For Upload Document Paperless") {
                            $wfudp_kalsel = $val->total;
                        } else if ($status === "MYCX  SEND OPEN PAPERLESS") {
                            $msop_kalsel = $val->total;
                        } else if ($status === "MYCX  FAIL") {
                            $mf_kalsel = $val->total;
                        } else if ($status === "FCC  HD1A  INVALID IDENTITY") {
                            $fhii_kalsel = $val->total;
                        } else if ($status === "ADDON  FAIL PROV") {
                            $afp_kalsel = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDERFAIL") {
                            $ncof_kalsel = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDER") {
                            $nco_kalsel = $val->total;
                        } else if ($status === "5  OSS  PROVISIONING START") {
                            $ops_kalsel = $val->total;
                        } else if ($status === "6  OSS  PROVISIONING DESAIN") {
                            $opd_kalsel = $val->total;
                        } else if ($status === "7  OSS  FALLOUT") {
                            $of_kalsel = $val->total;
                        } else if ($status === "7  OSS  PROVISIONING ISSUED") {
                            $opi_kalsel = $val->total;
                        } else if ($status === "Fallout Activation") {
                            $fa_kalsel = $val->total;
                        } else if ($status === "Fallout UIM") {
                            $fu_kalsel = $val->total;
                        } else if ($status === "Fallout WFM") {
                            $fw_kalsel = $val->total;
                        } else if ($status === "9  WFM  ACTIVATION COMPLETE") {
                            $wac_kalsel = $val->total;
                        } else if ($status === "OSS  TESTING SERVICE") {
                            $ots_kalsel = $val->total;
                        } else if ($status === "8  OSS  PONR") {
                            $op_kalsel = $val->total;
                        } else if ($status === "10  OSS  PROVISIONING COMPLETE") {
                            $opc_kalsel = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING FAIL") {
                            $tfbf_kalsel = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING START") {
                            $tfbs_kalsel = $val->total;
                        } else if ($status === "12  TIBS  FULFILL BILLING COMPLETED") {
                            $tfbc_kalsel = $val->total;
                        }
                    }
                    else if ($val->witel_str == 'KALTARA') {
                        if ($status === "Wait For Approval Paperless") {
                            $wfap_kaltara = $val->total;
                        } else if ($status === "Wait For Upload Document Paperless") {
                            $wfudp_kaltara = $val->total;
                        } else if ($status === "MYCX  SEND OPEN PAPERLESS") {
                            $msop_kaltara = $val->total;
                        } else if ($status === "MYCX  FAIL") {
                            $mf_kaltara = $val->total;
                        } else if ($status === "FCC  HD1A  INVALID IDENTITY") {
                            $fhii_kaltara = $val->total;
                        } else if ($status === "ADDON  FAIL PROV") {
                            $afp_kaltara = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDERFAIL") {
                            $ncof_kaltara = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDER") {
                            $nco_kaltara = $val->total;
                        } else if ($status === "5  OSS  PROVISIONING START") {
                            $ops_kaltara = $val->total;
                        } else if ($status === "6  OSS  PROVISIONING DESAIN") {
                            $opd_kaltara = $val->total;
                        } else if ($status === "7  OSS  FALLOUT") {
                            $of_kaltara = $val->total;
                        } else if ($status === "7  OSS  PROVISIONING ISSUED") {
                            $opi_kaltara = $val->total;
                        } else if ($status === "Fallout Activation") {
                            $fa_kaltara = $val->total;
                        } else if ($status === "Fallout UIM") {
                            $fu_kaltara = $val->total;
                        } else if ($status === "Fallout WFM") {
                            $fw_kaltara = $val->total;
                        } else if ($status === "9  WFM  ACTIVATION COMPLETE") {
                            $wac_kaltara = $val->total;
                        } else if ($status === "OSS  TESTING SERVICE") {
                            $ots_kaltara = $val->total;
                        } else if ($status === "8  OSS  PONR") {
                            $op_kaltara = $val->total;
                        } else if ($status === "10  OSS  PROVISIONING COMPLETE") {
                            $opc_kaltara = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING FAIL") {
                            $tfbf_kaltara = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING START") {
                            $tfbs_kaltara = $val->total;
                        } else if ($status === "12  TIBS  FULFILL BILLING COMPLETED") {
                            $tfbc_kaltara = $val->total;
                        }
                    }
                    else if ($val->witel_str == 'KALTENG') {
                        if ($status === "Wait For Approval Paperless") {
                            $wfap_kalteng = $val->total;
                        } else if ($status === "Wait For Upload Document Paperless") {
                            $wfudp_kalteng = $val->total;
                        } else if ($status === "MYCX  SEND OPEN PAPERLESS") {
                            $msop_kalteng = $val->total;
                        } else if ($status === "MYCX  FAIL") {
                            $mf_kalteng = $val->total;
                        } else if ($status === "FCC  HD1A  INVALID IDENTITY") {
                            $fhii_kalteng = $val->total;
                        } else if ($status === "ADDON  FAIL PROV") {
                            $afp_kalteng = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDERFAIL") {
                            $ncof_kalteng = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDER") {
                            $nco_kalteng = $val->total;
                        } else if ($status === "5  OSS  PROVISIONING START") {
                            $ops_kalteng = $val->total;
                        } else if ($status === "6  OSS  PROVISIONING DESAIN") {
                            $opd_kalteng = $val->total;
                        } else if ($status === "7  OSS  FALLOUT") {
                            $of_kalteng = $val->total;
                        } else if ($status === "7  OSS  PROVISIONING ISSUED") {
                            $opi_kalteng = $val->total;
                        } else if ($status === "Fallout Activation") {
                            $fa_kalteng = $val->total;
                        } else if ($status === "Fallout UIM") {
                            $fu_kalteng = $val->total;
                        } else if ($status === "Fallout WFM") {
                            $fw_kalteng = $val->total;
                        } else if ($status === "9  WFM  ACTIVATION COMPLETE") {
                            $wac_kalteng = $val->total;
                        } else if ($status === "OSS  TESTING SERVICE") {
                            $ots_kalteng = $val->total;
                        } else if ($status === "8  OSS  PONR") {
                            $op_kalteng = $val->total;
                        } else if ($status === "10  OSS  PROVISIONING COMPLETE") {
                            $opc_kalteng = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING FAIL") {
                            $tfbf_kalteng = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING START") {
                            $tfbs_kalteng = $val->total;
                        } else if ($status === "12  TIBS  FULFILL BILLING COMPLETED") {
                            $tfbc_kalteng = $val->total;
                        }
                    }
                    else if ($val->witel_str == 'SAMARINDA') {
                        if ($status === "Wait For Approval Paperless") {
                            $wfap_samarinda = $val->total;
                        } else if ($status === "Wait For Upload Document Paperless") {
                            $wfudp_samarinda = $val->total;
                        } else if ($status === "MYCX  SEND OPEN PAPERLESS") {
                            $msop_samarinda = $val->total;
                        } else if ($status === "MYCX  FAIL") {
                            $mf_samarinda = $val->total;
                        } else if ($status === "FCC  HD1A  INVALID IDENTITY") {
                            $fhii_samarinda = $val->total;
                        } else if ($status === "ADDON  FAIL PROV") {
                            $afp_samarinda = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDERFAIL") {
                            $ncof_samarinda = $val->total;
                        } else if ($status === "4  NCX  CREATE ORDER") {
                            $nco_samarinda = $val->total;
                        } else if ($status === "5  OSS  PROVISIONING START") {
                            $ops_samarinda = $val->total;
                        } else if ($status === "6  OSS  PROVISIONING DESAIN") {
                            $opd_samarinda = $val->total;
                        } else if ($status === "7  OSS  FALLOUT") {
                            $of_samarinda = $val->total;
                        } else if ($status === "7  OSS  PROVISIONING ISSUED") {
                            $opi_samarinda = $val->total;
                        } else if ($status === "Fallout Activation") {
                            $fa_samarinda = $val->total;
                        } else if ($status === "Fallout UIM") {
                            $fu_samarinda = $val->total;
                        } else if ($status === "Fallout WFM") {
                            $fw_samarinda = $val->total;
                        } else if ($status === "9  WFM  ACTIVATION COMPLETE") {
                            $wac_samarinda = $val->total;
                        } else if ($status === "OSS  TESTING SERVICE") {
                            $ots_samarinda = $val->total;
                        } else if ($status === "8  OSS  PONR") {
                            $op_samarinda = $val->total;
                        } else if ($status === "10  OSS  PROVISIONING COMPLETE") {
                            $opc_samarinda = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING FAIL") {
                            $tfbf_samarinda = $val->total;
                        } else if ($status === "11  TIBS  FULFILL BILLING START") {
                            $tfbs_samarinda = $val->total;
                        } else if ($status === "12  TIBS  FULFILL BILLING COMPLETED") {
                            $tfbc_samarinda = $val->total;
                        }
                    }
                }

                $arr_treg_addon = [];

                $arr_balikpapan = [
                    'vwitel' => "BALIKPAPAN",
                    'v1' => @$wfap_balikpapan ? $wfap_balikpapan : '-',
                    'v2' => @$wfudp_balikpapan ? $wfudp_balikpapan : '-',
                    'v3' => @$msop_balikpapan ? $msop_balikpapan : '-',
                    'v4' => @$mf_balikpapan ? $mf_balikpapan : '-',
                    'v5' => @$fhii_balikpapan ? $fhii_balikpapan : '-',
                    'v6' => @$afp_balikpapan ? $afp_balikpapan : '-',
                    'v7' => @$ncof_balikpapan ? $ncof_balikpapan : '-',
                    'v8' => @$nco_balikpapan ? $nco_balikpapan : '-',
                    'v9' => @$ops_balikpapan ? $ops_balikpapan : '-',
                    'v10' => @$opd_balikpapan ? $opd_balikpapan : '-',
                    'v11' => @$of_balikpapan ? $of_balikpapan : '-',
                    'v12' => @$opi_balikpapan ? $opi_balikpapan : '-',
                    'v13' => @$fa_balikpapan ? $fa_balikpapan : '-',
                    'v14' => @$fu_balikpapan ? $fu_balikpapan : '-',
                    'v15' => @$fw_balikpapan ? $fw_balikpapan : '-',
                    'v16' => @$wac_balikpapan ? $wac_balikpapan : '-',
                    'v17' => @$ots_balikpapan ? $ots_balikpapan : '-',
                    'v18' => @$op_balikpapan ? $op_balikpapan : '-',
                    'v19' => @$opc_balikpapan ? $opc_balikpapan : '-',
                    'v20' => @$tfbf_balikpapan ? $tfbf_balikpapan : '-',
                    'v21' => @$tfbs_balikpapan ? $tfbs_balikpapan : '-',
                    'v22' => @$tfbc_balikpapan ? $tfbc_balikpapan : '-'
                ];
                $total_balikpapan = array_sum($arr_balikpapan);
                $arr_balikpapan['total'] = $total_balikpapan;
                array_push($arr_treg_addon, $arr_balikpapan);

                $arr_kalbar = [
                    'vwitel' => "KALBAR",
                    'v1' => @$wfap_kalbar ? $wfap_kalbar : '-',
                    'v2' => @$wfudp_kalbar ? $wfudp_kalbar : '-',
                    'v3' => @$msop_kalbar ? $msop_kalbar : '-',
                    'v4' => @$mf_kalbar ? $mf_kalbar : '-',
                    'v5' => @$fhii_kalbar ? $fhii_kalbar : '-',
                    'v6' => @$afp_kalbar ? $afp_kalbar : '-',
                    'v7' => @$ncof_kalbar ? $ncof_kalbar : '-',
                    'v8' => @$nco_kalbar ? $nco_kalbar : '-',
                    'v9' => @$ops_kalbar ? $ops_kalbar : '-',
                    'v10' => @$opd_kalbar ? $opd_kalbar : '-',
                    'v11' => @$of_kalbar ? $of_kalbar : '-',
                    'v12' => @$opi_kalbar ? $opi_kalbar : '-',
                    'v13' => @$fa_kalbar ? $fa_kalbar : '-',
                    'v14' => @$fu_kalbar ? $fu_kalbar : '-',
                    'v15' => @$fw_kalbar ? $fw_kalbar : '-',
                    'v16' => @$wac_kalbar ? $wac_kalbar : '-',
                    'v17' => @$ots_kalbar ? $ots_kalbar : '-',
                    'v18' => @$op_kalbar ? $op_kalbar : '-',
                    'v19' => @$opc_kalbar ? $opc_kalbar : '-',
                    'v20' => @$tfbf_kalbar ? $tfbf_kalbar : '-',
                    'v21' => @$tfbs_kalbar ? $tfbs_kalbar : '-',
                    'v22' => @$tfbc_kalbar ? $tfbc_kalbar : '-'
                ];
                $total_kalbar = array_sum($arr_kalbar);
                $arr_kalbar['total'] = $total_kalbar;
                array_push($arr_treg_addon, $arr_kalbar);

                $arr_kalsel = [
                    'vwitel' => "KALSEL",
                    'v1' => @$wfap_kalsel ? $wfap_kalsel : '-',
                    'v2' => @$wfudp_kalsel ? $wfudp_kalsel : '-',
                    'v3' => @$msop_kalsel ? $msop_kalsel : '-',
                    'v4' => @$mf_kalsel ? $mf_kalsel : '-',
                    'v5' => @$fhii_kalsel ? $fhii_kalsel : '-',
                    'v6' => @$afp_kalsel ? $afp_kalsel : '-',
                    'v7' => @$ncof_kalsel ? $ncof_kalsel : '-',
                    'v8' => @$nco_kalsel ? $nco_kalsel : '-',
                    'v9' => @$ops_kalsel ? $ops_kalsel : '-',
                    'v10' => @$opd_kalsel ? $opd_kalsel : '-',
                    'v11' => @$of_kalsel ? $of_kalsel : '-',
                    'v12' => @$opi_kalsel ? $opi_kalsel : '-',
                    'v13' => @$fa_kalsel ? $fa_kalsel : '-',
                    'v14' => @$fu_kalsel ? $fu_kalsel : '-',
                    'v15' => @$fw_kalsel ? $fw_kalsel : '-',
                    'v16' => @$wac_kalsel ? $wac_kalsel : '-',
                    'v17' => @$ots_kalsel ? $ots_kalsel : '-',
                    'v18' => @$op_kalsel ? $op_kalsel : '-',
                    'v19' => @$opc_kalsel ? $opc_kalsel : '-',
                    'v20' => @$tfbf_kalsel ? $tfbf_kalsel : '-',
                    'v21' => @$tfbs_kalsel ? $tfbs_kalsel : '-',
                    'v22' => @$tfbc_kalsel ? $tfbc_kalsel : '-'
                ];
                $total_kalsel = array_sum($arr_kalsel);
                $arr_kalsel['total'] = $total_kalsel;
                array_push($arr_treg_addon, $arr_kalsel);

                $arr_kaltara = [
                    'vwitel' => "KALTARA",
                    'v1' => @$wfap_kaltara ? $wfap_kaltara : '-',
                    'v2' => @$wfudp_kaltara ? $wfudp_kaltara : '-',
                    'v3' => @$msop_kaltara ? $msop_kaltara : '-',
                    'v4' => @$mf_kaltara ? $mf_kaltara : '-',
                    'v5' => @$fhii_kaltara ? $fhii_kaltara : '-',
                    'v6' => @$afp_kaltara ? $afp_kaltara : '-',
                    'v7' => @$ncof_kaltara ? $ncof_kaltara : '-',
                    'v8' => @$nco_kaltara ? $nco_kaltara : '-',
                    'v9' => @$ops_kaltara ? $ops_kaltara : '-',
                    'v10' => @$opd_kaltara ? $opd_kaltara : '-',
                    'v11' => @$of_kaltara ? $of_kaltara : '-',
                    'v12' => @$opi_kaltara ? $opi_kaltara : '-',
                    'v13' => @$fa_kaltara ? $fa_kaltara : '-',
                    'v14' => @$fu_kaltara ? $fu_kaltara : '-',
                    'v15' => @$fw_kaltara ? $fw_kaltara : '-',
                    'v16' => @$wac_kaltara ? $wac_kaltara : '-',
                    'v17' => @$ots_kaltara ? $ots_kaltara : '-',
                    'v18' => @$op_kaltara ? $op_kaltara : '-',
                    'v19' => @$opc_kaltara ? $opc_kaltara : '-',
                    'v20' => @$tfbf_kaltara ? $tfbf_kaltara : '-',
                    'v21' => @$tfbs_kaltara ? $tfbs_kaltara : '-',
                    'v22' => @$tfbc_kaltara ? $tfbc_kaltara : '-'
                ];
                $total_kaltara = array_sum($arr_kaltara);
                $arr_kaltara['total'] = $total_kaltara;
                array_push($arr_treg_addon, $arr_kaltara);

                $arr_kalteng = [
                    'vwitel' => "KALTENG",
                    'v1' => @$wfap_kalteng ? $wfap_kalteng : '-',
                    'v2' => @$wfudp_kalteng ? $wfudp_kalteng : '-',
                    'v3' => @$msop_kalteng ? $msop_kalteng : '-',
                    'v4' => @$mf_kalteng ? $mf_kalteng : '-',
                    'v5' => @$fhii_kalteng ? $fhii_kalteng : '-',
                    'v6' => @$afp_kalteng ? $afp_kalteng : '-',
                    'v7' => @$ncof_kalteng ? $ncof_kalteng : '-',
                    'v8' => @$nco_kalteng ? $nco_kalteng : '-',
                    'v9' => @$ops_kalteng ? $ops_kalteng : '-',
                    'v10' => @$opd_kalteng ? $opd_kalteng : '-',
                    'v11' => @$of_kalteng ? $of_kalteng : '-',
                    'v12' => @$opi_kalteng ? $opi_kalteng : '-',
                    'v13' => @$fa_kalteng ? $fa_kalteng : '-',
                    'v14' => @$fu_kalteng ? $fu_kalteng : '-',
                    'v15' => @$fw_kalteng ? $fw_kalteng : '-',
                    'v16' => @$wac_kalteng ? $wac_kalteng : '-',
                    'v17' => @$ots_kalteng ? $ots_kalteng : '-',
                    'v18' => @$op_kalteng ? $op_kalteng : '-',
                    'v19' => @$opc_kalteng ? $opc_kalteng : '-',
                    'v20' => @$tfbf_kalteng ? $tfbf_kalteng : '-',
                    'v21' => @$tfbs_kalteng ? $tfbs_kalteng : '-',
                    'v22' => @$tfbc_kalteng ? $tfbc_kalteng : '-'
                ];
                $total_kalteng = array_sum($arr_kalteng);
                $arr_kalteng['total'] = $total_kalteng;
                array_push($arr_treg_addon, $arr_kalteng);

                $arr_samarinda = [
                    'vwitel' => "SAMARINDA",
                    'v1' => @$wfap_samarinda ? $wfap_samarinda : '-',
                    'v2' => @$wfudp_samarinda ? $wfudp_samarinda : '-',
                    'v3' => @$msop_samarinda ? $msop_samarinda : '-',
                    'v4' => @$mf_samarinda ? $mf_samarinda : '-',
                    'v5' => @$fhii_samarinda ? $fhii_samarinda : '-',
                    'v6' => @$afp_samarinda ? $afp_samarinda : '-',
                    'v7' => @$ncof_samarinda ? $ncof_samarinda : '-',
                    'v8' => @$nco_samarinda ? $nco_samarinda : '-',
                    'v9' => @$ops_samarinda ? $ops_samarinda : '-',
                    'v10' => @$opd_samarinda ? $opd_samarinda : '-',
                    'v11' => @$of_samarinda ? $of_samarinda : '-',
                    'v12' => @$opi_samarinda ? $opi_samarinda : '-',
                    'v13' => @$fa_samarinda ? $fa_samarinda : '-',
                    'v14' => @$fu_samarinda ? $fu_samarinda : '-',
                    'v15' => @$fw_samarinda ? $fw_samarinda : '-',
                    'v16' => @$wac_samarinda ? $wac_samarinda : '-',
                    'v17' => @$ots_samarinda ? $ots_samarinda : '-',
                    'v18' => @$op_samarinda ? $op_samarinda : '-',
                    'v19' => @$opc_samarinda ? $opc_samarinda : '-',
                    'v20' => @$tfbf_samarinda ? $tfbf_samarinda : '-',
                    'v21' => @$tfbs_samarinda ? $tfbs_samarinda : '-',
                    'v22' => @$tfbc_samarinda ? $tfbc_samarinda : '-'
                ];
                $total_samarinda = array_sum($arr_samarinda);
                $arr_samarinda['total'] = $total_samarinda;
                array_push($arr_treg_addon, $arr_samarinda);

                $arr_total = [
                    'vwitel' => "ALL",
                    'v1' => @$wfap_total ? $wfap_total : '-',
                    'v2' => @$wfudp_total ? $wfudp_total : '-',
                    'v3' => @$msop_total ? $msop_total : '-',
                    'v4' => @$mf_total ? $mf_total : '-',
                    'v5' => @$fhii_total ? $fhii_total : '-',
                    'v6' => @$afp_total ? $afp_total : '-',
                    'v7' => @$ncof_total ? $ncof_total : '-',
                    'v8' => @$nco_total ? $nco_total : '-',
                    'v9' => @$ops_total ? $ops_total : '-',
                    'v10' => @$opd_total ? $opd_total : '-',
                    'v11' => @$of_total ? $of_total : '-',
                    'v12' => @$opi_total ? $opi_total : '-',
                    'v13' => @$fa_total ? $fa_total : '-',
                    'v14' => @$fu_total ? $fu_total : '-',
                    'v15' => @$fw_total ? $fw_total : '-',
                    'v16' => @$wac_total ? $wac_total : '-',
                    'v17' => @$ots_total ? $ots_total : '-',
                    'v18' => @$op_total ? $op_total : '-',
                    'v19' => @$opc_total ? $opc_total : '-',
                    'v20' => @$tfbf_total ? $tfbf_total : '-',
                    'v21' => @$tfbs_total ? $tfbs_total : '-',
                    'v22' => @$tfbc_total ? $tfbc_total : '-'
                ];
                $grand_total = array_sum($arr_total);
                $arr_total['total'] = $grand_total;
                array_push($arr_treg_addon, $arr_total);


                $data = [
                    'treg_addon' => $arr_treg_addon
                ];

            }

            return response()->json($data);

        }

        return view('admin.provisioning.index');
    }

    public function show_provisioning($addon, $segmen, $witel, $status, Request $request)
    {
        if ($request->ajax()) {

            $query = ScAddonStatus::select(
                "order_id", "internet", "pots", "nama_pelanggan", "no_hp", "witel_str",
                "sto_str", "item", "status_order", "kcontact", "lcat_name", "segmen", "durasijam", "speed_before",
                "speed_req", "plclbl_trems", "ccat", "create_dtm", "update_dtm"
            );

            if ($addon == "ALL_ADDON") {
                $query = $query->where(function ($query) {
                    $query->where("minipack", 'OK')
                    ->orwhere("upgrade", 'OK')
                    ->orWhere("mig2p3p", 'OK')
                    ->orWhere("stb_tambahan", 'OK')
                    ->orWhere("plc", 'OK')
                    ->orWhere("mig1p2p", 'OK');
                })
                ->whereNotNull('status_order')
                ->whereNotNull('witel_str')
                ->whereNotNull('witel');
            } else {
                $query = $query->where("$addon", 'OK');
            }

            if ($segmen == "ALL_SEGMEN") {
                $query = $query;
            } else {
                $query = $query->where('plclbl_trems', $segmen);
            }

            if ($witel == "ALL") {
                $query = $query;
            } else {
                $query = $query->where('witel_str', $witel);
            }

            if ($status == "ALL_STATUS") {
                $query = $query->where(DB::raw('upper(status_order)'), 'NOT LIKE', '%CANCEL%')
                    ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%EAI  WAIT FOR EAI PROGRESS%')
                    ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%EAI  COMPLETED%')
                    ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%TSEL%')
                    ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%SOA%');
            } else {
                $query = $query->where('status_order', $status);
            }

            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('order_id', function ($row) {
                return $row->order_id ? $row->order_id : "";
            });
            $table->editColumn('internet', function ($row) {
                return $row->internet ? $row->internet : "";
            });
            $table->editColumn('pots', function ($row) {
                return $row->pots ? $row->pots : "";
            });
            $table->editColumn('nama_pelanggan', function ($row) {
                return $row->nama_pelanggan ? $row->nama_pelanggan : "";
            });
            $table->editColumn('no_hp', function ($row) {
                return $row->no_hp ? $row->no_hp : "";
            });
            $table->editColumn('witel_str', function ($row) {
                return $row->witel_str ? $row->witel_str : "";
            });
            $table->editColumn('sto_str', function ($row) {
                return $row->sto_str ? $row->sto_str : "";
            });
            $table->editColumn('item', function ($row) {
                return $row->item ? $row->item : "";
            });
            $table->editColumn('status_order', function ($row) {
                return $row->status_order ? $row->status_order : "";
            });
            $table->editColumn('kcontact', function ($row) {
                return $row->kcontact ? $row->kcontact : "";
            });
            $table->editColumn('lcat_name', function ($row) {
                return $row->lcat_name ? $row->lcat_name : "";
            });
            $table->editColumn('durasijam', function ($row) {
                return $row->durasijam ? $row->durasijam . " jam" : "";
            });
            $table->editColumn('speed_before', function ($row) {
                return $row->speed_before ? $row->speed_before . " Mbps" : "";
            });
            $table->editColumn('speed_req', function ($row) {
                return $row->speed_req ? $row->speed_req . " Mbps" : "";
            });
            $table->editColumn('plclbl_trems', function ($row) {
                return $row->plclbl_trems ? $row->plclbl_trems : "";
            });
            $table->editColumn('ccat', function ($row) {
                return $row->ccat ? $row->ccat : "";
            });
            $table->editColumn('create_dtm', function ($row) {
                return $row->create_dtm ? $row->create_dtm : "";
            });
            $table->editColumn('update_dtm', function ($row) {
                return $row->update_dtm ? $row->update_dtm : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }

        return view ('admin.provisioning.show');

    }

    public function downloadProvisioning($addon, $segmen, $witel, $status, Request $request)
    {
        $request['addon'] = $addon;
        $request['segmen'] = $segmen;
        $request['witel'] = $witel;
        $request['status'] = $status;

        return Excel::download(new ProvisioningExport($request->all()),'Provisioning.xlsx');
    }

    public function ped(Request $request){
        $years = [];
        for($i=2020;$i <=date('Y');$i++)
        {
            array_push($years,$i);
        }
        if($request->ajax()){
            $tahun = $request->tahun ?? '';
            if($request->addon == "MIGHW2P"){
                $data = MigHomeWifi::select(array(
                    'c_witel',
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='01' THEN 1 ELSE NULL END) as bln_1"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='02' THEN 1 ELSE NULL END) as bln_2"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='03' THEN 1 ELSE NULL END) as bln_3"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='04' THEN 1 ELSE NULL END) as bln_4"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='05' THEN 1 ELSE NULL END) as bln_5"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='06' THEN 1 ELSE NULL END) as bln_6"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='07' THEN 1 ELSE NULL END) as bln_7"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='08' THEN 1 ELSE NULL END) as bln_8"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='09' THEN 1 ELSE NULL END) as bln_9"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='10' THEN 1 ELSE NULL END) as bln_10"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='11' THEN 1 ELSE NULL END) as bln_11"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='12' THEN 1 ELSE NULL END) as bln_12"),
                ))->where('psb',1)->groupBy('c_witel')->orderBy('c_witel','ASC')->cursor();
            }
            else if($request->addon == "MIG2P3P")
            {
                $data = MigNonIndibox::select(array(
                    'c_witel',
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='01' THEN 1 ELSE NULL END) as bln_1"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='02' THEN 1 ELSE NULL END) as bln_2"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='03' THEN 1 ELSE NULL END) as bln_3"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='04' THEN 1 ELSE NULL END) as bln_4"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='05' THEN 1 ELSE NULL END) as bln_5"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='06' THEN 1 ELSE NULL END) as bln_6"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='07' THEN 1 ELSE NULL END) as bln_7"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='08' THEN 1 ELSE NULL END) as bln_8"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='09' THEN 1 ELSE NULL END) as bln_9"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='10' THEN 1 ELSE NULL END) as bln_10"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='11' THEN 1 ELSE NULL END) as bln_11"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='12' THEN 1 ELSE NULL END) as bln_12"),
                ))->groupBy('c_witel')->orderBy('c_witel','ASC')->cursor();
            }
            else if($request->addon == "STB2"){
                $data = StbTambahan::select(array(
                    'c_witel',
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='01' THEN 1 ELSE NULL END) as bln_1"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='02' THEN 1 ELSE NULL END) as bln_2"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='03' THEN 1 ELSE NULL END) as bln_3"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='04' THEN 1 ELSE NULL END) as bln_4"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='05' THEN 1 ELSE NULL END) as bln_5"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='06' THEN 1 ELSE NULL END) as bln_6"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='07' THEN 1 ELSE NULL END) as bln_7"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='08' THEN 1 ELSE NULL END) as bln_8"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='09' THEN 1 ELSE NULL END) as bln_9"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='10' THEN 1 ELSE NULL END) as bln_10"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='11' THEN 1 ELSE NULL END) as bln_11"),
                    DB::raw("COUNT(CASE WHEN LEFT(report_month,4)='$tahun' AND RIGHT(report_month,2)='12' THEN 1 ELSE NULL END) as bln_12"),
                ))->groupBy('c_witel')->orderBy('c_witel','ASC')->cursor();
            }
            return response()->json($data);
        }
        return view('admin.reportCustomer.ped.index',compact('years'));
    }

    public function show_ped(Request $request){
        if($request->ajax())
        {

            $tahun = $request->tahun ?? '';
            $bln = $request->bln ?? '';
            $addon = $request->addon ?? '';
            $witel = $request->witel ?? '';

            $request->session()->forget('params');
            $request->session()->put('params', ['tahun'=>$tahun,'bln'=>$bln,'addon'=>$addon,'witel'=>$witel]);

            if($addon == "MIGHW2P"){
                $data = MigHomeWifi::select('ndinet','ndem','kcontact','chanel','ccat','addon','tematik','item','cpack','price_psb','report_month')->whereRaw("LEFT(report_month,4)='$tahun'");
            }
            else if($addon == "MIG2P3P")
            {
                $data = MigNonIndibox::select('ndinet','ndem','kcontact','chanel','ccat','addon','tematik','item','cpack','price_psb','report_month')->whereRaw("LEFT(report_month,4)='$tahun'");
            }
            else if($addon == "STB2"){
                $data = StbTambahan::select('ndinet','ndem','kcontact','chanel','ccat','addon','tematik','item','cpack','price_psb','report_month')->whereRaw("LEFT(report_month,4)='$tahun'");
            }

            if($bln != '')
            {
                $data->whereRaw("RIGHT(report_month,2)='$bln'");
            }

            if($witel != '')
            {
                $data->where('c_witel',$witel);
            }

            $data->where('addon',$addon)->where('psb',1);

            $table = DataTables::of($data);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('ndinet', function ($row) {
                return $row->ndinet ? $row->ndinet : "";
            });
            $table->editColumn('addon', function ($row) {
                return $row->addon ? $row->addon : "";
            });
            $table->editColumn('ndem', function ($row) {
                return $row->ndem ? $row->ndem : "";
            });
            $table->editColumn('kcontact', function ($row) {
                return $row->kcontact ? $row->kcontact : "";
            });
            $table->editColumn('chanel', function ($row) {
                return $row->chanel ? $row->chanel : "";
            });
            $table->editColumn('ccat', function ($row) {
                return $row->ccat ? $row->ccat : "";
            });
            $table->editColumn('tematik', function ($row) {
                return $row->tematik ? $row->tematik : "";
            });
            $table->editColumn('item', function ($row) {
                return $row->item ? $row->item : "";
            });
            $table->editColumn('cpack', function ($row) {
                return $row->cpack ? $row->cpack : "";
            });
            $table->editColumn('price_psb', function ($row) {
                return $row->price_psb ? $row->price_psb : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }
        return view('admin.reportCustomer.ped.show');
    }

    public function download_ped(Request $request)
    {
        $value = collect($request->session()->get('params'));
        return Excel::download(new ReportPedExport($value),'Report PED.xlsx');
    }

    public function pda(Request $request)
    {
        $years = [];
        for($i=2020;$i <=date('Y');$i++)
        {
            array_push($years,$i);
        }
        if($request->ajax()){
            $tahun = $request->tahun ?? '';
            $data = ReportPda::select(array(
                'witel_master',
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='01' THEN 1 ELSE NULL END) as bln_1"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='02' THEN 1 ELSE NULL END) as bln_2"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='03' THEN 1 ELSE NULL END) as bln_3"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='04' THEN 1 ELSE NULL END) as bln_4"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='05' THEN 1 ELSE NULL END) as bln_5"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='06' THEN 1 ELSE NULL END) as bln_6"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='07' THEN 1 ELSE NULL END) as bln_7"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='08' THEN 1 ELSE NULL END) as bln_8"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='09' THEN 1 ELSE NULL END) as bln_9"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='10' THEN 1 ELSE NULL END) as bln_10"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='11' THEN 1 ELSE NULL END) as bln_11"),
                DB::raw("COUNT(CASE WHEN to_char(update_dtm,'yyyy')='$tahun' AND to_char(update_dtm,'mm')='12' THEN 1 ELSE NULL END) as bln_12"),
            ))->whereIntegerInRaw('order_type_id',['124','125'])->where('status_order','13  EAI  COMPLETED')->groupBy('witel_master')->orderBy('witel_master','ASC')->cursor();
            return response()->json($data);
        }
        return view('admin.reportCustomer.pda.index',compact('years'));
    }

    public function show_pda(Request $request){
        if($request->ajax())
        {

            $tahun = $request->tahun ?? '';
            $bln = $request->bln ?? '';
            $witel = $request->witel ?? '';

            $request->session()->forget('params');
            $request->session()->put('params', ['tahun'=>$tahun,'bln'=>$bln,'witel'=>$witel]);

            $data = ReportPda::select('order_id','customer_desc','create_user_id','witel_master','internet','segmen','plblcl_trems','ccat','alamat_manual','alamat_sistem','update_dtm')->whereRaw("to_char(update_dtm,'yyyy')='$tahun'");
            if($bln != '')
            {
                $data->whereRaw("to_char(update_dtm,'mm')='$bln'");
            }

            if($witel != '')
            {
                $data->where('witel_master',$witel);
            }

            $table = DataTables::of($data->whereIntegerInRaw('order_type_id',['124','125'])->where('status_order','13  EAI  COMPLETED'));

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('order_id', function ($row) {
                return $row->order_id ? $row->order_id : "";
            });
            $table->editColumn('customer_desc', function ($row) {
                return $row->customer_desc ? $row->customer_desc : "";
            });
            $table->editColumn('create_user_id', function ($row) {
                return $row->create_user_id ? $row->create_user_id : "";
            });
            $table->editColumn('witel_master', function ($row) {
                return $row->witel_master ? $row->witel_master : "";
            });
            $table->editColumn('internet', function ($row) {
                return $row->internet ? $row->internet : "";
            });
            $table->editColumn('segmen', function ($row) {
                return $row->segmen ? $row->segmen : "";
            });
            $table->editColumn('plblcl_trems', function ($row) {
                return $row->plblcl_trems ? $row->plblcl_trems : "";
            });
            $table->editColumn('ccat', function ($row) {
                return $row->ccat ? $row->ccat : "";
            });
            $table->editColumn('alamat_manual', function ($row) {
                return $row->alamat_manual ? $row->alamat_manual : "";
            });
            $table->editColumn('alamat_sistem', function ($row) {
                return $row->alamat_sistem ? $row->alamat_sistem : "";
            });
            $table->editColumn('update_dtm', function ($row) {
                return $row->update_dtm ? $row->update_dtm : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }
        return view('admin.reportCustomer.pda.show');
    }

    public function download_pda(Request $request)
    {
        $value = collect($request->session()->get('params'));
        return Excel::download(new ReportPdaExport($value),'Report PDA.xlsx');
    }

    public function searchProvisioning(Request $request)
    {
        $data = ScAddonStatus::where('order_id', $request->nomor)
            ->orWhere('internet', $request->nomor)
            ->first();

        return view ('admin.provisioning.search', compact('data'));
    }

    public function provisioning_plasa(Request $request)
    {
        $periode_now = date('Ym', strtotime('- 4 day'));

        if ($request->ajax()) {
            $query = DB::connection('pg11')->table('dashboard_sc_plasa');
            $q_total = DB::connection('pg11')->table('dashboard_sc_plasa');

            if ($request->witel != '') {

            } else {
                $query = $query->select(
                    "witel_str",
                    DB::raw("sum(completed) as completed"),
                    DB::raw("sum(cancel) as cancel"),
                    DB::raw("sum(inprogress) as inprogress"),
                    DB::raw("sum(count) as total"),
                )->whereNotNull('witel_str');

                $q_total = $q_total->select(
                    DB::raw("sum(completed) as completed"),
                    DB::raw("sum(cancel) as cancel"),
                    DB::raw("sum(inprogress) as inprogress"),
                    DB::raw("sum(count) as total"),
                )->whereNotNull('witel_str');

                if (($request->periode != '') && ($request->periode != $periode_now)) {
                    $query = $query->where('bulan', $request->periode);
                    $q_total = $q_total->where('bulan', $request->periode);
                } else {
                    $query = $query->where('bulan', $periode_now);
                    $q_total = $q_total->where('bulan', $periode_now);
                }

                if (($request->order != '') && ($request->order != 'ALL_ORDER')) {
                    $query = $query->where('order_type_id', $request->order);
                    $q_total = $q_total->where('order_type_id', $request->order);
                } else {
                    $query = $query;
                    $q_total = $q_total;
                }

                $query = $query->groupBy("witel_str")->orderBy('completed', 'desc')->get()->toArray();
                $q_total = $q_total->first();

                $dt_count = count($query);

                $arr_total = [];
                $total = [
                    'witel_str' => "ALL",
                    'completed' => $q_total->completed,
                    'cancel' => $q_total->cancel,
                    'inprogress' => $q_total->inprogress,
                    'total' => $q_total->total,
                ];
                array_push($arr_total, $total);

                $q_merge = array_merge($query, $arr_total);

                $data = [
                    'provisioning_plasa' => $q_merge,
                    'dt_count' => $dt_count
                ];
            }

            return response()->json($data);

        }

        $periodes = DB::connection('pg11')->table('dashboard_sc_plasa')
            ->select('bulan')->where('bulan', '<=', $periode_now)->orderBy('bulan', 'desc')->distinct()->get();


        return view ('admin.provisioningPlasa.index', compact('periodes'));
    }

    public function show_provisioning_plasa($order, $periode, $witel, $status, Request $request)
    {
        if ($request->ajax()) {
            $query = ScPlasa::whereNotNull('witel_str')
                ->whereNotNull('status_order')
                ->where(DB::raw("TO_CHAR(create_dtm, 'YYYYMM')"), $periode);

            if ($order == "ALL_ORDER") {
                $query = $query;
            } else {
                $query = $query->where('order_type_id', $order);
            }

            if ($witel == "ALL") {
                $query = $query;
            } else {
                $query = $query->where('witel_str', $witel);
            }

            if ($status == "COMPLETED") {
                $query = $query->where('status_order', '13  EAI  COMPLETED');
            } else if ($status == "CANCEL") {
                $query = $query->where(DB::raw('upper(status_order)'), 'like', "%" . "CANCEL" . "%");
            } else if ($status == "IN_PROGRESS"){
                $query = $query->where(DB::raw('upper(status_order)'), 'not like', "%" . "CANCEL" . "%")
                    ->where('status_order', '!=', '13  EAI  COMPLETED');
            } else {
                $query = $query;
            }

            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('order_id', function ($row) {
                return $row->order_id ? $row->order_id : "";
            });
            $table->editColumn('internet', function ($row) {
                return $row->internet ? $row->internet : "";
            });
            $table->editColumn('pots', function ($row) {
                return $row->pots ? $row->pots : "";
            });
            $table->editColumn('create_user_id', function ($row) {
                return $row->create_user_id ? $row->create_user_id : "";
            });
            $table->editColumn('nama_pelanggan', function ($row) {
                return $row->nama_pelanggan ? $row->nama_pelanggan : "";
            });
            $table->editColumn('no_hp', function ($row) {
                return $row->no_hp ? $row->no_hp : "";
            });
            $table->editColumn('witel_str', function ($row) {
                return $row->witel_str ? $row->witel_str : "";
            });
            $table->editColumn('sto', function ($row) {
                return $row->sto_str ? $row->sto_str : "";
            });
            $table->editColumn('item', function ($row) {
                return $row->item ? $row->item : "";
            });
            $table->editColumn('status_order', function ($row) {
                return $row->status_order ? $row->status_order : "";
            });
            $table->editColumn('kcontact', function ($row) {
                return $row->kcontact ? $row->kcontact : "";
            });
            $table->editColumn('lcat', function ($row) {
                return $row->lcat ? $row->lcat : "";
            });
            $table->editColumn('durasijam', function ($row) {
                return $row->durasijam ? $row->durasijam . " jam" : "";
            });
            $table->editColumn('order_type_id', function ($row) {
                return $row->order_type_id ? $row->order_type_id : "";
            });
            $table->editColumn('create_dtm', function ($row) {
                return $row->create_dtm ? $row->create_dtm : "";
            });
            $table->editColumn('update_dtm', function ($row) {
                return $row->update_dtm ? $row->update_dtm : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);

        }

        return view ('admin.provisioningPlasa.show');
    }

    public function search_provisioning_plasa(Request $request)
    {
        $data = ScPlasa::where('order_id', $request->nomor)
            ->orWhere('internet', $request->nomor)
            ->first();

        return view ('admin.provisioningPlasa.search', compact('data'));
    }

    public function download_provisioning_plasa($order, $periode, $witel, $status, Request $request)
    {
        $request['order'] = $order;
        $request['periode'] = $periode;
        $request['witel'] = $witel;
        $request['status'] = $status;

        return Excel::download(new ProvisioningPlasaExport($request->all()),'Provisioning Plasa.xlsx');
    }

    public function plasa_rekapwitel(Request $request)
    {
        if ($request->ajax()) {
            $dt_query = DB::connection('pg11')->table('plasa_addon_rekap_witel_gabungan_fix_v2')
            ->select(
                'witel', 'plasa',
                DB::raw("sum(mig2p3p) as mig2p3p"),
                DB::raw("sum(minipack) as minipack"),
                DB::raw("sum(stb_tambahan) as stb_tambahan"),
                DB::raw("sum(upgrade_speed) as upgrade_speed"),
                DB::raw("sum(ott) as ott"),
                DB::raw("sum(psb_nonkios_csr) as psb_nonkios_csr"),
                DB::raw("sum(psb_kios_csr) as psb_kios_csr"),
                DB::raw("sum(psb_kios_mesin) as psb_kios_mesin"),
                DB::raw("sum(mig2p3p+minipack+stb_tambahan+upgrade_speed+ott+psb_nonkios_csr+psb_kios_csr+psb_kios_mesin) as total"),
            );

            $dt_total = DB::connection('pg11')->table('plasa_addon_rekap_witel_gabungan_fix_v2')
            ->select(
                DB::raw("sum(mig2p3p) as mig2p3p"),
                DB::raw("sum(minipack) as minipack"),
                DB::raw("sum(stb_tambahan) as stb_tambahan"),
                DB::raw("sum(upgrade_speed) as upgrade_speed"),
                DB::raw("sum(ott) as ott"),
                DB::raw("sum(psb_nonkios_csr) as psb_nonkios_csr"),
                DB::raw("sum(psb_kios_csr) as psb_kios_csr"),
                DB::raw("sum(psb_kios_mesin) as psb_kios_mesin"),
                DB::raw("sum(mig2p3p+minipack+stb_tambahan+upgrade_speed+ott+psb_nonkios_csr+psb_kios_csr+psb_kios_mesin) as total"),
            );

            if (($request->periode != '') && ($request->periode != 'ALL_PERIODE')) {
                $dt_query = $dt_query->where('report_month', $request->periode);
                $dt_total = $dt_total->where('report_month', $request->periode);
            }

            if (($request->witel != '') && ($request->witel != 'ALL_WITEL')) {
                $dt_query = $dt_query->where('witel', $request->witel);
                $dt_total = $dt_total->where('witel', $request->witel);
            }

            $dt_query = $dt_query->groupBy('witel','plasa')->get()->toArray();
            $dt_total = $dt_total->first();

            $arr_total = [];
            $total = [
                'witel' => "ALL",
                'plasa' => "ALL",
                'mig2p3p' => $dt_total->mig2p3p,
                'minipack' => $dt_total->minipack,
                'stb_tambahan' => $dt_total->stb_tambahan,
                'upgrade_speed' => $dt_total->upgrade_speed,
                'ott' => $dt_total->ott,
                'psb_nonkios_csr' => $dt_total->psb_nonkios_csr,
                'psb_kios_csr' => $dt_total->psb_kios_csr,
                'psb_kios_mesin' => $dt_total->psb_kios_mesin,
                'total' => $dt_total->total,
            ];
            array_push($arr_total, $total);

            $dt_merge = array_merge($dt_query, $arr_total);

            $data = [
                'rekapwitel' => $dt_merge
            ];

            return response()->json($data);
        }

        $periodes = DB::connection('pg11')->table('plasa_addon_rekap_witel_gabungan_fix_v2')
            ->select('report_month')->orderBy('report_month', 'desc')->distinct()->get();
        $witels = Witel::get(['id', 'nama_witel']);

        return view('admin.reportCustomer.plasa.rekapwitel', compact('periodes', 'witels'));
    }

    public function plasa_rekap($periode, $witel, $plasa, Request $request)
    {
        if ($request->ajax()) {
            $dt_query = DB::connection('pg11')->table('plasa_addon_rekap_fix')
            ->select(
                'kode_sales_v2', 'nama', 'witel', 'plasa', 'status',
                DB::raw("sum(mig2p3p) as mig2p3p"),
                DB::raw("sum(minipack) as minipack"),
                DB::raw("sum(stb_tambahan) as stb_tambahan"),
                DB::raw("sum(upgrade_speed) as upgrade_speed"),
                DB::raw("sum(ott) as ott"),
                DB::raw("sum(psb_2p) as psb_2p"),
                DB::raw("sum(psb_3p) as psb_3p"),
                DB::raw("sum(mig2p3p+minipack+stb_tambahan+upgrade_speed+ott+psb_2p+psb_3p) as total"),
            );

            if ($periode == "ALL_PERIODE") {
                $dt_query = $dt_query;
            } else {
                $dt_query = $dt_query->where('report_month', $periode);
            }

            if ($witel == "ALL_WITEL") {
                $dt_query = $dt_query;
            } else {
                $dt_query = $dt_query->where('witel', $witel);
            }

            if ($plasa == "ALL") {
                $dt_query = $dt_query;
            } else if ($plasa == "null") {
                $dt_query = $dt_query->whereNull('plasa');
            } else {
                $dt_query = $dt_query->where('plasa', $plasa);
            }

            $table = DataTables::of($dt_query->groupBy('witel', 'plasa', 'kode_sales_v2', 'nama', 'status')->get()->toArray());

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('kode_sales_v2', function ($row) {
                return $row->kode_sales_v2 ? $row->kode_sales_v2 : "";
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : "";
            });
            $table->editColumn('witel', function ($row) {
                return $row->witel ? $row->witel : "";
            });
            $table->editColumn('plasa', function ($row) {
                return $row->plasa ? $row->plasa : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
            $table->editColumn('mig2p3p', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'MIG2P3P'.'/'.$row->kode_sales_v2).'">'.$row->mig2p3p.'</a>';
            });
            $table->editColumn('minipack', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'MINIPACK'.'/'.$row->kode_sales_v2).'">'.$row->minipack.'</a>';
            });
            $table->editColumn('stb_tambahan', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'STB2'.'/'.$row->kode_sales_v2).'">'.$row->stb_tambahan.'</a>';
            });
            $table->editColumn('upgrade_speed', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'UPSPEED'.'/'.$row->kode_sales_v2).'">'.$row->upgrade_speed.'</a>';
            });
            $table->editColumn('ott', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'OTT'.'/'.$row->kode_sales_v2).'">'.$row->ott.'</a>';
            });
            $table->editColumn('psb_2p', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'psb_2p'.'/'.$row->kode_sales_v2).'">'.$row->psb_2p.'</a>';
            });
            $table->editColumn('psb_3p', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'psb_3p'.'/'.$row->kode_sales_v2).'">'.$row->psb_3p.'</a>';
            });
            $table->editColumn('total', function ($row) use ($periode, $witel, $plasa) {
                return '<a style="color:black" target="_blank" href="'.url('admin/performance/plasa/rekap/csr/'.$periode.'/'.$witel.'/'.$plasa.'/'.'ALL_ADDON'.'/'.$row->kode_sales_v2).'">'.$row->total.'</a>';
            });

            $table->rawColumns(['kode_sales_v2','nama','witel','plasa','status','mig2p3p','minipack','stb_tambahan','upgrade_speed','ott','psb_2p','psb_3p','total', 'placeholder']);


            return $table->make(true);
        }

        return view ('admin.reportCustomer.plasa.rekap');
    }

    public function plasa_rekapdetail($periode, $witel, $plasa, $addon, Request $request)
    {
        if ($request->ajax()) {
            $dt_query = DB::connection('pg11')->table('plasa_rekap_gabungan_detail_v2')
                                            ->select('*')
                                            ->whereIn('addon', ['MIG2P3P', 'MINIPACK', 'STB2', 'UPSPEED', 'OTT']);
            $dt_query2 = DB::connection('pg11')->table('plasa_rekap_gabungan_detail_v2')
                                            ->select(DB::raw('DISTINCT *'))
                                            ->whereIn('addon', ['psb_nonkios_csr', 'psb_kios_csr','psb_kios_mesin']);
            $query = $dt_query->unionAll($dt_query2)->get();
            if ($periode != "ALL_PERIODE") {
                $query = $query->where('report_month', $periode);
            }
            if ($witel != "ALL_WITEL") {
                $query = $query->where('witel', $witel);
            }
            if ($plasa == "null") {
                $query = $query->whereNull('plasa');
            }
            if ($plasa != "ALL" && $plasa != "null") {
                $query = $query->where('plasa', $plasa);
            }
            if ($addon != "ALL_ADDON") {
                $query = $query->where('addon', $addon);
            }

            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('report_month', function ($row) {
                return $row->report_month ? $row->report_month : "";
            });
            $table->editColumn('nd_speedy', function ($row) {
                return $row->nd_speedy ? $row->nd_speedy : "";
            });
            $table->editColumn('kode_sales_v2', function ($row) {
                return $row->kode_sales_v2 ? $row->kode_sales_v2 : "";
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : "";
            });
            $table->editColumn('witel', function ($row) {
                return $row->witel ? $row->witel : "";
            });
            $table->editColumn('plasa', function ($row) {
                return $row->plasa ? $row->plasa : "";
            });
            $table->editColumn('sto', function ($row) {
                return $row->sto ? $row->sto : "";
            });
            $table->editColumn('addon', function ($row) {
                return $row->addon ? $row->addon : "";
            });
            $table->editColumn('ccat', function ($row) {
                return $row->ccat ? $row->ccat : "";
            });
            $table->editColumn('coper', function ($row) {
                return $row->coper ? $row->coper : "";
            });
            $table->editColumn('kcontact', function ($row) {
                return $row->kcontact ? $row->kcontact : "";
            });
            $table->editColumn('tgl_ps', function ($row) {
                return $row->tgl_ps ? $row->tgl_ps : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }

        return view ('admin.reportCustomer.plasa.rekapdetail');
    }

    public function plasa_rekapcsr($periode, $witel, $plasa, $addon, $csr, Request $request)
    {
        if ($request->ajax()) {
            $dt_query = DB::connection('pg11')->table('plasa_rekap_gabungan_detail');

            if ($periode == "ALL_PERIODE") {
                $dt_query = $dt_query;
            } else {
                $dt_query = $dt_query->where('report_month', $periode);
            }

            if ($witel == "ALL_WITEL") {
                $dt_query = $dt_query;
            } else {
                $dt_query = $dt_query->where('witel', $witel);
            }

            if ($plasa == "ALL") {
                $dt_query = $dt_query;
            } else if ($plasa == "null") {
                $dt_query = $dt_query->whereNull('plasa');
            } else {
                $dt_query = $dt_query->where('plasa', $plasa);
            }


            if ($addon == "ALL_ADDON") {
                $dt_query = $dt_query->whereIn('addon', ['MIG2P3P', 'MINIPACK', 'STB2', 'UPSPEED', 'OTT', 'psb_2p', 'psb_3p']);
            } else {
                $dt_query = $dt_query->where('addon', $addon);
            }

            if ($csr != "") {
                $dt_query = $dt_query->where('kode_sales_v2', $csr);
            }

            $table = DataTables::of($dt_query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('report_month', function ($row) {
                return $row->report_month ? $row->report_month : "";
            });
            $table->editColumn('nd_speedy', function ($row) {
                return $row->nd_speedy ? $row->nd_speedy : "";
            });
            $table->editColumn('kode_sales_v2', function ($row) {
                return $row->kode_sales_v2 ? $row->kode_sales_v2 : "";
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : "";
            });
            $table->editColumn('witel', function ($row) {
                return $row->witel ? $row->witel : "";
            });
            $table->editColumn('plasa', function ($row) {
                return $row->plasa ? $row->plasa : "";
            });
            $table->editColumn('sto', function ($row) {
                return $row->sto ? $row->sto : "";
            });
            $table->editColumn('addon', function ($row) {
                return $row->addon ? $row->addon : "";
            });
            $table->editColumn('ccat', function ($row) {
                return $row->ccat ? $row->ccat : "";
            });
            $table->editColumn('coper', function ($row) {
                return $row->coper ? $row->coper : "";
            });
            $table->editColumn('kcontact', function ($row) {
                return $row->kcontact ? $row->kcontact : "";
            });
            $table->editColumn('tgl_ps', function ($row) {
                return $row->tgl_ps ? $row->tgl_ps : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }

        return view ('admin.reportCustomer.plasa.rekapdetail');
    }

    public function plasa_downloadRekapdetail($periode, $witel, $plasa, $addon, Request $request)
    {
        $request['periode'] = $periode;
        $request['witel'] = $witel;
        $request['plasa'] = $plasa;
        $request['addon'] = $addon;

        return Excel::download(new PerformancePlasaExport($request->all()),'Detail Performansi Plasa.xlsx');
    }

    public function plasa_downloadRekap($periode, $witel, $plasa, Request $request)
    {
        $request['periode'] = $periode;
        $request['witel'] = $witel;
        $request['plasa'] = $plasa;

        return Excel::download(new PerformanceCsrExport($request->all()),'Performansi CSR Plasa.xlsx');
    }

    public function plasa_downloadRekapcsr($periode, $witel, $plasa, $addon, $csr, Request $request)
    {
        $request['periode'] = $periode;
        $request['witel'] = $witel;
        $request['plasa'] = $plasa;
        $request['addon'] = $addon;
        $request['csr'] = $csr;

        return Excel::download(new PerformanceCsrdetailExport($request->all()),'Detail Performansi CSR Plasa.xlsx');
    }
}
