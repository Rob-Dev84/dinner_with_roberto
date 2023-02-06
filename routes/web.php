<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostIngredientController;
use App\Http\Controllers\Post\PostIngredientGroupController;
// use App\Http\Controllers\Post\PostIngredientGroupController;

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

//TODO Only admin can access to Dashboard (stats), Manage Post, New Posts from guest users (future)
//TODO Group middleware for "is_admin"

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('posts');

  
                    //TODO use -> user:username (because will be unique)
    Route::get('/posts/{user:name}', 'create')->name('posts.create');//form to create a post (title)
    Route::post('/posts/{user:name}', 'store')->name('posts.store');

    Route::get('/posts/{user:name}/{post:slug}', 'edit')->name('posts.edit');//form to modify post title
    Route::put('/posts/{user:name}/{post:slug}', 'update')->name('posts.update');
    // Route::put('/posts/{user:name}/{post:title}/softDelete', 'softDelete')->name('posts.softDelete');


    // Route::delete('/posts/{user:name}/{post:title}', 'destroy')->name('posts.destroy');
})->middleware(['auth', 'verified']);

Route::controller(PostIngredientController::class)->group(function () {

                //TODO use -> user:username (because will be unique)
    Route::get('/posts/ingredients/{user:name}/{post:slug}', 'index')->name('posts.ingredients');
  
    // Route::get('/posts/ingredients/{user:name}/{post:slug}', 'edit')->name('posts.ingredients.edit');//form to modify post intro
    Route::post('/posts/ingredients/{user:name}/{post:slug}/store', 'store')->name('posts.ingredients.store');


    // Route::put('/posts/ingredients/{user:name}/{post:slug}', 'update')->name('posts.ingredients.update');
    // Route::put('/posts/ingredients/{user:name}/{post:slug}', 'softDelete')->name('invitation.ingredients.softDelete');

    
    // Route::delete('/posts/{user:name}/{post:title}/intro', 'destroy')->name('posts.intro.destroy');
})->middleware(['auth', 'verified']);

Route::controller(PostIngredientGroupController::class)->group(function () {

    //TODO use -> user:username (because will be unique)
Route::get('/posts/ingredients/groups/{user:name}/{post:slug}', 'index')->name('posts.ingredients.groups'); //Show all ingredients to group
Route::post('/posts/ingredients/groups/{user:name}/{post:slug}/store', 'store')->name('posts.ingredients.groups.store');


Route::put('/posts/ingredients/groups/{user:name}/{post:slug}', 'update')->name('posts.ingredients.groups.update');
// Route::put('/posts/ingredients/groups/{user:name}/{post:slug}', 'softDelete')->name('invitation.ingredients.groups.softDelete');


// Route::delete('/posts/{user:name}/{post:title}/intro', 'destroy')->name('posts.intro.destroy');
})->middleware(['auth', 'verified']);


// Route::get('/posts', function () {
//     return view('posts');
// })->middleware(['auth', 'verified'])->name('posts');

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
