<?php

namespace App\Http\Requests;

use App\Models\Feed;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFeedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feed_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'caption' => [
                'required',
            ],
        ];
    }
}
