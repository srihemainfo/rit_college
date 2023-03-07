<?php

namespace App\Http\Requests;

use App\Models\Scholorship;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateScholorshipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('scholorship_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
