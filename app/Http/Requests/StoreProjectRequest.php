<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|min:2|max:255",
            "description" => "required|string",
            "github_link" => "string|url",
            "cover_img" => "required|image|max:1024"
        ];
    }

    public function messages() {
        return [
            "name.required" => "Il titolo è obbligatorio",
            "name.max" =>  "Il titolo deve avere massimo :max caratteri",
            "cover_img.required" =>  "Inscerisci il file dell'immagine, è obbligatorio",
            "description.required" => "Il contenuto del post è obbligatorio",
        ];
    }
}

