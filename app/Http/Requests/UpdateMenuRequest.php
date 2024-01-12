<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            "kd_menu" => "required|max:15|unique:menus,kd_menu,".$this->menu->id,
            "nm_menu" => "required|max:50",
            "id_cat_menu" => "required",
            "id_kitchen_menu" => "required",
            "harga_menu" => "required|numeric",
            "satuan_menu" => "required|max:20",
            "stok_menu" => "required",
            "file_foto" => "mimes:jpg,jpeg,png|max:1024"
        ];
    }

    public function messages(): array
    {
        return [
            "kd_menu.required" => "Menu code must be filled in",
            "kd_menu.unique" => "Menu code already used",
            "kd_menu.max" => "Max 5 characters",
            "nm_menu.required" => "Menu name must be filled in",
            "nm_menu.max" => "Max 50 characters",
            "harga_menu.max" => "Must be filled in",
            "harga_menu.numeric" => "Number Only", 
            "satuan_menu.required" => "Must be filled in",
            "satuan_menu.max" => "Max 20 characters",
            "stok_menu.required" => "Must be filled in",
            "id_cat_menu.required" => "Must be filled in",
            "id_kitchen_menu.required" => "Must be filled in",
            "file_foto.mimes" => "Only use jpg , jpeg , or png format",
            "file_foto.max" => "Max size is 1 Mb",
        ];
    }
}
