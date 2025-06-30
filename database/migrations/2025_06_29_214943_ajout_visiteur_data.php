<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Le nom de la table est bien 'visiteurs', c'est déjà une bonne chose !
        Schema::create('visiteurs', function (Blueprint $table) {
            $table->id();

            // Informations personnelles
            // 'required()' a été remplacé par l'absence de 'nullable()',
            // ou 'nullable(false)' si vous voulez être explicite.
            $table->string('nom', 100);
            $table->string('prenom', 100); // **CORRIGÉ : de 'prenoms' pour correspondre au modèle et au formulaire**
            $table->enum('sexe', ['F', 'M']);
            $table->date('date_naissance'); // **CORRIGÉ : de 'dateNaissance'**
            $table->string('profession', 150)->nullable(); // Le formulaire le rend optionnel
            $table->string('telephone', 30);
            $table->string('email', 150)->nullable();

            // Informations administratives
            $table->enum('type_piece', ['CNI', 'Passeport', 'Permis']);
            $table->string('numero_piece', 100);
            $table->string('photo_piece')->nullable();
            $table->string('photo_visiteur')->nullable();

            // Détails de la visite
            $table->date('date_visite'); // **CORRIGÉ : de 'dateVisite'**
            $table->time('heure_arrivee'); // **CORRIGÉ : de 'heureArrivee'**
            $table->time('heure_depart')->nullable(); // **CORRIGÉ : de 'heureDepart'**
            $table->string('motif', 255)->nullable();
            $table->string('objets', 255)->nullable(); // **AJOUTÉ : Manquant précédemment mais dans le formulaire/modèle**

            // Locataire visité
            $table->string('locataire_nom', 150)->nullable(); // **CORRIGÉ : de 'locataireNom'**
            $table->string('numero_appartement', 50)->nullable(); // **CORRIGÉ : de 'numeroAppartement'**
            $table->string('etage_bloc', 50)->nullable(); // **CORRIGÉ : de 'etageBloc'**
            $table->string('relation', 255)->nullable();

            // Sécurité
            $table->enum('badge', ['Oui', 'Non'])->nullable();
            $table->string('numero_badge', 50)->nullable(); // **CORRIGÉ : de 'numeroBadge'**
            // Note: 'Vérifiée par téléphone' et 'Vérifiée par email' sont dans le HTML mais pas dans la migration.
            // Il faut ajouter 'Vérifiée par email' si vous souhaitez qu'il soit une option.
            $table->enum('autorisation', ['Oui', 'Non', 'Vérifiée par téléphone', 'Vérifiée par email'])->nullable();
            $table->string('agent_enregistreur', 150)->nullable(); // **CORRIGÉ : de 'agentEnregistreur'**
            $table->string('signature', 255)->nullable(); // **AJOUTÉ : Manquant précédemment mais dans le formulaire**

            // timestamps Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiteurs'); // Ajoutez cette ligne pour pouvoir faire un rollback propre
    }
};
