<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcours;
use App\Models\Image;

class ParcoursController extends Controller
{
    public function get_parcours(){
        $parcours = Parcours::all();
        return response()->json($parcours);
    }

    public function get_last3_parcours(){
        $parcours = Parcours::orderBy('created_at', 'desc')->take(3)->get();
        $container=array() ;
        foreach($parcours as $parcour){
            $image=$parcour->images()->first();
            $obj=([
                'id' => $parcour->id,
                'titre' => $parcour->titre,
                'dureeJours' => $parcour->dureeJours,
                'difficulte' => $parcour->difficulte,
                'prix' =>$parcour->prix,
                'description_courte' => $parcour->description_courte,
                'image' => $image->path
            ]);
            array_push($container,$obj);
        }
        return response()->json($container);
    }

    public function get_parcour($id){
        $parcour = Parcours::find($id);
        return response()->json($parcour);
    }
}
