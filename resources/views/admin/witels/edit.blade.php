@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.witel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.witels.update", [$witel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_witel">{{ trans('cruds.witel.fields.nama_witel') }}</label>
                <input class="form-control {{ $errors->has('nama_witel') ? 'is-invalid' : '' }}" type="text" name="nama_witel" id="nama_witel" value="{{ old('nama_witel', $witel->nama_witel) }}" required>
                @if($errors->has('nama_witel'))
                    <span class="text-danger">{{ $errors->first('nama_witel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.witel.fields.nama_witel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="regional_id">{{ trans('cruds.witel.fields.regional') }}</label>
                <select class="form-control select2 {{ $errors->has('regional') ? 'is-invalid' : '' }}" name="regional_id" id="regional_id" required>
                    @foreach($regionals as $id => $regional)
                        <option value="{{ $id }}" {{ (old('regional_id') ? old('regional_id') : $witel->regional->id ?? '') == $id ? 'selected' : '' }}>{{ $regional }}</option>
                    @endforeach
                </select>
                @if($errors->has('regional'))
                    <span class="text-danger">{{ $errors->first('regional') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.witel.fields.regional_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection