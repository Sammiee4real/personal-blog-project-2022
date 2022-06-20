<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Articles\ArticleController;
use App\Http\Controllers\Articles\CategoryController;

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

// UNAUTHENTICATED ROUTES
Route::view('/','index')->name('index');


//ROUTE GROUPING
Route::middleware('auth')->group( function(){
    Route::view('/dashboard','dashboard')->name('dashboard');
    Route::view('/about-me','about-me')->name('about-me');


    Route::prefix('articles/')->group(function (){
        Route::get('myarticles',[ArticleController::class,'myArticles'])->name(
            'articles.myarticles');
        Route::resource('articles', ArticleController::class);    
    }); 
    Route::prefix('categories/')->group(function (){
        Route::resource('categories', CategoryController::class)->except(['destroy','show']);      
    }); 
});





require __DIR__.'/auth.php';
