<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Etape;

class Parcours extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'dureeJours',
        'dureeNuits',
        'difficulte',
        'deniveleCumul',
        'prix',
        'distance_moy',
        'plan_parcours',
        'description_courte'
    ];


    public function images(){
        return $this->hasMany(Image::class) ;
    }

    public function etapes(){
        return $this->hasMany(Etape::class) ;
    }
}
