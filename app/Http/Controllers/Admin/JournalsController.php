<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJournalRequest;
use App\Http\Requests\StoreJournalRequest;
use App\Http\Requests\UpdateJournalRequest;
use App\Models\Journal;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JournalsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('journal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Journal::with(['owner'])->select(sprintf('%s.*', (new Journal())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'journal_show';
                $editGate = 'journal_edit';
                $deleteGate = 'journal_delete';
                $crudRoutePart = 'journals';

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
            $table->addColumn('owner_name', function ($row) {
                return $row->owner ? $row->owner->name : '';
            });

            $table->editColumn('caption', function ($row) {
                return $row->caption ? $row->caption : '';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'owner', 'file']);

            return $table->make(true);
        }

        return view('admin.journals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('journal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $owners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.journals.create', compact('owners'));
    }

    public function store(StoreJournalRequest $request)
    {
        $journal = Journal::create($request->all());

        if ($request->input('file', false)) {
            $journal->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $journal->id]);
        }

        return redirect()->route('admin.journals.index');
    }

    public function edit(Journal $journal)
    {
        abort_if(Gate::denies('journal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $owners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $journal->load('owner');

        return view('admin.journals.edit', compact('owners', 'journal'));
    }

    public function update(UpdateJournalRequest $request, Journal $journal)
    {
        $journal->update($request->all());

        if ($request->input('file', false)) {
            if (!$journal->file || $request->input('file') !== $journal->file->file_name) {
                if ($journal->file) {
                    $journal->file->delete();
                }
                $journal->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($journal->file) {
            $journal->file->delete();
        }

        return redirect()->route('admin.journals.index');
    }

    public function show(Journal $journal)
    {
        abort_if(Gate::denies('journal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $journal->load('owner', 'journalRateJournals');

        return view('admin.journals.show', compact('journal'));
    }

    public function destroy(Journal $journal)
    {
        abort_if(Gate::denies('journal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $journal->delete();

        return back();
    }

    public function massDestroy(MassDestroyJournalRequest $request)
    {
        Journal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('journal_create') && Gate::denies('journal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Journal();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
