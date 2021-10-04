@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.feed.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.feeds.update", [$feed->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.feed.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $feed->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feed.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="caption">{{ trans('cruds.feed.fields.caption') }}</label>
                <textarea class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}" name="caption" id="caption" required>{{ old('caption', $feed->caption) }}</textarea>
                @if($errors->has('caption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feed.fields.caption_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="media">{{ trans('cruds.feed.fields.media') }}</label>
                <div class="needsclick dropzone {{ $errors->has('media') ? 'is-invalid' : '' }}" id="media-dropzone">
                </div>
                @if($errors->has('media'))
                    <div class="invalid-feedback">
                        {{ $errors->first('media') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feed.fields.media_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.feed.fields.status') }}</label>
                @foreach(App\Models\Feed::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $feed->status) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feed.fields.status_helper') }}</span>
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
    var uploadedMediaMap = {}
Dropzone.options.mediaDropzone = {
    url: '{{ route('admin.feeds.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="media[]" value="' + response.name + '">')
      uploadedMediaMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedMediaMap[file.name]
      }
      $('form').find('input[name="media[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($feed) && $feed->media)
      var files = {!! json_encode($feed->media) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="media[]" value="' + file.file_name + '">')
        }
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