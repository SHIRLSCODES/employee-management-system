<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLeaveRequest extends FormRequest
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
            'leave_type' => 'required|in:sick,vacation,personal',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'number_of_days' => 'required|integer|min:1|max:5',
            'reason' => 'required|string|min:5',
        ];
    }
    public function messages(): array
    {
        return [
            'leave_type.in' => 'The selected leave type is invalid.',
            'start_date.after_or_equal' => 'Start date cannot be before today.',
            'end_date.after_or_equal' => 'End date must be after or equal to the start date.',
        ];
    }
}
