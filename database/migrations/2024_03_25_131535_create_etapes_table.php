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
        Schema::create('etapes', function (Blueprint $table) {
            $table->id();
            $table->String('Ville_depart') ; 
            $table->String('Ville_arrivee') ; 
            $table->float('Distance') ;
            $table->float('Denivele');
            $table->String('Description') ;
            $table->integer('NumeroEtape');
            $table->unsignedBigInteger('parcours_id');
            $table->foreign('parcours_id')->references('id')->on('parcours')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapes');
    }
};
