@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.classRoom.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.class-rooms.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.classRoom.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="block_id">{{ trans('cruds.classRoom.fields.block') }}</label>
                <select class="form-control select2 {{ $errors->has('block') ? 'is-invalid' : '' }}" name="block_id" id="block_id">
                    @foreach($blocks as $id => $entry)
                        <option value="{{ $id }}" {{ old('block_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('block'))
                    <span class="text-danger">{{ $errors->first('block') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.block_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.classRoom.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="room_no">{{ trans('cruds.classRoom.fields.room_no') }}</label>
                <input class="form-control {{ $errors->has('room_no') ? 'is-invalid' : '' }}" type="number" name="room_no" id="room_no" value="{{ old('room_no', '') }}" step="1">
                @if($errors->has('room_no'))
                    <span class="text-danger">{{ $errors->first('room_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.room_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_of_seat">{{ trans('cruds.classRoom.fields.no_of_seat') }}</label>
                <input class="form-control {{ $errors->has('no_of_seat') ? 'is-invalid' : '' }}" type="number" name="no_of_seat" id="no_of_seat" value="{{ old('no_of_seat', '') }}" step="1">
                @if($errors->has('no_of_seat'))
                    <span class="text-danger">{{ $errors->first('no_of_seat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.no_of_seat_helper') }}</span>
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