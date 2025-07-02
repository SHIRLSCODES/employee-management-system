<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePermissionRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:3',
                'regex:/^[a-zA-Z\-_ ]+$/',     // allows only letters, dashes, underscores, spaces
                'not_regex:/^\d+$/',           // blocks numbers-only
                'unique:permissions,name',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The permission name is required.',
            'name.string' => 'The permission name must be a valid string.',
            'name.unique' => 'This permission already exists.',
            'name.regex' => 'The permission name may only contain letters, dashes, underscores, and spaces',
            'name.not_regex' => 'The permission name cannot be only numbers.',
            'name.min' => 'The permission name must be at least :min characters.',
        ];
    }
}
