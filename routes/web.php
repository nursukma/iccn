<?php

use App\Http\Controllers\SliderController;
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
Route::get('/home', function () {
    return view('home.index');
});

Route::get('/organisasi', function () {
    return view('organisasi.index');
});

Route::get('/berita', function () {
    return view('news.index');
});

Route::get('/sliders', function () {
    return view('sliders.action');
});

Route::get('/about', function () {
    return view('about.action');
});