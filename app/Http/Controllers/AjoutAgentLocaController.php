<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjoutAgentLocaRequest;
use App\Models\AjoutAgentLocaModel;
use Illuminate\Http\Request;

class AjoutAgentLocaController extends Controller
{
    public function vue()
    {
        $agentLoca = AjoutAgentLocaModel::all();
        return view('AjoutAgentLocas', compact('agentLocas'));
    }

    public function store(AjoutAgentLocaRequest $request){

        $agentLoca = $request->validated();

        if ($request->hasFile('photo')) {
            $agentLoca['photo'] = $request->file('photo')->store('photos_agents', 'public');
        } else {
            $agentLoca['photo'] = 'images/default-user-blue.png'; // Assurez-vous que ce fichier existe dans /public/images
        }

        //  Gérer la photo de la CNI
        if ($request->hasFile('cni')) {
            $agentLoca['cni'] = $request->file('cni')->store('cni_agents', 'public');
        } else {
            $agentLoca['cni'] = 'images/default-user-blue.png'; // Vérifiez que ce fichier est dans /public/images
        }

        //  Enregistrement de l'agent en base de données
        AjoutAgentLocaModel::create($agentLoca);

        //  Redirection avec message de succès
        return redirect()->route('vueAjoutAgentLoca')->with('success', 'Agent ajouté avec succès !');
    }
        
    }

