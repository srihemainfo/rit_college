<?php

namespace App\Http\Requests;

use App\Models\Sttp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSttpRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sttp_edit');
    }

    public function rules()
    {
        return [
            'topic' => [
                'string',
                'nullable',
            ],
            'remarks' => [
                'string',
                'nullable',
            ],
            'from' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'to' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
