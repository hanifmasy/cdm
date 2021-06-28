<?php

namespace App\Http\Requests;

use App\Models\Witel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWitelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('witel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'unique:witels',
            ],
            'regional_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
