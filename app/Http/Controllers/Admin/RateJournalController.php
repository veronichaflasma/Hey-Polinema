<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRateJournalRequest;
use App\Http\Requests\StoreRateJournalRequest;
use App\Http\Requests\UpdateRateJournalRequest;
use App\Models\Journal;
use App\Models\RateJournal;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RateJournalController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('rate_journal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RateJournal::with(['journal', 'user'])->select(sprintf('%s.*', (new RateJournal())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rate_journal_show';
                $editGate = 'rate_journal_edit';
                $deleteGate = 'rate_journal_delete';
                $crudRoutePart = 'rate-journals';

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
            $table->addColumn('journal_caption', function ($row) {
                return $row->journal ? $row->journal->caption : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('rate', function ($row) {
                return $row->rate ? $row->rate : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'journal', 'user']);

            return $table->make(true);
        }

        return view('admin.rateJournals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('rate_journal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $journals = Journal::pluck('caption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rateJournals.create', compact('journals', 'users'));
    }

    public function store(StoreRateJournalRequest $request)
    {
        $rateJournal = RateJournal::create($request->all());

        return redirect()->route('admin.rate-journals.index');
    }

    public function edit(RateJournal $rateJournal)
    {
        abort_if(Gate::denies('rate_journal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $journals = Journal::pluck('caption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rateJournal->load('journal', 'user');

        return view('admin.rateJournals.edit', compact('journals', 'users', 'rateJournal'));
    }

    public function update(UpdateRateJournalRequest $request, RateJournal $rateJournal)
    {
        $rateJournal->update($request->all());

        return redirect()->route('admin.rate-journals.index');
    }

    public function show(RateJournal $rateJournal)
    {
        abort_if(Gate::denies('rate_journal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rateJournal->load('journal', 'user');

        return view('admin.rateJournals.show', compact('rateJournal'));
    }

    public function destroy(RateJournal $rateJournal)
    {
        abort_if(Gate::denies('rate_journal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rateJournal->delete();

        return back();
    }

    public function massDestroy(MassDestroyRateJournalRequest $request)
    {
        RateJournal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
