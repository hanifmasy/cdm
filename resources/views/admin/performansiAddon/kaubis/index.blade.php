@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.performansi_addon.title_singular') }} Kaubis {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form id="filterPerform" type="POST" action="{{route('admin.performKaubis.index')}}"
            enctype="multipart/form-data">
            <div class="form-group row">
                <label for="report_month" class="col-md-2 col-form-label">Report Month</label>
                <div class="col-sm-3 controls">
                    <input class="form-control" type="text" name="reportMonth" id="reportMonth" placeholder="Month">
                </div>
                <div class="col-sm-3 controls">
                    <input class="form-control" type="text" name="reportYear" id="reportYear" placeholder="Year">
                </div>
            </div>

            <div class="form-group row">
                <label for="report_month" class="col-md-2 col-form-label">Kaubis</label>
                <div class="col-sm-6 controls">
                    <input class="form-control" type="text" name="filterKaubis" id="filterKaubis" placeholder="Filter Kaubis">
                </div>
            </div>

            <div class="form-group row">
                <label for="report_month" class="col-md-2 col-form-label">Addon</label>
                <div class="col-sm-6 controls">
                    <input class="form-control" type="text" name="filterAddon" id="filterAddon" placeholder="Filter Addon">
                </div>
            </div>

            <div class="form-group row">
                <label for="report_month" class="col-md-2 col-form-label">STO</label>
                <div class="col-sm-6 controls">
                    <input class="form-control" type="text" name="filterSto" id="filterSto" placeholder="Filter STO">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputWitel" class="col-md-2 col-form-label">Witel</label>
                <div class="col-sm-6 controls">
                    <select class="form-control select2 {{ $errors->has('witel') ? 'is-invalid' : '' }}" name="witel_id"
                        id="witel_id">
                        <option value="">{{trans('global.pleaseSelect')}}</option>
                        @foreach($witels as $id => $witel)
                        <option value="{{ $witel }}">{{ $witel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-12 offset-2">
                <div class="float-left">
                    <button style="position: relative; right: 5px;" name="searchBtn" id="searchBtn" type="submit"
                        class="btn btn-primary">Filter</button>
                </div>
            </div>
            <br><br>
        </form>

        <hr class="dashed" style="border-top: 3px dashed #bbb">
        <table id="performOrderTable"
            class="table table-bordered table-striped table-hover ajaxTable datatable datatable-performKubis"
            width="100%">
            <thead>
                <tr>
                    {{-- <th width="10">

                    </th> --}}
                    <th>
                        {{ trans('cruds.performansi_addon.fields.kaubis') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.addon') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.performansi_addon.fields.ndem') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.kcontact') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.coper') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.cagent') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.kawasan') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.performansi_addon.fields.sto') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.witel') }}
                    </th>
                    <th style="text-align:right">
                        Total
                        {{-- {{ trans('cruds.performansi_addon.fields.total') }} --}}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.performansi_addon.fields.channel') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.alpro') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.tgl_va') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.tgl_ps') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.cgest') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.cseg') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.ccat') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.linecats_family') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.tematik') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.item') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.cpack') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.psb') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.cbt') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.mig') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.price_psb') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.price_cbt') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.price_mig') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.ndinet') }}
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.performansi_addon.fields.kaubis') }}
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.performansi_addon.fields.nik') }}
                    </th> --}}
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align:right">Total:</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent

<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
        
        $(".select2" ).select2({
          placeholder: "Silahkan Pilih",
          theme: "bootstrap4"
        }); 

        fill_datatable();

        function fill_datatable(filter_month = '', filter_year = '', filter_witel = '', filter_kaubis = '',
            filter_sto = '', filter_addon = '') {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let url = $('#filterPerform').attr('action');
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                // ajax: "{{ route('admin.performKaubis.index') }}",
                ajax: {
                    url: url,
                    data: {
                        filter_month: filter_month,
                        filter_year: filter_year,
                        filter_witel: filter_witel,
                        filter_kaubis: filter_kaubis,
                        filter_sto: filter_sto,
                        filter_addon: filter_addon,
                    }
                },
                columns: [{
                        data: 'kaubis',
                        name: 'kaubis'
                    },
                    {
                        data: 'addon',
                        name: 'addon'
                    },
                    {
                        data: 'sto',
                        name: 'sto'
                    },
                    {
                        data: 'witel',
                        name: 'witel'
                    },
                    {
                        data: 'total',
                        name: 'total',
                        className: 'text-right',
                        sortable: true,
                    },
                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api(),
                        data;
                    // converting to interger to find total
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Grand Total All Page
                    // let total = api
                    //     .column(4)
                    //     .data()
                    //     .reduce(function (a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);
                    
                    // Grand Total Current Page
                    let total = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    $( api.column( 4 ).footer() ).html(
                        total
                    );

                    // console.log(total);

                },
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 50,
            };
            let table = $('.datatable-performKubis').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        }

        $('#reportMonth').datetimepicker({
            format: "MM",
            viewMode: "months",
        });

        $('#reportYear').datetimepicker({
            format: "YYYY",
            viewMode: "years",
        });


        $('#searchBtn').click(function (e) {
            e.preventDefault();
            let filter_month = $('#reportMonth').val();
            let filter_year = $('#reportYear').val();
            let filter_witel = $('#witel_id').val();
            let filter_kaubis = $('#filterKaubis').val();
            let filter_sto = $('#filterSto').val();
            let filter_addon = $('#filterAddon').val();
            // console.log(filter_month);
            // console.log(filter_year);
            // console.log(filter_witel);
            // console.log(filter_kaubis);
            // console.log(filter_sto);
            // console.log(filter_addon);
            $('#performOrderTable').DataTable().destroy();
            fill_datatable(filter_month, filter_year, filter_witel, filter_kaubis, filter_sto,
                filter_addon);
        });

    });
</script>
@endsection