<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ParcoursController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;

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


/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/', function() {
    return Inertia::render('Welcome');
});

Route::get('/list', function() {
    return Inertia::render('List');
});

Route::get('/parcours/{id}/', function() {
    return Inertia::render('Details');
});

Route::get('/parcoursSurMesure', function() {
    return Inertia::render('ParcoursSurMesure');
});

Route::get('/options', function() {
    return Inertia::render('Options');
});

Route::get('/condGeneralesVente', function() {
    return Inertia::render('CondGeneraleVente');
});

Route::get('/condUtilisation', function() {
    return Inertia::render('CondUtilisation');
});

Route::get('/parcours', [ParcoursController::class, 'get_parcours']);
Route::get('/lastparcours', [ParcoursController::class, 'get_last_parcours']);
Route::get('/parcours/get/{id}', [ParcoursController::class, 'get_parcour']);
Route::get('/parcours/{id}/etapes', [EtapeController::class, 'get_etapes']);
Route::get('/parcours/{id}/images', [ImageController::class, 'get_images']);
Route::get('/image/{id}', [ImageController::class, 'get_image']);
Route::get('/etape/{id}', [EtapeController::class, 'get_etape']);


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin', function() {
        return Inertia::render('Welcome');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/*Route::fallback(function() {
    return Inertia::render('Welcome');
});*/