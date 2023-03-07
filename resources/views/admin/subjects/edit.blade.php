@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subject.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subjects.update", [$subject->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="syllabus_id">{{ trans('cruds.subject.fields.syllabus') }}</label>
                <select class="form-control select2 {{ $errors->has('syllabus') ? 'is-invalid' : '' }}" name="syllabus_id" id="syllabus_id">
                    @foreach($syllabi as $id => $entry)
                        <option value="{{ $id }}" {{ (old('syllabus_id') ? old('syllabus_id') : $subject->syllabus->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('syllabus'))
                    <span class="text-danger">{{ $errors->first('syllabus') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subject.fields.syllabus_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.subject.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $subject->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subject.fields.name_helper') }}</span>
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