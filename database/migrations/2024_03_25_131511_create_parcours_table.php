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
        Schema::create('parcours', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
            $table->int('dureeJours');
            $table->int('dureeNuits');
            $table->enum('difficulte', ['facile', 'moyen', 'difficile']);
            $table->float('deniveleCumul');
            $table->float("prix");
            $table->float("distance_moy");
            $table->string('plan_parcours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcours');
    }
};
