@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.toolssyllabusYear.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.toolssyllabus-years.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="year">{{ trans('cruds.toolssyllabusYear.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year', '') }}" step="1" required>
                @if($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toolssyllabusYear.fields.year_helper') }}</span>
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