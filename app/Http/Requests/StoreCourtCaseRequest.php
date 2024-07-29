<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourtCaseRequest extends FormRequest
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
            'case_no' => 'required|string|max:255|unique:court_cases',
            'case_file_no' => 'required|string|max:255|unique:court_cases',
            'title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'started_date' => 'required|date',
            'closed_date' => 'nullable|date',  // Added date validation for closed_date
            'court_id' => 'required|integer|exists:courts,id',
            'case_categories' => 'required|array',
            'case_categories.*' => 'integer|exists:case_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'case_no.required' => 'The Case No field is required.',
            'case_no.string' => 'The Case No field must be a string.',
            'case_no.max' => 'The Case No field may not be greater than :max characters.',
            'case_no.unique' => 'This Case No already exists.',

            'case_file_no.required' => 'The Case File No field is required.',
            'case_file_no.string' => 'The Case File No field must be a string.',
            'case_file_no.max' => 'The Case File No field may not be greater than :max characters.',
            'case_file_no.unique' => 'This Case File No already exists.',

            'title.required' => 'The Title field is required.',
            'title.string' => 'The Title field must be a string.',
            'title.max' => 'The Title field may not be greater than :max characters.',

            'client_name.required' => 'The Client Name field is required.',
            'client_name.string' => 'The Client Name field must be a string.',
            'client_name.max' => 'The Client Name field may not be greater than :max characters.',

            'started_date.required' => 'The Started Date field is required.',
            'started_date.date' => 'The Started Date field must be a valid date.',

            //'closed_date.date' => 'The Closed Date field must be a valid date.',  // Added message for closed_date

            'court_id.required' => 'The Court field is required.',
            'court_id.integer' => 'The Court field must be an integer.',
            'court_id.exists' => 'The selected court must exist in the courts table.',

            'case_categories.required' => 'The Case Categories field is required.',
            'case_categories.array' => 'The Case Categories field must be an array.',
            'case_categories.*.integer' => 'Each selected case category must be a valid integer.',
            'case_categories.*.exists' => 'Each selected case category must exist in the court case categories table.',
        ];
    }

}
