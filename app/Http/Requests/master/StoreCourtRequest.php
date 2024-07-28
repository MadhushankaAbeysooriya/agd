<?php

namespace App\Http\Requests\master;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourtRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:courts',
            'court_categories' => 'required|array',
            'court_categories.*' => 'integer|exists:court_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'name.string' => 'The Name field must be a string.',
            'name.max' => 'The Name field may not be greater than :max characters.',
            'name.unique' => 'This Name already exists.',
            'court_categories.required' => 'The Court Category field is required.',
            'court_categories.array' => 'The Court Category field must be an array.',
            'court_categories.*.integer' => 'Each selected court category must be a valid integer.',
            'court_categories.*.exists' => 'Each selected court category must exist in the court categories table.',
        ];
    }
}
