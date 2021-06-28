@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'User', 'route' => 'admin.users.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
	<div class="card-body">
		<h4 class="card-title">Data table</h4>
		<div class="row">
			<div class="col-12">
				<div class="table-responsive">
					<table id="order-listing" class="table datatable" style="width: 100%;">
						<thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email_verified_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.approved') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.verified') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.username') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.regional') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.witel') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <!-- <div style="width: 100px;"> -->
                                    <input class="search form-control" type="text" placeholder="{{ trans('global.search') }}">
                                <!-- </div> -->
                            </td>
                            <td>
                                <input class="search form-control" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <div style="width: 100px;">
                                    <select class="search">
                                        <option value>{{ trans('global.all') }}</option>
                                        @foreach($roles as $key => $item)
                                            <option value="{{ $item->title }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <!-- <div style="width: 100px;"> -->
                                    <input class="search form-control" type="text" placeholder="{{ trans('global.search') }}">
                                <!-- </div> -->
                            </td>
                            <td>
                                <div style="width: 100px;">
                                    <select class="search">
                                        <option value>{{ trans('global.all') }}</option>
                                        @foreach($regionals as $key => $item)
                                            <option value="{{ $item->nama_regional }}">{{ $item->nama_regional }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div style="width: 100px;">
                                    <select class="search">
                                        <option value>{{ trans('global.all') }}</option>
                                        @foreach($witels as $key => $item)
                                            <option value="{{ $item->nama_witel }}">{{ $item->nama_witel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                            </td>
                        </tr>
						</thead>
						<tbody>
                        </tbody>
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'email', name: 'email' },
{ data: 'email_verified_at', name: 'email_verified_at' },
{ data: 'approved', name: 'approved' },
{ data: 'verified', name: 'verified' },
{ data: 'roles', name: 'roles.title' },
{ data: 'username', name: 'username' },
{ data: 'regional_nama_regional', name: 'regional.nama_regional' },
{ data: 'witel_nama_witel', name: 'witel.nama_witel' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('#order-listing').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
});

</script>
@parent

@endsection