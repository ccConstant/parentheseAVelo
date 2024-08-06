<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parcours;

class Etape extends Model
{
    protected $fillable = [
        'ville_depart', 
        'ville_arrivee',
        'distance',
        'denivele',
        'description',
        'numero_etape',
        'parcours_id'
    ];

    public function parcours(){
        return $this->belongsTo(Parcours::class, 'parcours_id') ; 
    }
}
