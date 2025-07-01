<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjoutAgentLocaModel extends Model
{
    use HasFactory;

    protected $table = '$AjoutAgentLocaData';

    protected $fillable = [
        'id',
        'nom',
        'prenoms',
        'matricule',
        'adresse',
        'departement',
        'dateEntree',
        'montantLoyer',
        'statut',
        'photo',
        'cni',
    ];
}
