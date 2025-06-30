<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjoutLocaRequest;
use Illuminate\Http\Request;
use App\Models\AjoutLocaModel; // Assuming you have a model for storing locataire data

class AjoutLocaController extends Controller
{
    public function vue()
    {
        $locataires = AjoutLocaModel::all(); 

        
        return view('AjoutLoca', compact('locataires'));
    }
    /**
     * Store a new locataire in the database.
     *
     * @param AjoutLocaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function storeAgentLoca(AjoutLocaRequest $request)
    {
        // La validation est gérée automatiquement par AjoutLocaRequest.
        // Si la validation échoue, Laravel redirige automatiquement avec les erreurs.
        // Si elle réussit, $request->validated() contient toutes les données propres.
        $locataires = $request->validated();

        // Gérer le téléchargement de la photo du locataire
        if ($request->hasFile('photo')) {
            // Stocke le fichier et met à jour le tableau $data avec le chemin du fichier
            $locataires['photo'] = $request->file('photo')->store('photos_locataires', 'public');
            // 'photos_locataires' est le sous-dossier dans 'storage/app/public'
        } else {
            // Optionnel : attribuer une photo par défaut si aucune n'est téléchargée
            // Assurez-vous que ce chemin existe dans votre dossier 'public/images/'
            $locataires['photo'] = 'images/default-locataire-photo.png';
        }

        // Gérer le téléchargement de la photo CNI du locataire
        if ($request->hasFile('photo_cni')) {
            // Stocke le fichier et met à jour le tableau $data avec le chemin du fichier
            $locataires['photo_cni'] = $request->file('photo_cni')->store('photos_cni_locataires', 'public');
            // 'photos_cni_locataires' est le sous-dossier dans 'storage/app/public'
        } else {
            // Optionnel : attribuer une photo CNI par défaut si aucune n'est téléchargée
            // Assurez-vous que ce chemin existe dans votre dossier 'public/images/'
            $locataires['photo_cni'] = 'images/default-locataire-cni.png';
        }

        // Créer une nouvelle instance du modèle AjoutLocaModel avec les données validées
        // et les chemins des fichiers téléchargés.
        AjoutLocaModel::create($locataires);

        // Rediriger vers la page des locataires avec un message de succès
        return redirect()->route('AjoutLoca')->with('success', 'Locataire ajouté avec succès !');
    }


    public function show(string $id){
        $agent = AjoutLocaRequest::find($id);
        return view('AjouteAgent.show', compact(''));                                                                                                                                                                                                                                                                                                                                                                                                                                              
    }
}
