<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function verif_image(Request $request){
        $this->validate(
            $request,
            [
                'alt' => 'required|min:3|max:800',
            ],
            [
                'alt.required' => 'Vous devez entrer un texte alternatif pour l\'image',
                'alt.min' => 'Vous devez entrer au moins trois caractères',
                'alt.max' => 'Vous devez entrer au maximum 800 caractères',
            ]
        );
    }
    
    public function add_image(Request $request){
        $image=Image::create([
            'path' => $request->path,
            'parcours_id' => $request->parcours_id,
            'main' => $request->main,
            'alt' => $request->alt
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

    public function delete_image(Request $request){
        $image=Image::find($request->id);
        $main=$image->main; 
        Storage::delete('public/images/' . $image->path);
        $image->delete();
        if ($main==1){
            $image=Image::where('parcours_id',$request->parcours_id)->first();
            if ($image!=null){
                $image->update([
                    'main' => 1
                ]);
            }
        }
    }

    public function update_image(Request $request){
        $image=Image::find($request->id);
        $image->update([
            'alt' => $request->alt,
            'main' => $request->main
        ]);
        return response()->json($image);
    }
}
