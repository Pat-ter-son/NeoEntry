<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutLocaRequest extends FormRequest
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
            
            'statut' => 'required|string|max:50',
            'numApp' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'photo_cni' => 'nullable|image|max:2048',
            'sexe' => 'required|string|max:20',
            'dateNaissance' => 'required|date',
            'dateEntree' => 'required|date',
            'dateSortie' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'ville' => 'nullable|string|max:100',
            'montantLoyer' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenoms.required' => 'Les prénoms sont obligatoires.',
            'matricule.required' => 'Le matricule est obligatoire.',
            'fonction.required' => 'La fonction est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
            'numApp.required' => 'Le numéro d\'appartement est obligatoire.',
            'photo.image' => 'La photo doit être une image valide.',
            'photo_cni.image' => 'La photo de la CNI doit être une image valide.',
            'sexe.required' => 'Le sexe est obligatoire.',
            'dateNaissance.required' => 'La date de naissance est obligatoire.',
            'dateEntree.required' => 'La date d\'entrée est obligatoire.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'montantLoyer.required' => 'Le montant du loyer est obligatoire.',
        ];
    }
}
