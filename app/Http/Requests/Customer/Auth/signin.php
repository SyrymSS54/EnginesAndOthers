<?php

namespace App\Http\Requests\Customer\Auth;

use Illuminate\Foundation\Http\FormRequest;

class signin extends FormRequest
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
            "email" => 'required|max:32|email',
            "password" => 'required|max:32'
        ];
    }
}
