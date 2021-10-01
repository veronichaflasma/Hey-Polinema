@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="feed_id">{{ trans('cruds.comment.fields.feed') }}</label>
                <select class="form-control select2 {{ $errors->has('feed') ? 'is-invalid' : '' }}" name="feed_id" id="feed_id" required>
                    @foreach($feeds as $id => $entry)
                        <option value="{{ $id }}" {{ old('feed_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('feed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('feed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.feed_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sender_id">{{ trans('cruds.comment.fields.sender') }}</label>
                <select class="form-control select2 {{ $errors->has('sender') ? 'is-invalid' : '' }}" name="sender_id" id="sender_id" required>
                    @foreach($senders as $id => $entry)
                        <option value="{{ $id }}" {{ old('sender_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.sender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="comment">{{ trans('cruds.comment.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment" required>{{ old('comment') }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.comment.fields.status') }}</label>
                @foreach(App\Models\Comment::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', 'safe') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.status_helper') }}</span>
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