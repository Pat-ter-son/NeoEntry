<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AjoutAgentModel;
use App\Models\AjoutLocaModel;
use App\Models\AjoutVisiteurModel;



class DashboardController extends Controller
{
    public function vueDashboard()
    {
        return $this->index(); // Utilise la même logique que index()
    }

    public function index()
    {
        return view('dashboard', [
            'totalAgents' => AjoutAgentModel::count(),
            'totalLocataires' => AjoutLocaModel::count(),
            'totalVisiteurs' => AjoutVisiteurModel::count(),
            'agents' => AjoutAgentModel::latest()->take(5)->get(),
            'locataires' => AjoutLocaModel::latest()->take(5)->get(),
            'visiteurs' => AjoutVisiteurModel::latest()->take(5)->get(),
        ]);
    }
}
