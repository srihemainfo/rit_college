<?php

namespace App\Http\Requests;

use App\Models\Patent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePatentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patent_create');
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
