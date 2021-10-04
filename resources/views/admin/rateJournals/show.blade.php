@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rateJournal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rate-journals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rateJournal.fields.id') }}
                        </th>
                        <td>
                            {{ $rateJournal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rateJournal.fields.journal') }}
                        </th>
                        <td>
                            {{ $rateJournal->journal->caption ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rateJournal.fields.user') }}
                        </th>
                        <td>
                            {{ $rateJournal->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rateJournal.fields.rate') }}
                        </th>
                        <td>
                            {{ $rateJournal->rate }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rate-journals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection