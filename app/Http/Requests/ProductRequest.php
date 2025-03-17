<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>  ['required', 'min:5', 'max:100'],
            'reference' => ['required', Rule::unique('products')->ignore($this->product), 'max:5'],
            'value' =>  ['required', 'integer','min:3'],
            'user_id' => ['required', 'integer','min:1']
        ];
    }
}
