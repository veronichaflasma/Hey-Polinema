@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.journal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.journals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.journal.fields.id') }}
                        </th>
                        <td>
                            {{ $journal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.journal.fields.owner') }}
                        </th>
                        <td>
                            {{ $journal->owner->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.journal.fields.caption') }}
                        </th>
                        <td>
                            {{ $journal->caption }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.journal.fields.file') }}
                        </th>
                        <td>
                            @if($journal->file)
                                <a href="{{ $journal->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.journals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#journal_rate_journals" role="tab" data-toggle="tab">
                {{ trans('cruds.rateJournal.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="journal_rate_journals">
            @includeIf('admin.journals.relationships.journalRateJournals', ['rateJournals' => $journal->journalRateJournals])
        </div>
    </div>
</div>

@endsection