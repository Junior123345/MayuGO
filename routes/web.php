<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VivoController;
use App\Http\Controllers\CursoGrabadoController;
use App\Http\Controllers\PremiumController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vivo', [VivoController::class, 'index'])->name('vivo.index');
Route::get('/cursos-grabados', [CursoGrabadoController::class, 'index'])->name('cursos.grabados');
Route::get('/premium', [PremiumController::class, 'index'])->name('premium.index');
