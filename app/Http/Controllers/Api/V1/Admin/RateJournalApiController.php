<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRateJournalRequest;
use App\Http\Requests\UpdateRateJournalRequest;
use App\Http\Resources\Admin\RateJournalResource;
use App\Models\RateJournal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateJournalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rate_journal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RateJournalResource(RateJournal::with(['journal', 'user'])->get());
    }

    public function store(StoreRateJournalRequest $request)
    {
        $rateJournal = RateJournal::create($request->all());

        return (new RateJournalResource($rateJournal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RateJournal $rateJournal)
    {
        abort_if(Gate::denies('rate_journal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RateJournalResource($rateJournal->load(['journal', 'user']));
    }

    public function update(UpdateRateJournalRequest $request, RateJournal $rateJournal)
    {
        $rateJournal->update($request->all());

        return (new RateJournalResource($rateJournal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RateJournal $rateJournal)
    {
        abort_if(Gate::denies('rate_journal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rateJournal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
