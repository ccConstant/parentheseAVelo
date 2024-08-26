<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etape;

class EtapeController extends Controller
{
  public function add_etape(Request $request){
    $etape=Etape::create(
    [
        'ville_depart' => $request->ville_depart,
        'ville_arrivee' => $request->ville_arrivee,
        'description' => $request->description,
        'parcours_id' => $request->parcours_id,
        'denivele' => $request->denivele,
        'distance' => $request->distance,
        'numero_etape' => $request->numero_etape
    ]);
    return response()->json($etape->id);
  }

  public function verif_etape(Request $request){
    $this->validate(
        $request,
        [
            'ville_depart' => 'required|min:3|max:255',
            'ville_arrivee' => 'required|min:3|max:255',
            'distance' => 'required|numeric',
            'denivele' => 'required|numeric',
            'description' => 'required|min:3|max:1000',
            'numero_etape' => 'required|numeric',
        ],
        [
            'ville_depart.required' => 'Vous devez entrer une ville de départ pour l\'étape',
            'ville_depart.min' => 'Vous devez entrer au moins trois caractères',
            'ville_depart.max' => 'Vous devez entrer au maximum 255 caractères',
            'ville_arrivee.required' => 'Vous devez entrer une ville d\'arrivée pour l\'étape',
            'ville_arrivee.min' => 'Vous devez entrer au moins trois caractères',
            'ville_arrivee.max' => 'Vous devez entrer au maximum 255 caractères',
            'distance.required' => 'Vous devez entrer une distance pour l\'étape',
            'distance.numeric' => 'Vous devez entrer une distance valide pour l\'étape',
            'denivele.required' => 'Vous devez entrer un dénivelé pour l\'étape',
            'denivele.numeric' => 'Vous devez entrer un dénivelé valide pour l\'étape',
            'description.required' => 'Vous devez entrer une description pour l\'étape',
            'description.min' => 'Vous devez entrer au moins trois caractères',
            'description.max' => 'Vous devez entrer au maximum 1000 caractères',
            'numero_etape.required' => 'Vous devez entrer un numéro d\'étape pour l\'étape',
            'numero_etape.numeric' => 'Vous devez entrer un numéro d\'étape valide pour l\'étape',
        ]
    );
  }

    public function update_etape(Request $request){
      $etape=Etape::find($request->id);
      $etape->update([
          'ville_depart' => $request->ville_depart,
          'ville_arrivee' => $request->ville_arrivee,
          'distance' => $request->distance,
          'denivele' => $request->denivele,
          'description' => $request->description,
          'numero_etape' => $request->numero_etape
      ]);
    }

    public function delete_etape(Request $request){
      $etape=Etape::find($request->id);
      $etape->delete();
    }
}
