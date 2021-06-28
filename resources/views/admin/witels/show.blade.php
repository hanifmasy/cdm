@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.witel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.witels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.witel.fields.id') }}
                        </th>
                        <td>
                            {{ $witel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.witel.fields.nama_witel') }}
                        </th>
                        <td>
                            {{ $witel->nama_witel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.witel.fields.regional') }}
                        </th>
                        <td>
                            {{ $witel->regional->nama_regional ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.witels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection