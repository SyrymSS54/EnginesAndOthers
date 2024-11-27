<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdate extends FormRequest
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
            "_id" => 'required|string',
            "name" => 'required|string',
            "text" => 'required|string',
            'preview' => 'required|image',
            'photos.*' => 'image',
            'index' => 'required|string',
            'tags.*' => 'required|string',
            'info.seller.name' => 'required|string',
            'info.seller.id' => 'required|integer',
            'info.price' => 'required|integer',
            'info.sale' => "required|integer",
            'info.count' => 'required|integer',
            'info.status_sale' => 'required|boolean'
        ];
    }
}
