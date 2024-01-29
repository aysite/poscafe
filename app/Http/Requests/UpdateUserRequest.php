<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "email" => "required|email|unique:users,email,".$this->user->id,
            "file_foto" => "mimes:jpg,jpeg,png|max:1024",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Must be filled in !",
            "name.max" => "Max 50 Charactes !",
            "email.required" => "Must be filled in !",
            "email.email" => "Email Not Valid !",
            "email.unique" => "Already Used !",
            "file_foto.mimes" => "Must be JPG, JPEG, or PNG format !",
            "file_foto.max" => "Max 1 Mb !"
        ];
    }
}
