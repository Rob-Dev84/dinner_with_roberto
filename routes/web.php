<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostImageController;
use App\Http\Controllers\Post\PostMethodController;
use App\Http\Controllers\Post\PostIngredientController;
use App\Http\Controllers\Post\PostMethodGroupController;
use App\Http\Controllers\Post\PostTrashedImageController;
use App\Http\Controllers\Post\PostImageDeletionController;
use App\Http\Controllers\Post\PostIngredientGroupController;

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

// Route::group(['middleware' => ['XssSanitizer']], function () {

    Route::get('/', function () {
        return view('home');
    });

    //TODO Only admin can access to Dashboard (stats), Manage Post, New Posts from guest users (future)
    //TODO Group middleware for "is_admin"

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::middleware(['auth', 'verified', 'XssSanitizer'])->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('/posts', 'index')->name('posts');

        
                            
            Route::get('/posts/{user:username}', 'create')->name('posts.create');//form to create a post (title)
            Route::post('/posts/{user:username}', 'store')->name('posts.store');

            Route::get('/posts/{user:username}/{post:slug}', 'edit')->name('posts.edit');//form to modify post title
            Route::put('/posts/{user:nausernameme}/{post:slug}', 'update')->name('posts.update');//TODO: update post info 
            Route::put('/posts/{user:username}/{post:title}/softDelete', 'softDelete')->name('posts.softDelete');


            // Route::delete('/posts/{user:name}/{post:title}', 'destroy')->name('posts.destroy');
            //TODO: make a trashed controller and:   
                                                // 1. add soft delete
                                                // 2. index to show all deleted post
                                                // 3. hard delete
        });
        // ->middleware(['auth', 'verified', 'XssSanitizer']);

        Route::controller(PostIngredientController::class)->group(function () {

            Route::get('/posts/ingredients/{user:username}/{post:slug}', 'index')->name('posts.ingredients');
            Route::post('/posts/ingredients/{user:username}/{post:slug}/store', 'store')->name('posts.ingredients.store');//add new ingredient in a post
    
            Route::get('/posts/ingredients/{ingredient:id}/{user:username}/{post:slug}/edit', 'edit')->name('posts.ingredients.edit');//todo form to modify ingredient inserted (available from )
            Route::put('/posts/ingredients/{ingredient:id}/{user:username}/{post:slug}/update', 'update')->name('posts.ingredients.update');
    
            Route::put('/posts/ingredients/{post_ingredients:id}/{user:username}/{post:slug}', 'ungroup')->name('posts.ingredients.ungroup');
    
            Route::delete('/posts/ingredients/{ingredient:id}/{user:username}/{post:slug}/delete', 'destroy')->name('posts.ingredients.delete');
    
        });
    
        Route::controller(PostIngredientGroupController::class)->group(function () {
    
            Route::get('/posts/ingredients/groups/{user:username}/{post:slug}', 'index')->name('posts.ingredients.groups'); //Here we show: all ingredients, ingredients grouped, ingredients not grouped
            Route::post('/posts/ingredients/groups/{user:username}/{post:slug}/store', 'store')->name('posts.ingredients.groups.store');
            Route::get('/posts/ingredients/groups/{ingredientGrouped:id}/{user:username}/{post:slug}/edit', 'edit')->name('posts.ingredients.groups.edit');
            Route::put('/posts/ingredients/groups/{ingredientGrouped:id}/{user:username}/{post:slug}/updateTitle', 'updateTitle')->name('posts.ingredients.groups.updateTitle');
            Route::put('/posts/ingredients/groups/update/{user:username}/{post:slug}', 'update')->name('posts.ingredients.groups.update');
            Route::delete('/posts/ingredients/groups/{post_ingredient_groups:id}/{user:username}/{post:slug}', 'destroy')->name('post.ingredients.groups.destroy');
    
        });
    
    
        Route::controller(PostMethodController::class)->group(function () {
    
            Route::get('/posts/methods/{user:username}/{post:slug}', 'index')->name('posts.methods');
            Route::post('/posts/methods/{user:username}/{post:slug}/store', 'store')->name('posts.methods.store');//add new ingredient in a post
            Route::get('/posts/methods/{method:id}/{user:username}/{post:slug}/edit', 'edit')->name('posts.methods.edit');//todo form to modify ingredient inserted (available from )
            Route::put('/posts/methods/{method:id}/{user:username}/{post:slug}/update', 'update')->name('posts.methods.update');
            Route::put('/posts/methods/{method:id}/{user:username}/{post:slug}', 'ungroup')->name('posts.methods.ungroup');
            Route::delete('/posts/methods/{method:id}/{user:username}/{post:slug}/delete', 'destroy')->name('posts.methods.delete');
    
        });
    
    
        Route::controller(PostMethodGroupController::class)->group(function () {
    
            Route::get('/posts/methods/groups/{user:username}/{post:slug}', 'index')->name('posts.methods.groups'); //Here we show: all methods, methods grouped, methods not grouped
            Route::post('/posts/methods/groups/{user:username}/{post:slug}/store', 'store')->name('posts.methods.groups.store');
            Route::get('/posts/methods/groups/{methodGrouped:id}/{user:username}/{post:slug}/edit', 'edit')->name('posts.methods.groups.edit');
            Route::put('/posts/methods/groups/{methodGrouped:id}/{user:username}/{post:slug}/updateTitle', 'updateTitle')->name('posts.methods.groups.updateTitle');
            Route::put('/posts/methods/groups/update/{user:username}/{post:slug}', 'update')->name('posts.methods.groups.update');
            Route::delete('/posts/methods/groups/{post_ingredient_groups:id}/{user:username}/{post:slug}', 'destroy')->name('post.methods.groups.destroy');
    
        });
    
        Route::controller(PostImageController::class)->group(function () {
    
            Route::get('/posts/images/{user:username}/{post:slug}', 'index')->name('posts.images'); //Here we show: all methods, methods grouped, methods not grouped
            Route::get('/posts/images/{user:username}/{post:slug}/create', 'create')->name('posts.images.create');
            Route::post('/posts/images/{user:username}/{post:slug}/store', 'store')->name('posts.images.store');
            Route::get('/posts/images/{user:username}/{post:slug}/edit', 'edit')->name('posts.images.edit');
            Route::post('/posts/images/{user:username}/{post:slug}/update', 'update')->name('posts.images.update');
            
        });
    
        Route::controller(PostImageDeletionController::class)->group(function () {
    
            Route::get('/posts/images/{user:username}/{post:slug}', 'index')->name('posts.images.deletions');
            Route::delete('/posts/images/{post_images:slug}/{user:username}/{post:slug}/softDelete', 'softDelete')->name('posts.images.deletions.softDelete');
    
        });
    
        Route::controller(PostTrashedImageController::class)->group(function () {
    
            Route::get('/posts/images/{user:username}/{post:slug}/trash', 'index')->name('posts.images.trash');
            Route::put('/posts/images/{post_images:slug}/{user:username}/{post:slug}/restore', 'restore')->name('posts.images.deletions.restore');
            Route::delete('/posts/images/{post_images:slug}/{user:username}/{post:slug}/forceDelete', 'forceDelete')->name('posts.images.deletions.forceDelete');
    
        });



    });

    



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

    Route::middleware(['auth' , 'XssSanitizer'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// });

require __DIR__.'/auth.php';
