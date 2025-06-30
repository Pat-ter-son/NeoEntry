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
        Schema::create('AjoutAgentData', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->required();
            $table->string('prenoms')->required();
            $table->string('matricule')->required();
            $table->string('fonction')->required();
            $table->string('departement')->required();
            $table->string('statut')->required();
            $table->integer('numApp')->required();
            $table->string('photo')->nullable();
            $table->string('sexe')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->date('dateEntree')->nullable();
            $table->string('cni')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
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
