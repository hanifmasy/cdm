@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.regional.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.regionals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_regional">{{ trans('cruds.regional.fields.nama_regional') }}</label>
                <input class="form-control {{ $errors->has('nama_regional') ? 'is-invalid' : '' }}" type="text" name="nama_regional" id="nama_regional" value="{{ old('nama_regional', '') }}" required>
                @if($errors->has('nama_regional'))
                    <span class="text-danger">{{ $errors->first('nama_regional') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.regional.fields.nama_regional_helper') }}</span>
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