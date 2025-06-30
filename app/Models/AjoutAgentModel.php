<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjoutAgentModel extends Model
{
    use HasFactory;

    protected $table = 'AjoutAgentData';

    protected $fillable = [
        'nom',
        'prenoms',
        'matricule',
        'fonction',
        'departement',
        'statut',
        'numApp',
        'photo',
        'sexe',
        'dateNaissance',
        'dateEntree',
        'cni',
        'email',
        'phone',
        'adresse',
        'ville',
    ];
}
