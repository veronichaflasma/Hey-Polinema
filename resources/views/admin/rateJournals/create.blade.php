@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rateJournal.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rate-journals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="journal_id">{{ trans('cruds.rateJournal.fields.journal') }}</label>
                <select class="form-control select2 {{ $errors->has('journal') ? 'is-invalid' : '' }}" name="journal_id" id="journal_id" required>
                    @foreach($journals as $id => $entry)
                        <option value="{{ $id }}" {{ old('journal_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('journal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('journal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rateJournal.fields.journal_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.rateJournal.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rateJournal.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rate">{{ trans('cruds.rateJournal.fields.rate') }}</label>
                <input class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" type="number" name="rate" id="rate" value="{{ old('rate', '1') }}" step="1" required>
                @if($errors->has('rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rateJournal.fields.rate_helper') }}</span>
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