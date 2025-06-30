<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjoutLocaModel extends Model
{
    use HasFactory;
    protected $table = 'AjoutLocaData';
    protected $fillable = [
        'nom',
        'prenoms',
        'matricule',
        'fonction',
        'statut',
        'numApp',
        'photo',
        'photo_cni',
        'sexe',
        'dateNaissance',
        'dateEntree',
        'dateSortie',
        'email',
        'phone',
        'adresse',
        'ville',
        'montantLoyer'
    ];

    
}
