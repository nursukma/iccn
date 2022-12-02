<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AksiBersamaController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PrinsipKotaController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

Route::group(['middleware' => ['auth', 'revalidate']], function () {
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

    Route::resource('aksi-bersama', AksiBersamaController::class);
    Route::get('/getAksiBersama', [AksiBersamaController::class, 'getAksiBersama'])->name('aksi-bersama.all');

    Route::post('/aksi-bersama/{id}', [AksiBersamaController::class, 'storeItem'])->name('aksi-bersama.item');
    Route::get('/detail-item/{id}', [AksiBersamaController::class, 'detailItem'])->name('aksi-bersama.detailItem');
    Route::delete('/delete-item/{id}', [AksiBersamaController::class, 'deleteItem'])->name('aksi-bersama.deleteItem');
    Route::put('/update-item/{id}', [AksiBersamaController::class, 'updateItem'])->name('aksi-bersama.updateItem');
    Route::get('/getDetail/{id}', [AksiBersamaController::class, 'detailAksi'])->name('aksi-bersama.detailAksi');
    Route::get('/getAksi/{id}', [AksiBersamaController::class, 'getAksi'])->name('aksi-bersama.getAksi');

    Route::resource('program', ProgramController::class);
    Route::get('/programDetail/{id}', [ProgramController::class, 'detailItem'])->name('program.detailItem');
    Route::post('/programStore/{id}', [ProgramController::class, 'storeItem'])->name('program.itemStore');
    Route::put('/programUpdate/{id}', [ProgramController::class, 'updateItem'])->name('program.itemUpdate');
    Route::delete('/programDelete/{id}', [ProgramController::class, 'deleteItem'])->name('program.itemDelete');
    Route::get('/programItem/{id}', [ProgramController::class, 'showItem'])->name('program.showItem');

    Route::resource('pengurus', PengurusController::class);
    Route::resource('koordinator', KoordinatorController::class);

    Route::resource('struktur', StrukturController::class);
    Route::get('/getStruktur', [StrukturController::class, 'getStruktur']);

    Route::resource('news', NewsController::class);
    Route::post('/imagenews', [NewsController::class, 'upImages'])->name('news.upImages');
});
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);