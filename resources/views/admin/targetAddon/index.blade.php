@extends('layouts.admin')
@section('content')
@can('regional_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            {{-- <a class="btn btn-success" href="{{ route('admin.targetAddon.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.regional.title_singular') }}
            </a> --}}
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Regional', 'route' => 'admin.targetAddon.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.target_addon.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TargetAddon">
            <thead>
                <tr>
                    {{-- <th width="10">

                    </th> --}}
                    <th>
                        {{ trans('cruds.target_addon.fields.report_month') }}
                    </th>
                    <th>
                        {{ trans('cruds.target_addon.fields.addon') }}
                    </th>
                    <th>
                        {{ trans('cruds.target_addon.fields.witel') }}
                    </th>
                    <th>
                        {{ trans('cruds.target_addon.fields.datel') }}
                    </th>
                    <th>
                        {{ trans('cruds.target_addon.fields.ssl') }}
                    </th>
                    <th>
                        {{ trans('cruds.target_addon.fields.revenue') }}
                    </th>
                    <th>
                        {{ trans('cruds.target_addon.fields.real_ssl') }}
                    </th>
                    <th>
                        {{ trans('cruds.target_addon.fields.real_revenue') }}
                    </th>
                    {{-- <th>
                        &nbsp;
                    </th> --}}
                </tr>
                {{-- <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                </tr> --}}
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('regional_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.targetAddon.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

    //   if (ids.length === 0) {
    //     alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

    //   if (confirm('{{ trans('global.areYouSure') }}')) {
    //     $.ajax({
    //       headers: {'x-csrf-token': _token},
    //       method: 'POST',
    //       url: config.url,
    //     //   data: { ids: ids, _method: 'DELETE' }})
    //     //   .done(function () { location.reload() })
    //   }
    // }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.targetAddon.index') }}",
    columns: [
    //   { data: 'placeholder', name: 'placeholder' },
{ data: 'report_month', name: 'report_month' },
{ data: 'addon', name: 'addon' },
{ data: 'witel', name: 'witel' },
{ data: 'datel', name: 'datel' },
{ data: 'ssl', name: 'ssl' },
{ data: 'revenue', name: 'revenue' },
{ data: 'real_ssl', name: 'real_ssl' },
{ data: 'real_revenue', name: 'real_revenue' },
// { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-TargetAddon').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
//   $('.datatable thead').on('input', '.search', function () {
//       let strict = $(this).attr('strict') || false
//       let value = strict && this.value ? "^" + this.value + "$" : this.value
//       table
//         .column($(this).parent().index())
//         .search(value, strict)
//         .draw()
//   });
});

</script>
@endsection