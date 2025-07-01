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
        Schema::create('AjoutLocaData', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->required();
            $table->string('prenoms')->required();
            $table->string('sexe')->required();
            $table->string('matricule')->required();
            $table->date('dateNaissance')->required();
            $table->date('sorti')->nullable();


            $table->Date('entrer')->required();
            $table->string('montantloy')->required();
            $table->integer('numApp')->required();
            $table->string('statut')->required();
            $table->string('photo')->required();
            $table->string('cni')->required();
            $table->string('email')->nullable();
            $table->string('phone')->required();
            $table->string('profession')->required();
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
