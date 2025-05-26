<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEmployeeRequest extends FormRequest
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
            'employee_no' => 'required|string|max:10|unique:employees,employee_no',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:20',
            'nin' => 'required|string|max:20|unique:employees,nin',
            'email' => 'required|email|max:255|unique:employees,email',
            'phone_number' => 'required|string|max:20',
            'date_of_birth' => 'required|date|before:today',
            'address' => 'required|string|max:1000',
            'gender' => 'required|string|max:10',
           'department' => 'required|string|max:20',
            'designation' => 'required|string|max:20',
            'status' => 'required|string|max:20',
        ];
    }
}
