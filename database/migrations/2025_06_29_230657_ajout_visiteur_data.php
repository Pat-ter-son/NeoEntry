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
        Schema::create('visiteurs', function (Blueprint $table) {
            $table->id();

            // Informations personnelles
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->enum('sexe', ['F', 'M']);
            $table->date('date_naissance');
            $table->string('profession', 150)->nullable();
            $table->string('telephone', 30);
            $table->string('email', 150)->nullable();

            // Informations administratives
            $table->enum('type_piece', ['CNI', 'Passeport', 'Permis']);
            $table->string('numero_piece', 100);
            $table->string('photo_piece')->nullable();
            $table->string('photo_visiteur')->nullable();

            // Détails de la visite
            $table->date('date_visite');
            $table->time('heure_arrivee');
            $table->time('heure_depart')->nullable();
            $table->string('motif', 255)->nullable();
            $table->string('objets', 255)->nullable();

            // Locataire visité
            $table->string('locataire_nom', 150)->nullable();
            $table->string('numero_appartement', 50)->nullable();
            $table->string('etage_bloc', 50)->nullable();
            $table->string('relation', 255)->nullable();

            // Sécurité
            $table->enum('badge', ['Oui', 'Non'])->nullable();
            $table->string('numero_badge', 50)->nullable();
            $table->enum('autorisation', ['Oui', 'Non', 'Vérifiée par téléphone'])->nullable();
            $table->string('agent_enregistreur', 150)->nullable();
            $table->string('signature')->nullable();

            // timestamps Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
