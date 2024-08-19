<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function add_image(Request $request){
        $image=Image::create([
            'path' => $request->path,
            'parcours_id' => $request->parcours_id,
            'main' => $request->main
        ]);
        return response()->json($image);
    }

    public function verif_only_one_main(Request $request){
        $images=Image::where('parcours_id',$request->parcours_id)->get();
        foreach($images as $img){
            if ($img->main==1){
                $img->main=0;
                $img->save();
            }
        }
    }
}
