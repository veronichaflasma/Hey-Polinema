<?php

namespace App\Http\Requests;

use App\Models\OwnerFundRaiser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOwnerFundRaiserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('owner_fund_raiser_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'caption' => [
                'string',
                'required',
            ],
            'days' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
