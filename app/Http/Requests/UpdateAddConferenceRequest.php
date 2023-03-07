<?php

namespace App\Http\Requests;

use App\Models\AddConference;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAddConferenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_conference_edit');
    }

    public function rules()
    {
        return [
            'topic_name' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
            'location' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
            'conference_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'contribution_of_conference' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
            'project_name' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
        ];
    }
}
