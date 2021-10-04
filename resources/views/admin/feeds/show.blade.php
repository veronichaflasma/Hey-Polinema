@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.feed.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feeds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.feed.fields.id') }}
                        </th>
                        <td>
                            {{ $feed->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feed.fields.user') }}
                        </th>
                        <td>
                            {{ $feed->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feed.fields.caption') }}
                        </th>
                        <td>
                            {{ $feed->caption }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feed.fields.media') }}
                        </th>
                        <td>
                            @foreach($feed->media as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feed.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Feed::STATUS_RADIO[$feed->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feeds.index') }}">
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
            <a class="nav-link" href="#feed_comments" role="tab" data-toggle="tab">
                {{ trans('cruds.comment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="feed_comments">
            @includeIf('admin.feeds.relationships.feedComments', ['comments' => $feed->feedComments])
        </div>
    </div>
</div>

@endsection