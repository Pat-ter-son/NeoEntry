<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutAgentLocaRequest extends FormRequest
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
            
            'nom' => 'required|max:255',
            'prenoms' => 'required|max:255',
            'matricule' => 'required|max:255',
            'fonction' => 'required',
            'adresse' => 'required|max:255',
            'departement' => 'required|max:255',
            'dateEntree' => 'required',
            'montantLoyer' => 'required',
            'statutLoc' => 'required',
            'statutAgent' => 'required',
            'numApp' => 'required',
            'photo' => 'required',
            'cni' => 'required',
        ];
    }

    public function messages(){
        return [
            
            'nom' => 'Veuillez entrer le nom',
            'prenoms' => 'Veuillez entrer prenoms',
            'matricule' => 'Veuillez entrer matricule',
            'fonction' => 'Veuillez entrer la fonction',
            'adresse' => 'Veuillez entrer l\'adresse',
            'departement' => 'Veuillez entrer le departement',
            'dateEntree' => 'Veuillez entrer la date',
            'montantLoyer' => 'Veuillez entrer le montant du loyer',
            'statutLocataire' => 'Veuillez entrer le statut',
            'statutAgent' => 'Veuillez entrer le statut de l\'agent',
            'photo' => 'Veuillez entrer une photo',
            'cni' => 'Veuillez entrer une photo de la cni',
            'numApp' => 'Veuillez entrer le numéro de l\'appartement',
        ];
    }
}
