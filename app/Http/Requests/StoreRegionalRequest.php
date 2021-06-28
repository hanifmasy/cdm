<?php

namespace App\Http\Requests;

use App\Models\Regional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRegionalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('regional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nama_regional' => [
                'string',
                'min:10',
                'max:30',
                'required',
                'unique:regionals',
            ],
        ];
    }
}
