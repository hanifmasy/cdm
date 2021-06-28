@extends('layouts.admin')
@section('content')

<div class="col-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.demandAddonSale.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CaringCt0">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.caringCt0.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.caringCt0.fields.witel_str') }}
                        </th>
                        <th>
                            {{ trans('cruds.caringCt0.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.caringCt0.fields.alamat') }}
                        </th>
                        <th>
                            {{ trans('cruds.caringCt0.fields.notel') }}
                        </th>
                        <th>
                            {{ trans('cruds.caringCt0.fields.no_hp') }}
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
@endsection