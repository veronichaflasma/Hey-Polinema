@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.donorFundRaiser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.donor-fund-raisers.update", [$donorFundRaiser->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="fundraiser_id">{{ trans('cruds.donorFundRaiser.fields.fundraiser') }}</label>
                <select class="form-control select2 {{ $errors->has('fundraiser') ? 'is-invalid' : '' }}" name="fundraiser_id" id="fundraiser_id" required>
                    @foreach($fundraisers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('fundraiser_id') ? old('fundraiser_id') : $donorFundRaiser->fundraiser->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fundraiser'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fundraiser') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donorFundRaiser.fields.fundraiser_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.donorFundRaiser.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $donorFundRaiser->amount) }}" step="1" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donorFundRaiser.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="caption">{{ trans('cruds.donorFundRaiser.fields.caption') }}</label>
                <input class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}" type="text" name="caption" id="caption" value="{{ old('caption', $donorFundRaiser->caption) }}">
                @if($errors->has('caption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donorFundRaiser.fields.caption_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.donorFundRaiser.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $donorFundRaiser->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donorFundRaiser.fields.user_helper') }}</span>
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