@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.journal.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.journals.update", [$journal->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="owner_id">{{ trans('cruds.journal.fields.owner') }}</label>
                <select class="form-control select2 {{ $errors->has('owner') ? 'is-invalid' : '' }}" name="owner_id" id="owner_id" required>
                    @foreach($owners as $id => $entry)
                        <option value="{{ $id }}" {{ (old('owner_id') ? old('owner_id') : $journal->owner->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('owner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('owner') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.journal.fields.owner_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="caption">{{ trans('cruds.journal.fields.caption') }}</label>
                <input class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}" type="text" name="caption" id="caption" value="{{ old('caption', $journal->caption) }}" required>
                @if($errors->has('caption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.journal.fields.caption_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file">{{ trans('cruds.journal.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.journal.fields.file_helper') }}</span>
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
    Dropzone.options.fileDropzone = {
    url: '{{ route('admin.journals.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file"]').remove()
      $('form').append('<input type="hidden" name="file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($journal) && $journal->file)
      var file = {!! json_encode($journal->file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file" value="' + file.file_name + '">')
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