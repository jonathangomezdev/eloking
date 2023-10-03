<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveHelpDeskFaqRequest extends FormRequest
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
            'question'    => 'required',
            'answer'      => 'required',
            'categories'  => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'question.required'  => 'Question is required.',
            'answer.required'    => 'Answer is required.',
            'categories.required'=> 'Please check atleast one category.',
        ];
    }
}
