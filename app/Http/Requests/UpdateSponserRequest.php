<?php

namespace App\Http\Requests;

use App\Models\Sponser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSponserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sponser_edit');
    }

    public function rules()
    {
        return [
            'sponser_type' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
            'sponser_name' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
            'sponsered_items' => [
                'string',
                'min:1',
                'max:1000',
                'nullable',
            ],
            'sponsered_to' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
        ];
    }
}
