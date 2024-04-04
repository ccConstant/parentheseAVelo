<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EtapeController extends Controller
{
    public function get_etapes($id){
        $etapes = Etape::where('parcours_id', '=', $id)->get();
        return response()->json($etapes);
    }

    public function get_etape($id){
        $etape = Etape::find($id);
        return response()->json($etape);
    }
}
