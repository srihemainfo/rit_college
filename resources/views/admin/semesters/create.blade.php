@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.semester.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.semesters.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="semester">{{ trans('cruds.semester.fields.semester') }}</label>
                <input class="form-control {{ $errors->has('semester') ? 'is-invalid' : '' }}" type="text" name="semester" id="semester" value="{{ old('semester', '') }}" required>
                @if($errors->has('semester'))
                    <span class="text-danger">{{ $errors->first('semester') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.semester.fields.semester_helper') }}</span>
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