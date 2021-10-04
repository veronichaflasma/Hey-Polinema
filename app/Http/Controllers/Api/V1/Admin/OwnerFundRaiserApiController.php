<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOwnerFundRaiserRequest;
use App\Http\Requests\UpdateOwnerFundRaiserRequest;
use App\Http\Resources\Admin\OwnerFundRaiserResource;
use App\Models\OwnerFundRaiser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerFundRaiserApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('owner_fund_raiser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OwnerFundRaiserResource(OwnerFundRaiser::with(['user'])->get());
    }

    public function store(StoreOwnerFundRaiserRequest $request)
    {
        $ownerFundRaiser = OwnerFundRaiser::create($request->all());

        if ($request->input('photo', false)) {
            $ownerFundRaiser->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new OwnerFundRaiserResource($ownerFundRaiser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OwnerFundRaiser $ownerFundRaiser)
    {
        abort_if(Gate::denies('owner_fund_raiser_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OwnerFundRaiserResource($ownerFundRaiser->load(['user']));
    }

    public function update(UpdateOwnerFundRaiserRequest $request, OwnerFundRaiser $ownerFundRaiser)
    {
        $ownerFundRaiser->update($request->all());

        if ($request->input('photo', false)) {
            if (!$ownerFundRaiser->photo || $request->input('photo') !== $ownerFundRaiser->photo->file_name) {
                if ($ownerFundRaiser->photo) {
                    $ownerFundRaiser->photo->delete();
                }
                $ownerFundRaiser->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($ownerFundRaiser->photo) {
            $ownerFundRaiser->photo->delete();
        }

        return (new OwnerFundRaiserResource($ownerFundRaiser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OwnerFundRaiser $ownerFundRaiser)
    {
        abort_if(Gate::denies('owner_fund_raiser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownerFundRaiser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
