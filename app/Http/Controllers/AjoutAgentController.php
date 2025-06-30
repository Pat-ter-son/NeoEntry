<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjoutAgentRequest;
use Illuminate\Http\Request;
use App\Models\AjoutAgent; // Assuming you have a Post model for storing agent data
use App\Models\AjoutAgentModel;
use App\Models\Post; // Assuming you have a Post model for storing agent data



class AjoutAgentController extends Controller
{
    public function vue()
    {
        $agents = AjoutAgentModel::all(); // Retrieve all agents from the database
        return view('AjoutAgent', compact('agents'));
    }




    public function storeAgent(AjoutAgentRequest $request)
    {
        // Récupère les données validées
        $agent = $request->validated();

        //  Gérer la photo de l'agent
        if ($request->hasFile('photo')) {
            $agent['photo'] = $request->file('photo')->store('photos_agents', 'public');
        } else {
            $agent['photo'] = 'images/default-user-blue.png'; // Assurez-vous que ce fichier existe dans /public/images
        }

        //  Gérer la photo de la CNI
        if ($request->hasFile('photo_cni')) {
            $agent['photo_cni'] = $request->file('photo_cni')->store('photos_cni_agents', 'public');
        } else {
            $agent['photo_cni'] = 'images/default-cni-blue.png'; // Vérifiez que ce fichier est dans /public/images
        }

        //  Enregistrement de l'agent en base de données
        AjoutAgentModel::create($agent);

        //  Redirection avec message de succès
        return redirect()->route('vueAjoutAgent')->with('success', 'Agent ajouté avec succès !');
    }

   public function edit(AjoutAgentRequest $agent ){
        return view('edit', [
            '$AjoutAgentRequest' => $agent
        ]);
   }

   public function update(AjoutAgentRequest $agent){
    '$AjoutAgentRequest' -> update($request->validated());
    return redirect()->route('vueAjoutAgent')->with('success', 'Agent ajouté avec succès !');
    
   }
}
