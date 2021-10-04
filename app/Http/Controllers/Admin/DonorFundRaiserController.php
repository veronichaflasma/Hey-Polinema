<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDonorFundRaiserRequest;
use App\Http\Requests\StoreDonorFundRaiserRequest;
use App\Http\Requests\UpdateDonorFundRaiserRequest;
use App\Models\DonorFundRaiser;
use App\Models\OwnerFundRaiser;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DonorFundRaiserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('donor_fund_raiser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DonorFundRaiser::with(['fundraiser', 'user'])->select(sprintf('%s.*', (new DonorFundRaiser())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'donor_fund_raiser_show';
                $editGate = 'donor_fund_raiser_edit';
                $deleteGate = 'donor_fund_raiser_delete';
                $crudRoutePart = 'donor-fund-raisers';

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
            $table->addColumn('fundraiser_caption', function ($row) {
                return $row->fundraiser ? $row->fundraiser->caption : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('caption', function ($row) {
                return $row->caption ? $row->caption : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fundraiser', 'user']);

            return $table->make(true);
        }

        return view('admin.donorFundRaisers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('donor_fund_raiser_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fundraisers = OwnerFundRaiser::pluck('caption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.donorFundRaisers.create', compact('fundraisers', 'users'));
    }

    public function store(StoreDonorFundRaiserRequest $request)
    {
        $donorFundRaiser = DonorFundRaiser::create($request->all());

        return redirect()->route('admin.donor-fund-raisers.index');
    }

    public function edit(DonorFundRaiser $donorFundRaiser)
    {
        abort_if(Gate::denies('donor_fund_raiser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fundraisers = OwnerFundRaiser::pluck('caption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $donorFundRaiser->load('fundraiser', 'user');

        return view('admin.donorFundRaisers.edit', compact('fundraisers', 'users', 'donorFundRaiser'));
    }

    public function update(UpdateDonorFundRaiserRequest $request, DonorFundRaiser $donorFundRaiser)
    {
        $donorFundRaiser->update($request->all());

        return redirect()->route('admin.donor-fund-raisers.index');
    }

    public function show(DonorFundRaiser $donorFundRaiser)
    {
        abort_if(Gate::denies('donor_fund_raiser_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donorFundRaiser->load('fundraiser', 'user');

        return view('admin.donorFundRaisers.show', compact('donorFundRaiser'));
    }

    public function destroy(DonorFundRaiser $donorFundRaiser)
    {
        abort_if(Gate::denies('donor_fund_raiser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donorFundRaiser->delete();

        return back();
    }

    public function massDestroy(MassDestroyDonorFundRaiserRequest $request)
    {
        DonorFundRaiser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
