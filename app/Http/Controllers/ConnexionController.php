<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnexionController extends Controller

{

    public function vue(){
        return view('Connexion');
    }
    public function login(Request $request)
    {
        // 1. Validation des données entrées
        $login = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:3',
            ],
            [
                'email.required' => 'L\'email est requis.',
                'email.email' => 'L\'email doit être valide.',
                'password.required' => 'Le mot de passe est requis.',
                'password.min' => 'Le mot de passe doit comporter au moins 3 caractères.',
            ]
        );


        // 2. Tentative d'authentification
        if (auth()->attempt($login)) {

            // 3. Connexion réussie → redirection vers une page définie (ici 'dashboard')
            return redirect()->route('vueSupport')->with('success', 'Connexion réussie !');
        }

        // 4. Connexion échouée → retour au formulaire avec erreur
        return redirect()->back()->withErrors(['email' => 'Identifiants incorrects.'])->withInput();
    }

   
}
