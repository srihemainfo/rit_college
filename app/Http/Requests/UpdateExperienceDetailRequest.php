<?php

namespace App\Http\Requests;

use App\Models\ExperienceDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExperienceDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('experience_detail_edit');
    }

    public function rules()
    {
        return [
            'designation' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
            'years_of_experience' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'worked_place' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
            'taken_subjects' => [
                'string',
                'min:1',
                'max:1000',
                'nullable',
            ],
            'from_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'to_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
