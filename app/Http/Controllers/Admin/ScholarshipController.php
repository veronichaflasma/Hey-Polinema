<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyScholarshipRequest;
use App\Http\Requests\StoreScholarshipRequest;
use App\Http\Requests\UpdateScholarshipRequest;
use App\Models\Scholarship;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ScholarshipController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('scholarship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Scholarship::with(['user'])->select(sprintf('%s.*', (new Scholarship())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'scholarship_show';
                $editGate = 'scholarship_edit';
                $deleteGate = 'scholarship_delete';
                $crudRoutePart = 'scholarships';

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

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.scholarships.index');
    }

    public function create()
    {
        abort_if(Gate::denies('scholarship_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.scholarships.create', compact('users'));
    }

    public function store(StoreScholarshipRequest $request)
    {
        $scholarship = Scholarship::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $scholarship->id]);
        }

        return redirect()->route('admin.scholarships.index');
    }

    public function edit(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $scholarship->load('user');

        return view('admin.scholarships.edit', compact('users', 'scholarship'));
    }

    public function update(UpdateScholarshipRequest $request, Scholarship $scholarship)
    {
        $scholarship->update($request->all());

        return redirect()->route('admin.scholarships.index');
    }

    public function show(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->load('user');

        return view('admin.scholarships.show', compact('scholarship'));
    }

    public function destroy(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->delete();

        return back();
    }

    public function massDestroy(MassDestroyScholarshipRequest $request)
    {
        Scholarship::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('scholarship_create') && Gate::denies('scholarship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Scholarship();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
