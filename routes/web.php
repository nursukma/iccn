<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PrinsipKotaController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});

Route::resource('sliders', SliderController::class);
Route::get('/getSliders', [SliderController::class, 'getSliders'])->name('sliders.all');

Route::resource('about', AboutController::class);
Route::get('/getAbout', [AboutController::class, 'getAbout'])->name('about.all');

Route::resource('prinsip-kota', PrinsipKotaController::class);
Route::get('/getPrinsip', [PrinsipKotaController::class, 'getPrinsip'])->name('prinsip.all');

Route::resource('materi', MateriController::class);
Route::get('/getMateri', [MateriController::class, 'getMateri'])->name('materi.all');

Route::resource('timeline', TimelineController::class);
Route::get('/getTimeline', [TimelineController::class, 'getTimeline'])->name('timeline.all');