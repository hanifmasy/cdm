<?php

namespace App\Http\Requests;

use App\Models\Witel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWitelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('witel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nama_witel'  => [
                'string',
                'min:3',
                'max:50',
                'required',
                'unique:witels,nama_witel,' . request()->route('witel')->id,
            ],
            'regional_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
