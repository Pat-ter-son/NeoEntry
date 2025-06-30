<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjoutVisiteur;
use App\Models\AjoutVisiteurModel; // Assuming this is your model for visitors
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Added for file storage
 // Assuming this is your model for visitors

class AjoutVisiteurController extends Controller
{
    public function vue()
    {
        // Récupère tous les visiteurs pour les afficher dans la table
        $visiteur = AjoutVisiteurModel::all();
        return view('AjoutVisiteur', compact('visiteur')); // 'votre_vue' doit être le nom de votre fichier blade
    }


    public function storeVisiteur(AjoutVisiteur $request)
    {
        // Les données sont déjà validées par AjoutVisiteur $request.
        // On récupère les données validées en utilisant $request->validated().
        $validatedData = $request->validated();

        // Initialisation des chemins de fichiers à null par défaut
        $photoPiecePath = null;
        $photoVisiteurPath = null;

        // Gère le téléchargement et le stockage de la photo de la pièce d'identité
        if ($request->hasFile('photo_piece')) {
            // Stocke le fichier dans le dossier 'photos_pieces' à l'intérieur du disque 'public'
            $photoPiecePath = $request->file('photo_piece')->store('photos_pieces', 'public');
        }

        // Gère le téléchargement et le stockage de la photo du visiteur
        if ($request->hasFile('photo_visiteur')) {
            // Stocke le fichier dans le dossier 'photos_visiteurs' à l'intérieur du disque 'public'
            $photoVisiteurPath = $request->file('photo_visiteur')->store('photos_visiteurs', 'public');
        }

        // Crée un nouvel enregistrement de visiteur dans la base de données.
        // On fusionne les données validées avec les chemins des photos.
        AjoutVisiteurModel::create(array_merge(
            $validatedData,
            [
                'photo_piece' => $photoPiecePath,
                'photo_visiteur' => $photoVisiteurPath,
            ]
        ));

        // Redirige l'utilisateur vers la page de vue avec un message de succès
        return redirect()->route('vueAjoutVisiteur')->with('success', 'Visiteur ajouté avec succès !');
    }
    
}
