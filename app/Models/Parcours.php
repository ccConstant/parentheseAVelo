<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'plan_parcours'
    ];
}
