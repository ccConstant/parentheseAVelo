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
            $table->text('description');
            $table->integer('dureeJours')->nullable();
            $table->integer('dureeNuits')->nullable();
            $table->enum('difficulte', ['facile', 'moyen', 'difficile']);
            $table->float('deniveleCumul')->nullable();
            $table->float("prix");
            $table->float("distance_moy")->nullable();
            $table->string('plan_parcours')->nullable();
            $table->text('description_courte');
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
