<?php

namespace App\Http\Requests;

use App\Models\ToolssyllabusYear;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreToolssyllabusYearRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('toolssyllabus_year_create');
    }

    public function rules()
    {
        return [
            'year' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
