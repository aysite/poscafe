<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "name" => "required|max:50",
            "password" => "required|min:6",
            "email" => "required|email|unique:users",
            "foto" => "mimes:jpg,jpeg,png|max:1024",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Must be filled in !",
            "name.max" => "Max 50 Charactes !",
            "password.required" => "Must be filled in !",
            "password.min" => "Min 6 characters !",
            "email.required" => "Must be filled in !",
            "email.email" => "Email Not Valid !",
            "email.unique" => "Already Used !",
            "foto.mimes" => "Must be JPG, JPEG, or PNG format !",
            "foto.max" => "Max 1 Mb !"
        ];
    }
}