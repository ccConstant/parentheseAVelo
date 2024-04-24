<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parcours;

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

    public function parcours(){
        return $this->belongsTo(Parcours::class, 'parcours_id') ; 
    }
}
