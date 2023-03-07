@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.teachingStaff.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.teaching-staffs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.teachingStaff.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.teachingStaff.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subject_id">{{ trans('cruds.teachingStaff.fields.subject') }}</label>
                <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject_id" id="subject_id">
                    @foreach($subjects as $id => $entry)
                        <option value="{{ $id }}" {{ old('subject_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('subject'))
                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.teachingStaff.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="enroll_master_id">{{ trans('cruds.teachingStaff.fields.enroll_master') }}</label>
                <select class="form-control select2 {{ $errors->has('enroll_master') ? 'is-invalid' : '' }}" name="enroll_master_id" id="enroll_master_id">
                    @foreach($enroll_masters as $id => $entry)
                        <option value="{{ $id }}" {{ old('enroll_master_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('enroll_master'))
                    <span class="text-danger">{{ $errors->first('enroll_master') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.teachingStaff.fields.enroll_master_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="working_as_id">{{ trans('cruds.teachingStaff.fields.working_as') }}</label>
                <select class="form-control select2 {{ $errors->has('working_as') ? 'is-invalid' : '' }}" name="working_as_id" id="working_as_id">
                    @foreach($working_as as $id => $entry)
                        <option value="{{ $id }}" {{ old('working_as_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('working_as'))
                    <span class="text-danger">{{ $errors->first('working_as') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.teachingStaff.fields.working_as_helper') }}</span>
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