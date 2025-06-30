<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjoutVisiteurModel extends Model
{
    use HasFactory;

    // 1. **Correction cruciale :** Indique explicitement le nom de la table.
    // Votre migration crée la table 'visiteurs', donc le modèle doit le savoir.
    protected $table = 'visiteurs';

    // Par défaut, Eloquent attend une clé primaire auto-incrémentée nommée 'id'.
    // Si votre clé primaire a un nom différent, vous devriez la spécifier :
    // protected $primaryKey = 'mon_id';

    // Par défaut, Eloquent suppose que les colonnes 'created_at' et 'updated_at' existent.
    // Puisque votre migration les a, pas besoin de spécifier `$timestamps = true;`

    protected $fillable = [
        'nom',
        'prenom', // Corrigé de 'prenoms' pour correspondre à la migration
        'sexe',
        'date_naissance', // Corrigé de 'dateNaissance'
        'profession',
        'telephone',
        'email',
        'type_piece',
        'numero_piece',
        'photo_piece',
        'photo_visiteur',
        'date_visite', // Corrigé de 'dateVisite'
        'heure_arrivee', // Corrigé de 'heureArrivee'
        'heure_depart', // Corrigé de 'heureDepart'
        'motif',
        'objets', // Manquant dans votre migration d'origine, mais présent dans le formulaire. Ajouté ici.
        'locataire_nom', // Corrigé de 'locataireNom'
        'numero_appartement', // Corrigé de 'numeroAppartement'
        'etage_bloc', // Corrigé de 'etageBloc'
        'relation',
        'badge',
        'numero_badge', // Corrigé de 'numeroBadge'
        'autorisation',
        'agent_enregistreur', // Corrigé de 'agentEnregistreur'
        'signature', // Présent dans le formulaire HTML, mais manquant dans la migration et le fillable. Ajouté ici.
        // Les champs 'matricule', 'fonction', 'departement', 'statut', 'numApp',
        // 'dateEntree', 'adresse', 'ville' n'existent pas dans votre migration 'visiteurs'
        // et sont donc supprimés du $fillable.
    ];

    // Pour les casts, utilisez le type de colonne de la base de données quand il s'agit d'une simple date/heure.
    // 'datetime:H:i' est pour formater la sortie, pas le type de colonne.
    protected $casts = [
        'date_naissance' => 'date', // Corrigé
        // 'dateEntree' => 'date', // Supprimé car la colonne n'existe pas dans la migration
        'date_visite' => 'date', // Corrigé
        'heure_arrivee' => 'datetime', // 'datetime' est suffisant pour des colonnes TIME ou DATETIME.
        'heure_depart' => 'datetime', // Corrigé
    ];
}
