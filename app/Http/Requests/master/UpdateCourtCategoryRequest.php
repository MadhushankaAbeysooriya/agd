<?php

namespace App\Http\Requests\master;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourtCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:court_categories,name,'.$this->court_category->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'name.string' => 'The Name field must be a string.',
            'name.max' => 'The Name field may not be greater than :max characters.',
            'name.unique' => 'This Name is already exists',
        ];
    }
}
