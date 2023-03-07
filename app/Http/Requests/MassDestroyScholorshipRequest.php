<?php

namespace App\Http\Requests;

use App\Models\Scholorship;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyScholorshipRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scholorship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:scholorships,id',
        ];
    }
}
