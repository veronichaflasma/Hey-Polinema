<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFeedRequest;
use App\Http\Requests\UpdateFeedRequest;
use App\Http\Resources\Admin\FeedResource;
use App\Models\Feed;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('feed_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedResource(Feed::with(['user'])->get());
    }

    public function store(StoreFeedRequest $request)
    {
        $feed = Feed::create($request->all());

        if ($request->input('media', false)) {
            $feed->addMedia(storage_path('tmp/uploads/' . basename($request->input('media'))))->toMediaCollection('media');
        }

        return (new FeedResource($feed))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Feed $feed)
    {
        abort_if(Gate::denies('feed_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedResource($feed->load(['user']));
    }

    public function update(UpdateFeedRequest $request, Feed $feed)
    {
        $feed->update($request->all());

        if ($request->input('media', false)) {
            if (!$feed->media || $request->input('media') !== $feed->media->file_name) {
                if ($feed->media) {
                    $feed->media->delete();
                }
                $feed->addMedia(storage_path('tmp/uploads/' . basename($request->input('media'))))->toMediaCollection('media');
            }
        } elseif ($feed->media) {
            $feed->media->delete();
        }

        return (new FeedResource($feed))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Feed $feed)
    {
        abort_if(Gate::denies('feed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feed->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
