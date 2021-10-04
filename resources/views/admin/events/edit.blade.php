@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.event.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $event->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_event">{{ trans('cruds.event.fields.date_event') }}</label>
                <input class="form-control date {{ $errors->has('date_event') ? 'is-invalid' : '' }}" type="text" name="date_event" id="date_event" value="{{ old('date_event', $event->date_event) }}" required>
                @if($errors->has('date_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.date_event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.event.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="about">{{ trans('cruds.event.fields.about') }}</label>
                <input class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}" type="text" name="about" id="about" value="{{ old('about', $event->about) }}" required>
                @if($errors->has('about'))
                    <div class="invalid-feedback">
                        {{ $errors->first('about') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.about_helper') }}</span>
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