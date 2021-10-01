<?php

namespace App\Http\Requests;

use App\Models\DonorFundRaiser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDonorFundRaiserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('donor_fund_raiser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:donor_fund_raisers,id',
        ];
    }
}
