<?php

namespace App\Http\Requests\master;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:teams',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'name.string' => 'The Name field must be a string.',
            'name.max' => 'The Name field may not be greater than :max characters.',
            'name.unique' => 'This Group Name is already exists',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string.',
            'description.max' => 'The description field may not be greater than :max characters.',
        ];
    }
}
