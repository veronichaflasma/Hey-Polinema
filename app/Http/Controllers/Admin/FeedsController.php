<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFeedRequest;
use App\Http\Requests\StoreFeedRequest;
use App\Http\Requests\UpdateFeedRequest;
use App\Models\Feed;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeedsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('feed_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Feed::with(['user'])->select(sprintf('%s.*', (new Feed())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'feed_show';
                $editGate = 'feed_edit';
                $deleteGate = 'feed_delete';
                $crudRoutePart = 'feeds';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('caption', function ($row) {
                return $row->caption ? $row->caption : '';
            });
            $table->editColumn('media', function ($row) {
                if (!$row->media) {
                    return '';
                }
                $links = [];
                foreach ($row->media as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Feed::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'media']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.feeds.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('feed_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.feeds.create', compact('users'));
    }

    public function store(StoreFeedRequest $request)
    {
        $feed = Feed::create($request->all());

        foreach ($request->input('media', []) as $file) {
            $feed->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('media');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $feed->id]);
        }

        return redirect()->route('admin.feeds.index');
    }

    public function edit(Feed $feed)
    {
        abort_if(Gate::denies('feed_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feed->load('user');

        return view('admin.feeds.edit', compact('users', 'feed'));
    }

    public function update(UpdateFeedRequest $request, Feed $feed)
    {
        $feed->update($request->all());

        if (count($feed->media) > 0) {
            foreach ($feed->media as $media) {
                if (!in_array($media->file_name, $request->input('media', []))) {
                    $media->delete();
                }
            }
        }
        $media = $feed->media->pluck('file_name')->toArray();
        foreach ($request->input('media', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $feed->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('media');
            }
        }

        return redirect()->route('admin.feeds.index');
    }

    public function show(Feed $feed)
    {
        abort_if(Gate::denies('feed_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feed->load('user', 'feedComments');

        return view('admin.feeds.show', compact('feed'));
    }

    public function destroy(Feed $feed)
    {
        abort_if(Gate::denies('feed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feed->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeedRequest $request)
    {
        Feed::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('feed_create') && Gate::denies('feed_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Feed();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
