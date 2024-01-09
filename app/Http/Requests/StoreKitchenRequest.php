<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKitchenRequest extends FormRequest
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
            "nm_kitchen" => "required|unique:kitchen|max:20"
        ];
    }

    public function messages(): array
    {
        return [
            "nm_kitchen.required" => "Kitchen name must be filled in",
            "nm_kitchen.unique" => "Kitchen name is already use",
            "nm_kitchen.max" => "Max 20 characters",
        ];
    }
}
