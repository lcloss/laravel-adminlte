<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('role_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => ['required', 'unique:roles'],
            'name' => [
                'string',
                'required',
            ],
            'permissions.*' => [
                'integer',
                'nullable',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
        ];
    }
}
