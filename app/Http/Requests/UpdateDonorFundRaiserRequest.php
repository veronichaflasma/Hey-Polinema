<?php

namespace App\Http\Requests;

use App\Models\DonorFundRaiser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDonorFundRaiserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('donor_fund_raiser_edit');
    }

    public function rules()
    {
        return [
            'fundraiser_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'caption' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
