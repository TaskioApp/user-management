<?php

namespace Taskio\UserManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Taskio\UserManagement\Models\User;

class UserManagementStoreRequest extends FormRequest
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
            'username' => ['bail', 'required', 'string', 'max:50', Rule::unique(User::class, 'username')],
            'email' => ['bail', 'nullable', 'email', 'max:100', Rule::unique(User::class, 'email')],
            'mobile' => ['bail', 'nullable', 'string', 'max:20', Rule::unique(User::class, 'mobile')],
            'password' => ['required', 'confirmed', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'avatar' => ['nullable', 'file']
        ];
    }
}
