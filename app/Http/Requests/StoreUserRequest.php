<?php

namespace App\Http\Requests;

use Gate;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tenant_id'             => ['integer'],
            'name'                  => ['required'],
            'email'                 => ['required', 'unique:users'],
            'password'              => ['required', 'confirmed', 'min:6', $this->passwordRules()],
            'password_confirmation' => ['required'],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];
    }
}
