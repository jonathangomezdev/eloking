<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class UserUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users')->ignore(request()->user_id)],
            'username' => ['nullable', Rule::unique('users')->ignore(request()->user_id)],
            'password' => 'nullable|min:8',
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
            'allow_notifications_in_discord' => 'nullable',
            'discord' => 'nullable',
            'max_allowed_platforms' => 'required|numeric',
            'max_allowed_pickups' => 'required|numeric'
        ];
    }
}
