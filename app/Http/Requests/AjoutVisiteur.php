<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutVisiteur extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autorise toutes les requêtes pour ce formulaire
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'sexe' => 'required|in:F,M',
            'date_naissance' => 'required|date',
            'profession' => 'nullable|string|max:150',
            'telephone' => 'required|string|max:30',
            'email' => 'nullable|email|max:150',
            'type_piece' => 'required|in:CNI,Passeport,Permis',
            'numero_piece' => 'required|string|max:100',
            'photo_piece' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_visiteur' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_visite' => 'required|date',
            'heure_arrivee' => 'required|date_format:H:i',
            'heure_depart' => 'nullable|date_format:H:i',
            'motif' => 'nullable|string|max:255',
            'objets' => 'nullable|string|max:255', // Nouveau champ
            'locataire_nom' => 'nullable|string|max:150',
            'numero_appartement' => 'nullable|string|max:50',
            'etage_bloc' => 'nullable|string|max:50',
            'relation' => 'nullable|string|max:255',
            'badge' => 'nullable|in:Oui,Non',
            'numero_badge' => 'nullable|string|max:50',
            'autorisation' => 'nullable|in:Oui,Non,Vérifiée par téléphone,Vérifiée par email',
            'agent_enregistreur' => 'nullable|string|max:150',
            'signature' => 'nullable|string|max:255', // Nouveau champ
            
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'Le champ Nom est obligatoire.',
            'prenom.required' => 'Le champ Prénom est obligatoire.',
            'sexe.required' => 'Le champ Sexe est obligatoire.',
            'sexe.in' => 'Le Sexe doit être F ou M.',
            'date_naissance.required' => 'La date de naissance est obligatoire.',
            'date_naissance.date' => 'La date de naissance doit être une date valide.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
            'type_piece.required' => 'Le type de pièce est obligatoire.', // Si vous le mettez required dans le form
            'numero_piece.required' => 'Le numéro de pièce est obligatoire.',
            'photo_piece.image' => 'Le fichier de la pièce d\'identité doit être une image.',
            'photo_piece.mimes' => 'Le format de l\'image de la pièce d\'identité doit être jpeg, png, jpg, gif ou svg.',
            'photo_visiteur.image' => 'Le fichier de la photo du visiteur doit être une image.',
            'photo_visiteur.mimes' => 'Le format de la photo du visiteur doit être jpeg, png, jpg, gif ou svg.',
            'date_visite.required' => 'La date de visite est obligatoire.',
            'heure_arrivee.required' => 'L\'heure d\'arrivée est obligatoire.',
            'heure_arrivee.date_format' => 'L\'heure d\'arrivée doit être au format HH:MM.',
            'heure_depart.date_format' => 'L\'heure de départ doit être au format HH:MM.',
            // Ajoutez d'autres messages personnalisés si nécessaire
        ];
    }

}
