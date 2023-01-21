<?php

use App\Http\Controllers\ProfileController;
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
    return view('home');
});

//TODO  Only admin can access to Dashboard (stats), Manage Post, New Posts from guest users (future)
//TODO Group middleware for "is_admin"

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/posts', function () {
    return view('posts');
})->middleware(['auth', 'verified'])->name('posts');

Route::get('/hint', function () {
    return view('hint');
})->middleware(['auth', 'verified'])->name('hint');



Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/recipes', function () {
    return view('recipes');
})->name('recipes');

Route::get('/tips', function () {
    return view('tips');
})->name('tips');

Route::get('/videos', function () {
    return view('videos');
})->name('videos');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
