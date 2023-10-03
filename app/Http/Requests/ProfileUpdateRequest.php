<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class ProfileUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'username' => ['nullable', Rule::unique('users')->ignore(auth()->id())],
            'password' => 'nullable|min:8',
            'company_name' => 'nullable',
            'vat_rate' => 'nullable',
            'vat_number' => [new RequiredIf(request()->vat_rate > 0)],
            'street' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'postcode' => 'nullable',
        ];
    }
}
