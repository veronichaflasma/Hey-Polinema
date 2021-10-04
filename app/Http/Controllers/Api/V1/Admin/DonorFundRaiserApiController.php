<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonorFundRaiserRequest;
use App\Http\Requests\UpdateDonorFundRaiserRequest;
use App\Http\Resources\Admin\DonorFundRaiserResource;
use App\Models\DonorFundRaiser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonorFundRaiserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('donor_fund_raiser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DonorFundRaiserResource(DonorFundRaiser::with(['fundraiser', 'user'])->get());
    }

    public function store(StoreDonorFundRaiserRequest $request)
    {
        $donorFundRaiser = DonorFundRaiser::create($request->all());

        return (new DonorFundRaiserResource($donorFundRaiser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DonorFundRaiser $donorFundRaiser)
    {
        abort_if(Gate::denies('donor_fund_raiser_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DonorFundRaiserResource($donorFundRaiser->load(['fundraiser', 'user']));
    }

    public function update(UpdateDonorFundRaiserRequest $request, DonorFundRaiser $donorFundRaiser)
    {
        $donorFundRaiser->update($request->all());

        return (new DonorFundRaiserResource($donorFundRaiser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DonorFundRaiser $donorFundRaiser)
    {
        abort_if(Gate::denies('donor_fund_raiser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donorFundRaiser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
