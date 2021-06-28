<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Minipack;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProrataSalesChurnController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prorata_sales_churn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grandtotal = [];
        $total_prorata_sales_ssl_h2 = 0;
        $total_prorata_sales_rp_h2 = 0;
        $total_prorata_sales_ssl_h1 = 0;
        $total_prorata_sales_rp_h1 = 0;
        $total_prorata_sales_ssl_h = 0;
        $total_prorata_sales_rp_h = 0;
        $total_prorata_churn_ssl_h2 = 0;
        $total_prorata_churn_rp_h2 = 0;
        $total_prorata_churn_ssl_h1 = 0;
        $total_prorata_churn_rp_h1 = 0;
        $total_prorata_churn_ssl_h = 0;
        $total_prorata_churn_rp_h = 0;
        $total_ssl_prognosa_h2 = 0;
        $total_rp_prognosa_h2 = 0;
        $total_ssl_prognosa_h1 = 0;
        $total_rp_prognosa_h1 = 0;
        $total_ssl_prognosa_h = 0;
        $total_rp_prognosa_h = 0;
        $data = Minipack::on('pg2')->get();
        foreach($data as $row)
        {
            $total_prorata_sales_ssl_h2 += $row->prorata_sales_ssl_h2;
            $total_prorata_sales_rp_h2 += $row->prorata_sales_rp_h2;
            $total_prorata_sales_ssl_h1 += $row->prorata_sales_ssl_h1;
            $total_prorata_sales_rp_h1 += $row->prorata_sales_rp_h1;
            $total_prorata_sales_ssl_h += $row->prorata_sales_ssl_h;
            $total_prorata_sales_rp_h += $row->prorata_sales_rp_h;
            $total_prorata_churn_ssl_h2 += $row->prorata_churn_ssl_h2;
            $total_prorata_churn_rp_h2 += $row->prorata_churn_rp_h2;
            $total_prorata_churn_ssl_h1 += $row->prorata_churn_ssl_h1;
            $total_prorata_churn_rp_h1 += $row->prorata_churn_rp_h1;
            $total_prorata_churn_ssl_h += $row->prorata_churn_ssl_h;
            $total_prorata_churn_rp_h += $row->prorata_churn_rp_h;
            $total_ssl_prognosa_h2 += $row->ssl_prognosa_h2;
            $total_rp_prognosa_h2 += $row->rp_prognosa_h2;
            $total_ssl_prognosa_h1 += $row->ssl_prognosa_h1;
            $total_rp_prognosa_h1 += $row->rp_prognosa_h1;
            $total_ssl_prognosa_h += $row->ssl_prognosa_h;
            $total_rp_prognosa_h += $row->rp_prognosa_h;
            $grandtotal = [
                'total_prorata_sales_ssl_h2' => $total_prorata_sales_ssl_h2,
                'total_prorata_sales_rp_h2' => "Rp. ".number_format($total_prorata_sales_rp_h2,0,",","."),
                'total_prorata_sales_ssl_h1' => $total_prorata_sales_ssl_h1,
                'total_prorata_sales_rp_h1' => "Rp. ".number_format($total_prorata_sales_rp_h1,0,",","."),
                'total_prorata_sales_ssl_h' => $total_prorata_sales_ssl_h,
                'total_prorata_sales_rp_h' => "Rp. ".number_format($total_prorata_sales_rp_h,0,",","."),
                'total_prorata_churn_ssl_h2' => $total_prorata_churn_ssl_h2,
                'total_prorata_churn_rp_h2' => "Rp. ".number_format($total_prorata_churn_rp_h2,0,",","."),
                'total_prorata_churn_ssl_h1' => $total_prorata_churn_ssl_h1,
                'total_prorata_churn_rp_h1' => "Rp. ".number_format($total_prorata_churn_rp_h1,0,",","."),
                'total_prorata_churn_ssl_h' => $total_prorata_churn_ssl_h,
                'total_prorata_churn_rp_h' => "Rp. ".number_format($total_prorata_churn_rp_h,0,",","."),
                'total_ssl_prognosa_h2' => $total_ssl_prognosa_h2,
                'total_rp_prognosa_h2' => "Rp. ".number_format($total_rp_prognosa_h2,0,",","."),
                'total_ssl_prognosa_h1' => $total_ssl_prognosa_h1,
                'total_rp_prognosa_h1' => "Rp. ".number_format($total_rp_prognosa_h1,0,",","."),
                'total_ssl_prognosa_h' => $total_ssl_prognosa_h,
                'total_rp_prognosa_h' => "Rp. ".number_format($total_rp_prognosa_h,0,",",".")
            ];
        }

        return view('admin.prorataSalesChurns.index',compact('data','grandtotal'));
    }
}
