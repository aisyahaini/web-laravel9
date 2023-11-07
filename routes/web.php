<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PictureController;

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

Route::get('/', [StudentController::class, 'index'])->name('index');


// route parameters : bisa langsung digunakan dengan cara di browser http://127.0.0.1:8000/greeting/aisyah 
// akan muncul Hello aisyah

//->name('show') show merupakan nama route
Route::get('/show/{id}', [StudentController::class, 'show'])->name('show'); // show sebagai method, di show pake '' karena string
    
Route::get('/filter', [StudentController::class, 'filter']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// untuk update password
Route::get('/update_password', [HomeController::class, 'update_password'])->name('update_password');

// untuk store password
Route::patch('/store_password', [HomeController::class, 'store_password'])->name('store_password');

// middleware untuk pengelompokan data yang diinginkan
Route::middleware(['admin'])->group(function() {
    //-> name('greeting_with_name'); // Named route dikasih nama agar lebih gampang baik di controller atau di views
    Route::get('/create', [StudentController::class, 'create'])->name('create');

    // untuk submit data pakenya post
    Route::post('/create', [StudentController::class, 'store'])->name('store');

    // untuk update data
    Route::get('/edit/{student}', [StudentController::class, 'edit'])->name('edit');

    // put untuk edit seluruh data, patch untuk edit sebagian data
    Route::patch('/update/{student}', [StudentController::class, 'update'])->name('update');

    // untuk delete data, route nya pake route delete
    Route::delete('/delete/{student}', [StudentController::class, 'delete'])->name('delete');
});


// untuk locale
Route::get('/locale/{locale}', [LocaleController::class, 'set_locale'])->name('set_locale');

// ------ Storage --------
Route::get('/picture/create', [PictureController::class, 'create'])->name('picture.create');

// ----- Store -----
Route::post('/picture/create', [PictureController::class, 'store'])->name('picture.store');

// show picture
Route::get('/picture/{picture}', [PictureController::class, 'show'])->name('picture.show');

// delete file picture
Route::delete('/picture/{picture}', [PictureController::class, 'delete'])->name('picture.delete');

// copy file picture
Route::get('/copy/{picture}', [PictureController::class, 'copy'])->name('picture.copy');

// move file picture
Route::get('/move/{picture}', [PictureController::class, 'move'])->name('picture.move');