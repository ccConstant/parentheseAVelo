<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcours;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ParcoursController extends Controller
{

    public function verif_parcours(Request $request){
        $this->validate(
            $request,
            [
                'titre' => 'required|min:3|max:255',
                'description' => 'required|min:3|max:1000',
                'description_courte' => 'required|min:3|max:1000',
                'difficulte' => 'required|in:facile,moyen,difficile',
                'prix' => 'required|numeric'

            ],
            [
                'titre.required' => 'Vous devez entrer un titre pour le parcours',
                'titre.min' => 'Vous devez entrer au moins trois caractères',
                'titre.max' => 'Vous devez entrer au maximum 255 caractères',
                'description.required' => 'Vous devez entrer une description pour le parcours',
                'description.min' => 'Vous devez entrer au moins trois caractères',
                'description.max' => 'Vous devez entrer au maximum 1000 caractères',
                'description_courte.required' => 'Vous devez entrer une description courte pour le parcours',
                'description_courte.min' => 'Vous devez entrer au moins trois caractères',
                'description_courte.max' => 'Vous devez entrer au maximum 1000 caractères',
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
            $images=$parcour->images;
            $image=null;
            foreach($images as $img){
                if ($img->main==1){
                    $image=$img ; 
                }
            }
            if($image==null){
                $image=$parcour->images()->first();
            }
            $ville_depart=$parcour->etapes()->first();
            if ($image!=null){
                $image_path='/storage/images/'.$image->path;
                $image_alt=$image->alt;
            }
            $image_container=array();
            array_push($image_container,$image_path);
            array_push($image_container,$image_alt);
            if ($ville_depart!=null){
                $ville_depart=$ville_depart->ville_depart;
            }
            $obj=([
                'id' => $parcour->id,
                'titre' => $parcour->titre,
                'dureeJours' => $parcour->dureeJours,
                'difficulte' => $parcour->difficulte,
                'prix' =>$parcour->prix,
                'description_courte' => $parcour->description_courte,
                'image' => $image_container,
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
            $images=$parcour->images;
            $image=null;
            foreach($images as $img){
                if ($img->main==1){
                    $image=$img ; 
                }
            }
            if($image==null){
                $image=$parcour->images()->first();
            }
            $ville_depart=$parcour->etapes()->first();
            if ($image!=null){
                $image_path='/storage/images/'.$image->path;
                $image_alt=$image->alt;
            }
            $image_container=array();
            array_push($image_container,$image_path);
            array_push($image_container,$image_alt);
            if ($ville_depart!=null){
                $ville_depart=$ville_depart->ville_depart;
            }
            $obj=([
                'id' => $parcour->id,
                'titre' => $parcour->titre,
                'dureeJours' => $parcour->dureeJours,
                'difficulte' => $parcour->difficulte,
                'prix' =>$parcour->prix,
                'description_courte' => $parcour->description_courte,
                'image' => $image_container,
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
        $deb_path='/storage/images/';
        foreach($image as $img){
            $image_container=array();
            array_push($image_container,$img->id);
            array_push($image_container,$deb_path.$img->path);
            array_push($image_container,$img->alt);
            array_push($image_container,$img->main);
            array_push($images,$image_container);
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
            'plan_parcours'=> '/storage/images/'.$parcour->plan_parcours,
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

    public function add_plan(Request $request){
        $parcour=Parcours::find($request->id);
        $parcour->update([
            'plan_parcours' => $request->plan_parcours
        ]);
    }

    public function update_parcours(Request $request){
        $parcour=Parcours::find($request->id);
        $parcour->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'description_courte' => $request->description_courte,
            'difficulte' => $request->difficulte,
            'prix' => $request->prix
        ]) ;
    }

    public function delete_parcours(Request $request){
        $parcour=Parcours::find($request->id);
        foreach ($parcour->images as $image){
            if ($image->path!=''){
                Storage::delete('public/images/' . $image->path);
            }
        }
        if ($parcour->plan_parcours!=''){
            Storage::delete('public/images/' . $parcour->plan_parcours);
        }
        $parcour->delete();
    }
}
