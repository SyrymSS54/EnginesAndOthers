<?php

namespace App\Http\Requests\Customer\Auth;

use Illuminate\Foundation\Http\FormRequest;

class signup extends FormRequest
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
            "last_name" => 'required|string',
            "first_name" => 'required|string',
            "tel" => 'required|string',
            'birth' => 'required|date',
            "email" => 'required|max:32|email',
            "password" => 'required|max:32'
        ];
    }
}
