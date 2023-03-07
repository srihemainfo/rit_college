@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.educationBoard.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.education-boards.update", [$educationBoard->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="education_board">{{ trans('cruds.educationBoard.fields.education_board') }}</label>
                <input class="form-control {{ $errors->has('education_board') ? 'is-invalid' : '' }}" type="text" name="education_board" id="education_board" value="{{ old('education_board', $educationBoard->education_board) }}">
                @if($errors->has('education_board'))
                    <span class="text-danger">{{ $errors->first('education_board') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.educationBoard.fields.education_board_helper') }}</span>
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