<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $fillable = [
        'Ville_depart', 
        'Ville_arrivee',
        'Distance',
        'Denivele',
        'Description',
        'NumeroEtape',
        'parcours_id'
    ];
}
