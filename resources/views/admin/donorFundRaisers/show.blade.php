@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.donorFundRaiser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donor-fund-raisers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.id') }}
                        </th>
                        <td>
                            {{ $donorFundRaiser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.fundraiser') }}
                        </th>
                        <td>
                            {{ $donorFundRaiser->fundraiser->caption ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.amount') }}
                        </th>
                        <td>
                            {{ $donorFundRaiser->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.caption') }}
                        </th>
                        <td>
                            {{ $donorFundRaiser->caption }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.user') }}
                        </th>
                        <td>
                            {{ $donorFundRaiser->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donor-fund-raisers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection