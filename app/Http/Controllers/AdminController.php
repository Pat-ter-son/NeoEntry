<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function vue()
   {
      return view('Admin');
   }

   public function login(AdminRequest $request){
      $login = $request->validated();

      if (auth()->attempt($login)) {

         // 3. Connexion réussie → redirection vers une page définie (ici 'dashboard')
         return redirect()->route('vueSupport')->with('success', 'Connexion réussie !');
      }

      // 4. Connexion échouée → retour au formulaire avec erreur
      return redirect()->back()->withErrors(['email' => 'Identifiants incorrects.'])->withInput();
   }
}

