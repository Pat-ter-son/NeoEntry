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
        Schema::create('AjoutAgentLocaMigration', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->required();

            $table->string('prenoms')->required();
            $table->string('matricule')->required();
            $table->string('adresse')->required();
            $table->string('departement')->required();
            $table->date('dateEntree')->required();
            $table->string('montantLoyer')->required();
            $table->string('statut')->required();
            $table->string('photo')->nullable();
            $table->string('cni')->nullable();

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
