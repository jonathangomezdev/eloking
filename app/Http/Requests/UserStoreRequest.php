<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'nullable|unique:users,username',
            'password' => 'required|min:8',
            'roles' => 'nullable|array',
            'active' => 'required',
            'company_name' => 'nullable',
            'street' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'postcode' => 'nullable',
            'vat_rate' => 'nullable',
            'vat_number' => [new RequiredIf(request()->vat_rate > 0)],
            'allow_notification_sound' => 'nullable',
            'discord' => 'nullable',
        ];
    }
}
