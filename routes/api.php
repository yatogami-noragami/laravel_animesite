<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::get('home', [ApiController::class, 'home'])->name('api#user#home');
    Route::get('animelist', [ApiController::class, 'animelist'])->name('api#user#animelist');
    Route::get('newseason', [ApiController::class, 'newseason'])->name('api#user#home');
    Route::get('movies', [ApiController::class, 'movies'])->name('api#user#movies');
    Route::get('popular', [ApiController::class, 'popular'])->name('api#user#popular');
});


//User home
//http://localhost/anime_site/public/api/user/home

//User animelist
//http://localhost/anime_site/public/api/user/animelist

//User newseason
//http://localhost/anime_site/public/api/user/newseason

//User movies
//http://localhost/anime_site/public/api/user/movies

//User popular
//http://localhost/anime_site/public/api/user/popular