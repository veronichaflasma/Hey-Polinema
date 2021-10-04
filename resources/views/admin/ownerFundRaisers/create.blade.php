@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ownerFundRaiser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.owner-fund-raisers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.ownerFundRaiser.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.ownerFundRaiser.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="caption">{{ trans('cruds.ownerFundRaiser.fields.caption') }}</label>
                <input class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}" type="text" name="caption" id="caption" value="{{ old('caption', '') }}" required>
                @if($errors->has('caption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ownerFundRaiser.fields.caption_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.ownerFundRaiser.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ownerFundRaiser.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fund">{{ trans('cruds.ownerFundRaiser.fields.fund') }}</label>
                <input class="form-control {{ $errors->has('fund') ? 'is-invalid' : '' }}" type="number" name="fund" id="fund" value="{{ old('fund', '0') }}" step="0.01">
                @if($errors->has('fund'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fund') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ownerFundRaiser.fields.fund_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.ownerFundRaiser.fields.status') }}</label>
                @foreach(App\Models\OwnerFundRaiser::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ownerFundRaiser.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="days">{{ trans('cruds.ownerFundRaiser.fields.days') }}</label>
                <input class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}" type="number" name="days" id="days" value="{{ old('days', '') }}" step="1">
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ownerFundRaiser.fields.days_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.owner-fund-raisers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($ownerFundRaiser) && $ownerFundRaiser->photo)
      var file = {!! json_encode($ownerFundRaiser->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection