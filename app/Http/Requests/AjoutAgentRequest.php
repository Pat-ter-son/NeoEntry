<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutAgentRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'matricule' => 'required|string|max:100',
            'fonction' => 'required|string|max:100',
            'departement' => 'required|string|max:100',
            'statut' => 'required|string|max:50',
            'numApp' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'photo_cni' => 'nullable|image|max:2048', 
            'sexe' => 'required|string|max:20',
            'dateNaissance' => 'required|date',
            'dateEntree' => 'required|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'ville' => 'nullable|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est requis.',
            'prenoms.required' => 'Les prénoms sont requis.',
            'matricule.required' => 'Le matricule est requis.',
            'fonction.required' => 'La fonction est requise.',
            'departement.required' => 'Le département est requis.',
            'statut.required' => 'Le statut est requis.',
            'numApp.required' => 'Le numéro d\'appartement est requis.',
            'photo.image' => 'La photo doit être une image.',
            'photo.max' => 'La photo ne doit pas dépasser 2 Mo.',
            'sexe.required' => 'Le sexe est requis.',
            'dateNaissance.required' => 'La date de naissance est requise.',
            'dateEntree.required' => 'La date d\'entrée est requise.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'phone.required' => 'Le téléphone est requis.',
            'adresse.required' => 'L\'adresse est requise.',
        ];
    }
}
