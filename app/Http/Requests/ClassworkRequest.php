<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassworkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
             'title' => 'required | max: 255',
            'description' => 'nullable| max: 255',
            'topic_id' => ['required ',' exists:topics,id'],
            'type' => 'required','in:[assignment,material,question]',
        ];
    }
    public function messages()
    {
        return [
            'required' => ' Sorry! :attribute Cannot be empty',
        ];
    }
}
