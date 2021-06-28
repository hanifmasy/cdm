@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="card">
	<div class="card-body">
		<h4 class="card-title">Data table</h4>
		<div class="row">
			<div class="col-12">
				<div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AuditLog" id="order-listing" style="width: 100%;">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.auditLog.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.auditLog.fields.description') }}
                                </th>
                                <th>
                                    {{ trans('cruds.auditLog.fields.subject_id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.auditLog.fields.subject_type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.auditLog.fields.user_id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.auditLog.fields.host') }}
                                </th>
                                <th>
                                    {{ trans('cruds.auditLog.fields.created_at') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.audit-logs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'description', name: 'description' },
{ data: 'subject_id', name: 'subject_id' },
{ data: 'subject_type', name: 'subject_type' },
{ data: 'user_id', name: 'user_id' },
{ data: 'host', name: 'host' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('#order-listing').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});
</script>
@endsection