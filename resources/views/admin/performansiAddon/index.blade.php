@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.performansi_addon.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form id="filterPerform" type="POST" action="{{route('admin.performAddon.index')}}"
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
            <div class="form-group row">
                <label for="inputDatel" class="col-md-2 col-form-label">Datel</label>
                <div class="col-sm-6 controls">
                    <select class="form-control select2 {{ $errors->has('datel') ? 'is-invalid' : '' }}" name="datel_id"
                        id="datel_id">
                        <option value="">{{trans('global.pleaseSelect')}}</option>
                        @foreach($datels as $id => $datel)
                        <option value="{{ $datel }}">{{ $datel }}</option>
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
        <table id="performOrderTable" class="table table-bordered table-striped table-hover ajaxTable datatable datatable-performAddon"
            width="100%">
            <thead>
                <tr>
                    {{-- <th width="10">

                    </th> --}}
                    <th>
                        {{ trans('cruds.performansi_addon.fields.report_month') }}
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
                        {{ trans('cruds.performansi_addon.fields.witel') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.datel') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.sto') }}
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
                    <th>
                        {{ trans('cruds.performansi_addon.fields.kaubis') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.nik') }}
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent

<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function(){

        $(".select2" ).select2({
          placeholder: "Silahkan Pilih",          
          theme: "bootstrap4"
        }); 

        fill_datatable();

        function fill_datatable(filter_month = '', filter_year = '', filter_witel = '', filter_datel = '') {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let url = $('#filterPerform').attr('action');
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                // responsive: true,
                // ajax: "{{ route('admin.performAddon.index') }}",
                ajax: {
                    url: url,
                    data: {
                        filter_month: filter_month,
                        filter_year: filter_year,
                        filter_witel: filter_witel,
                        filter_datel: filter_datel
                    }
                },
                columns: [
                    //   { data: 'placeholder', name: 'placeholder' },
                    {
                        data: 'report_month',
                        name: 'report_month'
                    },
                    {
                        data: 'addon',
                        name: 'addon'
                    },
                    // { data: 'ndem', name: 'ndem' },
                    // { data: 'kcontact', name: 'kcontact' },
                    // { data: 'coper', name: 'coper' },
                    // { data: 'cagent', name: 'cagent' },
                    // { data: 'kawasan', name: 'kawasan' },
                    {
                        data: 'witel',
                        name: 'witel'
                    },
                    {
                        data: 'datel',
                        name: 'datel'
                    },
                    {
                        data: 'sto',
                        name: 'sto'
                    },
                    // { data: 'channel', name: 'channel' },
                    // { data: 'alpro', name: 'alpro' },
                    // { data: 'tgl_va', name: 'tgl_va' },
                    // { data: 'tgl_ps', name: 'tgl_ps' },
                    // { data: 'cgest', name: 'cgest' },
                    // { data: 'cseg', name: 'cseg' },
                    // { data: 'ccat', name: 'ccat' },
                    // { data: 'linecats_family_lname', name: 'linecats_family_lname' },
                    // { data: 'tematik', name: 'tematik' },
                    // { data: 'item', name: 'item' },
                    // { data: 'cpack', name: 'cpack' },
                    // { data: 'psb', name: 'psb' },
                    // { data: 'cbt', name: 'cbt' },
                    // { data: 'mig', name: 'mig' },
                    // { data: 'price_psb', name: 'price_psb' },
                    // { data: 'price_cbt', name: 'price_cbt' },
                    // { data: 'price_mig', name: 'price_mig' },
                    // { data: 'ndinet', name: 'ndinet' },
                    {
                        data: 'kaubis',
                        name: 'kaubis'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    // { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 50,
            };
            let table = $('.datatable-performAddon').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        }

        $('#reportMonth').datetimepicker({
            format      :   "MM",
            viewMode    :   "months", 
        });

        $('#reportYear').datetimepicker({
            format      :   "YYYY",
            viewMode    :   "years", 
        });


        $('#searchBtn').click(function (e) {
            e.preventDefault();
            let filter_month = $('#reportMonth').val();
            let filter_year = $('#reportYear').val();
            let filter_witel = $('#witel_id').val();
            let filter_datel = $('#datel_id').val();
            // console.log(filter_month);
            // console.log(filter_year);
            // console.log(filter_witel);
            // console.log(filter_datel);
            // if(filter_month != '' &&  filter_year != '' && filter_witel != '' && filter_datel != '') {
            $('#performOrderTable').DataTable().destroy();
            fill_datatable(filter_month, filter_year, filter_witel, filter_datel);
            // }
            // else if(filter_month != '' && filter_year != '' && filter_witel != ''){
            //     $('#performOrderTable').DataTable().destroy();
            //     fill_datatable(filter_month, filter_year, filter_witel);
            // }
            // else if(filter_month != '' && filter_year != '' && filter_datel != ''){
            //     $('#performOrderTable').DataTable().destroy();
            //     fill_datatable(filter_month, filter_year, filter_datel);
            // }
            // else if(filter_month != '' && filter_year != ''){
            //     $('#performOrderTable').DataTable().destroy();
            //     fill_datatable(filter_month, filter_year);
            // }
            // else if(filter_month != ''){
            //     $('#performOrderTable').DataTable().destroy();
            //     fill_datatable(filter_month);
            // }
            // else if(filter_year != ''){
            //     $('#performOrderTable').DataTable().destroy();
            //     fill_datatable(filter_year);
            // }
            // else
            // {
            //     alert('Select filter option');
            // }
        });
    });
</script>
@endsection