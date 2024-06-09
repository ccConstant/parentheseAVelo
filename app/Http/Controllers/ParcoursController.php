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
        $container=array() ;
        foreach($parcours as $parcour){
            $image=$parcour->images()->first();
            $ville_depart=$parcour->etapes()->first();
            if ($image!=null){
                $image='/images/'.$parcour->id."/".$image->path;
            }
            if ($ville_depart!=null){
                $ville_depart=$ville_depart->Ville_depart;
            }
            $obj=([
                'id' => $parcour->id,
                'titre' => $parcour->titre,
                'dureeJours' => $parcour->dureeJours,
                'difficulte' => $parcour->difficulte,
                'prix' =>$parcour->prix,
                'description_courte' => $parcour->description_courte,
                'image' => $image,
                'ville_depart' => $ville_depart
            ]);
            array_push($container,$obj);
        }
        return response()->json($container);
    }

    public function get_last_parcours(){
        $parcours = Parcours::orderBy('created_at', 'desc')->take(3)->get();
        $container=array() ;
        foreach($parcours as $parcour){
            $image=$parcour->images()->first();
            $ville_depart=$parcour->etapes()->first();
            if ($image!=null){
                $image='/images/'.$parcour->id."/".$image->path;
            }
            if ($ville_depart!=null){
                $ville_depart=$ville_depart->Ville_depart;
            }
            $obj=([
                'id' => $parcour->id,
                'titre' => $parcour->titre,
                'dureeJours' => $parcour->dureeJours,
                'difficulte' => $parcour->difficulte,
                'prix' =>$parcour->prix,
                'description_courte' => $parcour->description_courte,
                'image' => $image,
                'ville_depart' => $ville_depart
            ]);
            array_push($container,$obj);
        }
        return response()->json($container);
    }

    public function get_parcour($id){
        $parcour = Parcours::find($id);
        $container=array() ;
        $image=$parcour->images;
        $images=array();
        $deb_path='/images/'.$id."/";
        foreach($image as $img){
            array_push($images,$deb_path.$img->path);
        }

        $etape=$parcour->etapes;
        $container=([
            'id' => $parcour->id,
            'titre' => $parcour->titre,
            'description' => $parcour->description,
            'dureeJours' => $parcour->dureeJours,
            'dureeNuits' => $parcour->dureeNuits,
            'difficulte' => $parcour->difficulte,
            'deniveleCumul' => $parcour->deniveleCumul,
            'prix' =>$parcour->prix,
            'distance_moy'=> $parcour->distance_moy,
            'plan_parcours'=> '/images/'.$id."/".$parcour->plan_parcours,
            'description_courte' => $parcour->description_courte,
            'image' => $images,
            'etapes' => $etape

        ]);
        return response()->json($container);
    }
}
