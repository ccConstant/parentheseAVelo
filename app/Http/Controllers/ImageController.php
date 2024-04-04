<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function get_images($id){
        $images = Image::where('parcours_id', '=', $id)->get();
        return response()->json($images);
    }

    public function get_image($id){
        $image = Image::find($id);
        return response()->json($image);
    }
}
