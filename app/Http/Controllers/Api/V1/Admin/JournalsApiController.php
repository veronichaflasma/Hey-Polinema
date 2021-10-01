<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreJournalRequest;
use App\Http\Requests\UpdateJournalRequest;
use App\Http\Resources\Admin\JournalResource;
use App\Models\Journal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JournalsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('journal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JournalResource(Journal::with(['owner'])->get());
    }

    public function store(StoreJournalRequest $request)
    {
        $journal = Journal::create($request->all());

        if ($request->input('file', false)) {
            $journal->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new JournalResource($journal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Journal $journal)
    {
        abort_if(Gate::denies('journal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JournalResource($journal->load(['owner']));
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

        return (new JournalResource($journal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Journal $journal)
    {
        abort_if(Gate::denies('journal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $journal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
