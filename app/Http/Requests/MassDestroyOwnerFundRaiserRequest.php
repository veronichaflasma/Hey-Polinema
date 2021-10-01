<?php

namespace App\Http\Requests;

use App\Models\OwnerFundRaiser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOwnerFundRaiserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('owner_fund_raiser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:owner_fund_raisers,id',
        ];
    }
}
