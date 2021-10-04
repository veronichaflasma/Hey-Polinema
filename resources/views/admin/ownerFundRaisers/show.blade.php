@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ownerFundRaiser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.owner-fund-raisers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ownerFundRaiser.fields.id') }}
                        </th>
                        <td>
                            {{ $ownerFundRaiser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownerFundRaiser.fields.user') }}
                        </th>
                        <td>
                            {{ $ownerFundRaiser->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownerFundRaiser.fields.caption') }}
                        </th>
                        <td>
                            {{ $ownerFundRaiser->caption }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownerFundRaiser.fields.photo') }}
                        </th>
                        <td>
                            @if($ownerFundRaiser->photo)
                                <a href="{{ $ownerFundRaiser->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $ownerFundRaiser->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownerFundRaiser.fields.fund') }}
                        </th>
                        <td>
                            {{ $ownerFundRaiser->fund }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownerFundRaiser.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\OwnerFundRaiser::STATUS_RADIO[$ownerFundRaiser->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownerFundRaiser.fields.days') }}
                        </th>
                        <td>
                            {{ $ownerFundRaiser->days }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.owner-fund-raisers.index') }}">
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
            <a class="nav-link" href="#fundraiser_donor_fund_raisers" role="tab" data-toggle="tab">
                {{ trans('cruds.donorFundRaiser.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="fundraiser_donor_fund_raisers">
            @includeIf('admin.ownerFundRaisers.relationships.fundraiserDonorFundRaisers', ['donorFundRaisers' => $ownerFundRaiser->fundraiserDonorFundRaisers])
        </div>
    </div>
</div>

@endsection