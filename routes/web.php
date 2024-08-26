<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ParcoursController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageUploadController;

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

Route::get('/manageParcours', function() {
    return Inertia::render('ManageParcours');
})->name('manageParcours');

Route::get('/updateParcours/{id}', function() {
    return Inertia::render('UpdateParcoursForm');
})->name('UpdateParcours');

Route::get('/addParcoursForm', function() {
    return Inertia::render('AddParcoursForm');
})->name('addParcoursForm');

Route::get('/parcours', [ParcoursController::class, 'get_parcours']);
Route::get('/lastparcours', [ParcoursController::class, 'get_last_parcours']);
Route::get('/parcours/get/{id}', [ParcoursController::class, 'get_parcour']);
Route::post('/parcours/maj', [ParcoursController::class, 'maj_parcours']);
Route::post('/parcours/verif', [ParcoursController::class, 'verif_parcours']);
Route::post('/parcours/add', [ParcoursController::class, 'add_parcours']);
Route::post('/parcours/delete', [ParcoursController::class, 'delete_parcours']);
Route::post('/parcours/update', [ParcoursController::class, 'update_parcours']);
Route::post('/parcours/addPlan', [ParcoursController::class, 'add_plan']);
Route::post('/etape/add', [EtapeController::class, 'add_etape']);
Route::post('/etape/verif', [EtapeController::class, 'verif_etape']);
Route::post('/etape/update', [EtapeController::class, 'update_etape']);
Route::post('/etape/delete', [EtapeController::class, 'delete_etape']);
Route::post('/image/add', [ImageController::class, 'add_image']);
Route::post('/image/verifOnlyOneMain', [ImageController::class, 'verif_only_one_main']);
Route::post('/image/update', [ImageController::class, 'update_image']);
Route::post('/image/delete', [ImageController::class, 'delete_image']);
Route::post('/image/verif', [ImageController::class, 'verif_image']);

Route::post('/upload-image', [ImageUploadController::class, 'upload'])->middleware('auth:sanctum');



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