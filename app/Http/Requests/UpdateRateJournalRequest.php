<?php

namespace App\Http\Requests;

use App\Models\RateJournal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRateJournalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rate_journal_edit');
    }

    public function rules()
    {
        return [
            'journal_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'rate' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
