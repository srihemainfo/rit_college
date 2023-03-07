<?php

namespace App\Http\Requests;

use App\Models\CollegeCalender;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCollegeCalenderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('college_calender_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'nullable',
            ],
            'academic_year' => [
                'string',
                'nullable',
            ],
            'shift' => [
                'string',
                'nullable',
            ],
            'semester_type' => [
                'string',
                'nullable',
            ],
            'from_date' => [
                'string',
                'nullable',
            ],
            'to_date' => [
                'string',
                'nullable',
            ],
        ];
    }
}
