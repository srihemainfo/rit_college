@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reg_no">{{ trans('cruds.student.fields.reg_no') }}</label>
                <input class="form-control {{ $errors->has('reg_no') ? 'is-invalid' : '' }}" type="number" name="reg_no" id="reg_no" value="{{ old('reg_no', '') }}" step="1" required>
                @if($errors->has('reg_no'))
                    <span class="text-danger">{{ $errors->first('reg_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.reg_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="enroll_master_id">{{ trans('cruds.student.fields.enroll_master') }}</label>
                <select class="form-control select2 {{ $errors->has('enroll_master') ? 'is-invalid' : '' }}" name="enroll_master_id" id="enroll_master_id">
                    @foreach($enroll_masters as $id => $entry)
                        <option value="{{ $id }}" {{ old('enroll_master_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('enroll_master'))
                    <span class="text-danger">{{ $errors->first('enroll_master') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.enroll_master_helper') }}</span>
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