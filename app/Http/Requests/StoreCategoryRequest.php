<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            "nm_category" => "required|unique:categories|max:20"
        ];
    }

    public function messages(): array
    {
        return [
            "nm_category.required" => "Category name must be filled in",
            "nm_category.unique" => "Category name is already use",
            "nm_category.max" => "Max 20 characters",
        ];
    }
}
