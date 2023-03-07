<?php

namespace App\Http\Requests;

use App\Models\Patent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patent_edit');
    }

    public function rules()
    {
        return [
            'topic' => [
                'string',
                'nullable',
            ],
            'remark' => [
                'string',
                'nullable',
            ],
        ];
    }
}
