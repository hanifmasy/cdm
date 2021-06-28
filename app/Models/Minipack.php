<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minipack extends Model
{
    //
    public $table = 'prorata_minipack_addon_churn_prognosa';

    protected $fillable = [
        'witel','prorata_sales_ssl_h2','prorata_sales_rp_h2','prorata_sales_ssl_h1','prorata_sales_rp_h1',
        'prorata_sales_ssl_h','prorata_sales_rp_h','prorata_churn_ssl_h2','prorata_churn_rp_h2','prorata_churn_ssl_h1','prorata_churn_rp_h1',
        'prorata_churn_ssl_h','prorata_churn_rp_h','ssl_prognosa_h2','rp_prognosa_h2','ssl_prognosa_h1','rp_prognosa_h1',
        'ssl_prognosa_h','rp_prognosa_h'
    ];
}
