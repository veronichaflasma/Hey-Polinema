<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_edit');
    }

    public function rules()
    {
        return [
            'nim' => [
                'string',
                'required',
            ],
            'generation' => [
                'string',
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'birthdate' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'linkedin' => [
                'string',
                'nullable',
            ],
        ];
    }
}
