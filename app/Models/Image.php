<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parcours;

class Image extends Model
{
    protected $fillable=[
        'path', 
        'parcours_id',
        'main'
    ]; 

    public function parcours(){
        return $this->belongsTo(Parcours::class, 'parcours_id') ; 
    }
}
