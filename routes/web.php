<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ParcoursController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return Inertia::render('Welcome');
});

Route::get('/list', function() {
    return Inertia::render('List');
});

Route::get('/details', function() {
    return Inertia::render('Details');
});

Route::get('/options', function() {
    return Inertia::render('Options');
});



Route::get('/parcours', [ParcoursController::class, 'get_parcours']);
Route::get('/parcours/last3', [ParcoursController::class, 'get_last3_parcours']);
Route::get('/parcours/{id}', [ParcoursController::class, 'get_parcour']);
Route::get('/parcours/{id}/etapes', [EtapeController::class, 'get_etapes']);
Route::get('/parcours/{id}/images', [ImageController::class, 'get_images']);
Route::get('/image/{id}', [ImageController::class, 'get_image']);
Route::get('/etape/{id}', [EtapeController::class, 'get_etape']);


/*Route::fallback(function() {
    return Inertia::render('Welcome');
});*/