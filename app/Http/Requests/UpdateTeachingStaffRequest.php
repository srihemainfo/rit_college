<?php

namespace App\Http\Requests;

use App\Models\TeachingStaff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTeachingStaffRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('teaching_staff_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:1',
                'max:191',
                'nullable',
            ],
        ];
    }
}
