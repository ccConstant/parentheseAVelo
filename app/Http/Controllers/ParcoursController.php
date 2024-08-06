<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcours;
use App\Models\Image;

class ParcoursController extends Controller
{

    public function verif_parcours(Request $request){
        $this->validate(
            $request,
            [
                'titre' => 'required|min:3|max:255',
                'description' => 'required|min:3|max:800',
                'description_courte' => 'required|min:3|max:255',
                'difficulte' => 'required|in:facile,moyen,difficile',
                'prix' => 'required|numeric'

            ],
            [
                'titre.required' => 'Vous devez entrer un titre pour le parcours',
                'titre.min' => 'Vous devez entrer au moins trois caractères',
                'titre.max' => 'Vous devez entrer au maximum 255 caractères',
                'description.required' => 'Vous devez entrer une description pour le parcours',
                'description.min' => 'Vous devez entrer au moins trois caractères',
                'description.max' => 'Vous devez entrer au maximum 800 caractères',
                'description_courte.required' => 'Vous devez entrer une description courte pour le parcours',
                'description_courte.min' => 'Vous devez entrer au moins trois caractères',
                'description_courte.max' => 'Vous devez entrer au maximum 255 caractères',
                'difficulte.required' => 'Vous devez entrer une difficulté pour le parcours',
                'difficulte.in' => 'Vous devez entrer une difficulté valide pour le parcours',
                'prix.required' => 'Vous devez entrer un prix pour le parcours',
                'prix.numeric' => 'Vous devez entrer un prix valide pour le parcours'
            ]
        );
    }
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

    public function add_parcours(Request $request){
        $parcour=Parcours::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'description_courte' => $request->description_courte,
            'difficulte' => $request->difficulte,
            'prix' => $request->prix
        ]) ;
        return response()->json($parcour->id);
    }

    public function maj_parcours(Request $request){
        $parcour=Parcours::find($request->id);
        $etapes=$parcour->etapes;
        $dureeJours=0;
        $dureeNuits=0;
        $deniveleCumul=0;
        $distance_moy=0;
        foreach($etapes as $etape){
            $deniveleCumul+=$etape->denivele;
            if ($etape->numero_etape!=1){
                $distance_moy+=$etape->distance;
            }
        }
        if ($etapes->count()!=1){
            $distance_moy=$distance_moy/($etapes->count()-1);
        }
        $dureeJours=$etapes->count();
        $dureeNuits=$etapes->count()-1 ; 
        $parcour->update([
            'dureeJours' => $dureeJours,
            'dureeNuits' => $dureeNuits,
            'deniveleCumul' => $deniveleCumul,
            'distance_moy' => $distance_moy
        ]); 
    }
}
