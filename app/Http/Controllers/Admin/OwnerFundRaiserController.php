<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOwnerFundRaiserRequest;
use App\Http\Requests\StoreOwnerFundRaiserRequest;
use App\Http\Requests\UpdateOwnerFundRaiserRequest;
use App\Models\OwnerFundRaiser;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OwnerFundRaiserController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('owner_fund_raiser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OwnerFundRaiser::with(['user'])->select(sprintf('%s.*', (new OwnerFundRaiser())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'owner_fund_raiser_show';
                $editGate = 'owner_fund_raiser_edit';
                $deleteGate = 'owner_fund_raiser_delete';
                $crudRoutePart = 'owner-fund-raisers';

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
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('fund', function ($row) {
                return $row->fund ? $row->fund : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? OwnerFundRaiser::STATUS_RADIO[$row->status] : '';
            });
            $table->editColumn('days', function ($row) {
                return $row->days ? $row->days : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'photo']);

            return $table->make(true);
        }

        return view('admin.ownerFundRaisers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('owner_fund_raiser_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ownerFundRaisers.create', compact('users'));
    }

    public function store(StoreOwnerFundRaiserRequest $request)
    {
        $ownerFundRaiser = OwnerFundRaiser::create($request->all());

        if ($request->input('photo', false)) {
            $ownerFundRaiser->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ownerFundRaiser->id]);
        }

        return redirect()->route('admin.owner-fund-raisers.index');
    }

    public function edit(OwnerFundRaiser $ownerFundRaiser)
    {
        abort_if(Gate::denies('owner_fund_raiser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ownerFundRaiser->load('user');

        return view('admin.ownerFundRaisers.edit', compact('users', 'ownerFundRaiser'));
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

        return redirect()->route('admin.owner-fund-raisers.index');
    }

    public function show(OwnerFundRaiser $ownerFundRaiser)
    {
        abort_if(Gate::denies('owner_fund_raiser_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownerFundRaiser->load('user', 'fundraiserDonorFundRaisers');

        return view('admin.ownerFundRaisers.show', compact('ownerFundRaiser'));
    }

    public function destroy(OwnerFundRaiser $ownerFundRaiser)
    {
        abort_if(Gate::denies('owner_fund_raiser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownerFundRaiser->delete();

        return back();
    }

    public function massDestroy(MassDestroyOwnerFundRaiserRequest $request)
    {
        OwnerFundRaiser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('owner_fund_raiser_create') && Gate::denies('owner_fund_raiser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new OwnerFundRaiser();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
