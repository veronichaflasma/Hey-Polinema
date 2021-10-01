<?php

namespace App\Http\Requests;

use App\Models\RateJournal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRateJournalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rate_journal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rate_journals,id',
        ];
    }
}
