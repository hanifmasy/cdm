@extends('layouts.admin')
@section('content')
<style>
.DTFC_LeftBodyLiner {
    max-height: unset!important;
}
.DTFC_LeftFootWrapper {
    top: 0!important;
}
</style>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.prorataSalesChurn.title') }}
    </div>

    <div class="card-body">
        <div class="col-md-12">
            <h1 class="text-center">MINIPACK</h1>
        </div>
        <table class="table table-bordered table-striped table-hover datatable datatable-Prorata" class="display compact" style="width:100%">
            <thead class="text-center small" style="margin: 0px;">
                <tr>
                    <th rowspan="3" class="align-middle">
                        {{ "Witel" }}
                    </th>
                    <th colspan="6">
                        {{ "Sales" }}
                    </th>
                    <th colspan="6">
                        {{ "Churn" }}
                    </th>
                    <th colspan="6">
                        {{ "Prognosa" }}
                    </th>
                </tr>
                <tr>
                    <th colspan="2">SD H-2</th>
                    <th colspan="2">SD H-1</th>
                    <th colspan="2">SD HR INI</th>
                    <th colspan="2">SD H-2</th>
                    <th colspan="2">SD H-1</th>
                    <th colspan="2">SD HR INI</th>
                    <th colspan="2">SD H-2</th>
                    <th colspan="2">SD H-1</th>
                    <th colspan="2">SD HR INI</th>
                </tr>
                <tr>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                    <th>SSL</th>
                    <th>RP</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->witel }}</td>
                    <td>{{ $row->prorata_sales_ssl_h2 }}</td>
                    <td>{{ "Rp. ".number_format($row->prorata_sales_rp_h2,0,",",".") }}</td>
                    <td>{{ $row->prorata_sales_ssl_h1 }}</td>
                    <td>{{ "Rp. ".number_format($row->prorata_sales_rp_h1,0,",",".") }}</td>
                    <td>{{ $row->prorata_sales_ssl_h }}</td>
                    <td>{{ "Rp. ".number_format($row->prorata_sales_rp_h,0,",",".") }}</td>
                    <td>{{ $row->prorata_churn_ssl_h2 }}</td>
                    <td>{{ "Rp. ".number_format($row->prorata_churn_rp_h2,0,",",".") }}</td>
                    <td>{{ $row->prorata_churn_ssl_h1 }}</td>
                    <td>{{ "Rp. ".number_format($row->prorata_churn_rp_h1,0,",",".") }}</td>
                    <td>{{ $row->prorata_churn_ssl_h }}</td>
                    <td>{{ "Rp. ".number_format($row->prorata_churn_rp_h,0,",",".") }}</td>
                    <td>{{ $row->ssl_prognosa_h2 }}</td>
                    <td>{{ "Rp. ".number_format($row->rp_prognosa_h2,0,",",".") }}</td>
                    <td>{{ $row->ssl_prognosa_h1 }}</td>
                    <td>{{ "Rp. ".number_format($row->rp_prognosa_h1,0,",",".") }}</td>
                    <td>{{ $row->ssl_prognosa_h }}</td>
                    <td>{{ "Rp. ".number_format($row->rp_prognosa_h,0,",",".") }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="small">
                <tr>
                    <th>Grand Total</th>
                    @foreach($grandtotal as $row)
                    <th>{{ $row }}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Prorata:not(.ajaxTable)').DataTable({ buttons: dtButtons,scrollY: "100%",footer: true,responsive:true,fnInitComplete: function(){
           $('.dataTables_scrollBody').css({'overflow': 'hidden','border':'0'});
           $('.dataTables_scrollFoot').css('overflow', 'auto');
           $('.dataTables_scrollFoot').on('scroll', function () {
               $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
           });
       },
       drawCallback: function( settings ) {
           setTimeout(function(){$('.DTFC_LeftBodyWrapper, .DTFC_LeftBodyLiner').height($('.dataTables_scrollBody').height());},0);
       } })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

$(window).resize(function(){$('.datatable-Prorata:not(.ajaxTable)').DataTable().draw()});
</script>
@endsection