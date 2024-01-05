<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserMetaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\UploadVedioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('layouts.Dashlead.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource("/user", UserController::class);
Route::get("/changeStatus/{id}", [UserController::class, 'changeStatus']);
Route::get("/userDetail/{id}", [UserController::class, 'userDetail']);
Route::resource('/faq', FaqController::class);
Route::resource('/upload_video',UploadVedioController::class);


require __DIR__ . '/auth.php';
