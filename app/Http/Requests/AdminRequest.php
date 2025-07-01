<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'nom' => 'required|String|max:255',
            'email' => 'required|String|max:255',
            'password' => 'required|String|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Veuillez entrer le nom',
            'email.required' => 'Veuillez entrer l\'email',
            'password.required' => 'Veuillez entrez le mot de passe',
        ];
    }
}
