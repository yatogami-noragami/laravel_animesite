<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\UserContactController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\AdminAnimeHomeController;
use App\Http\Controllers\AdminGenreHomeController;
use App\Http\Controllers\AdminMovieHomeController;
use App\Http\Controllers\AdminCommentHomeController;
use App\Http\Controllers\AdminEpisodeHomeController;
use App\Http\Controllers\AdminBookmarkHomeController;

// login and register pages are restricted without logging out

Route::middleware('admin_auth')->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('/registerPage', [AuthController::class, 'register'])->name('registerPage');
    Route::get('/loginPage', [AuthController::class, 'login'])->name('loginPage');
});

// login and register pages are restricted without logging out

Route::middleware('user_auth')->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('/registerPage', [AuthController::class, 'register'])->name('registerPage');
    Route::get('/loginPage', [AuthController::class, 'login'])->name('loginPage');
});

// routes only after register/login

Route::middleware(['auth'])->group(function () {

    //the route which divides between user and admin

    Route::get('wall', [AuthController::class, 'wall'])->name('wall');

    //account profile for both user and admin

    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile#edit');
    Route::get('profile/change', [ProfileController::class, 'change'])->name('profile#change');
    Route::post('profile/editForm', [ProfileController::class, 'editForm'])->name('profile#editForm');
    Route::post('profile/changeForm', [ProfileController::class, 'changeForm'])->name('profile#changeForm');

    //user only routes

    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {

        // user homepage home

        Route::get('homepage', [UserHomeController::class, 'userHome'])->name('user#home');
        Route::get('homepage/namesort', [UserHomeController::class, 'userhomenamesort'])->name('user#home#name#sort');
        Route::get('homepage/genresort/{name}', [UserHomeController::class, 'userhomegenresort'])->name('user#home#genre#sort');

        //search box

        Route::prefix('ajax')->group(function () {
            Route::get('anime/search/{key}', [UserHomeController::class, 'animeSearch'])->name('anime#search');
            Route::get('movie/search/{key}', [UserHomeController::class, 'movieSearch'])->name('movie#search');
        });

        // user homepage animelist

        Route::get('homepage/animelist', [UserHomeController::class, 'userHomeAnimeList'])->name('user#home#anime#list');
        Route::get('animelist/genresort/{name}', [UserHomeController::class, 'useranimelistgenresort'])->name('user#anime#list#genre#sort');
        Route::get('animelist/alphabet/{letter}', [UserHomeController::class, 'useranimelistlettersort'])->name('user#home#anime#list#letter#sort');

        // user homepage popular

        Route::get('homepage/popular', [UserHomeController::class, 'userHomePopular'])->name('user#home#popular');
        Route::get('popular/namesort', [UserHomeController::class, 'userpopularnamesort'])->name('user#popular#name#sort');
        Route::get('popular/genresort/{name}', [UserHomeController::class, 'userpopulargenresort'])->name('user#popular#genre#sort');

        // user homepage new season

        Route::get('homepage/newseason', [UserHomeController::class, 'userHomeNewSeason'])->name('user#home#new#season');
        Route::get('newseason/namesort', [UserHomeController::class, 'usernewseasonnamesort'])->name('user#new#season#name#sort');
        Route::get('newseason/genresort/{name}', [UserHomeController::class, 'usernewseasongenresort'])->name('user#new#season#genre#sort');

        // user homepage movies

        Route::get('homepage/movies', [UserHomeController::class, 'userHomeMovies'])->name('user#home#movies');
        Route::get('movies/namesort', [UserHomeController::class, 'usermoviesnamesort'])->name('user#movies#name#sort');
        Route::get('movies/genresort/{name}', [UserHomeController::class, 'usermoviesgenresort'])->name('user#movies#genre#sort');

        // detail page for anime and movie

        Route::get('anime/{id}', [AnimeController::class, 'userAnimeDetails'])->name('user#anime#details');
        Route::get('movie/{id}', [AnimeController::class, 'userMovieDetails'])->name('user#movie#details');

        //video watching page for anime and movie

        Route::get('anime/watch/{id}/{epid}', [AnimeController::class, 'userAnimeWatch'])->name('user#anime#watch');
        Route::get('movie/watch/{id}', [AnimeController::class, 'userMovieWatch'])->name('user#movie#watch');
        Route::get('comment/delete/{userid}/{id}/{epid}', [AnimeController::class, 'userCommentDelete'])->name('user#comment#delete');
        Route::post('comment/edit/{userid}/{id}/{epid}', [AnimeController::class, 'userCommentEdit'])->name('user#comment#edit');

        // comment and bookmark page for anime and movie

        Route::post('anime/watch/comment/{userid}/{animeid}/{animeepid}', [CommentController::class, 'comment'])->name('user#anime#comment');
        Route::post('anime/bookmark/add', [BookmarkController::class, 'bookmarkAdd'])->name('user#anime#bookmark#add');
        Route::post('anime/bookmark/remove', [BookmarkController::class, 'bookmarkRemove'])->name('user#anime#bookmark#remove');
        Route::get('anime/bookmark/remove/all', [BookmarkController::class, 'animeBookmarkRemoveAll'])->name('user#anime#bookmark#remove#all');
        Route::get('profile/bookmark/animename/{animename}/{type}', [BookmarkController::class, 'bookmarkToAnime'])->name('user#bookmark#anime');

        // user request form

        Route::get('user/request', [UserRequestController::class, 'request'])->name('user#request');
        Route::post('user/request/form', [UserRequestController::class, 'requestAnime'])->name('user#request#anime');

        // user contact form

        Route::get('user/contact', [UserContactController::class, 'contact'])->name('user#contact');
        Route::post('user/contact/form', [UserContactController::class, 'contactAdmin'])->name('user#contact#admin');
    });

    // admin only routes

    Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {
        // admin homepage users

        Route::get('homepage', [AdminHomeController::class, 'adminHome'])->name('admin#home');
        Route::get('homepage/noti/request/{number}', [AdminHomeController::class, 'adminHomeNoti'])->name('admin#home#request');
        Route::get('homepage/noti/contact/{number}', [AdminHomeController::class, 'adminHomeNoti2'])->name('admin#home#contact');
        Route::get('request/reject/{id}', [AdminHomeController::class, 'requestReject'])->name('request#reject');
        Route::get('request/fullfill/{id}', [AdminHomeController::class, 'requestFullfill'])->name('request#fullfill');
        Route::get('contact/reject/{id}', [AdminHomeController::class, 'contactReject'])->name('contact#reject');
        Route::get('contact/fullfill/{id}', [AdminHomeController::class, 'contactFullfill'])->name('contact#fullfill');
        Route::get('usersidsort', [AdminHomeController::class, 'usersidsort'])->name('admin#home#idsort');
        Route::get('usersnamesort', [AdminHomeController::class, 'usersnamesort'])->name('admin#home#namesort');
        Route::get('usersemailsort', [AdminHomeController::class, 'usersemailsort'])->name('admin#home#emailsort');
        Route::get('usersrolesort', [AdminHomeController::class, 'usersrolesort'])->name('admin#home#rolesort');
        Route::get('usersdelete/{id}', [AdminHomeController::class, 'usersdelete'])->name('admin#home#delete');
        Route::get('userspromote/{id}', [AdminHomeController::class, 'userspromote'])->name('admin#home#promote');
        Route::get('usersdowngrade/{id}', [AdminHomeController::class, 'usersdowngrade'])->name('admin#home#downgrade');

        //search box

        Route::prefix('ajax')->group(function () {
            Route::get('anime/search/{key}', [AdminHomeController::class, 'animeSearch'])->name('anime#search');
            Route::get('movie/search/{key}', [AdminHomeController::class, 'movieSearch'])->name('movie#search');
        });

        // admin homepage anime

        Route::get('animehomepage', [AdminAnimeHomeController::class, 'adminAnimeHome'])->name('admin#anime#home');
        Route::get('animesidsort', [AdminAnimeHomeController::class, 'animesidsort'])->name('admin#anime#home#idsort');
        Route::get('animestitlesort', [AdminAnimeHomeController::class, 'animestitlesort'])->name('admin#anime#home#titlesort');
        Route::post('animesgenresort', [AdminAnimeHomeController::class, 'animesgenresort'])->name('admin#anime#home#genresort');
        Route::get('animesepisodeadd/{id}', [AdminAnimeHomeController::class, 'animesepisodeadd'])->name('admin#anime#home#episodeadd');
        Route::post('animesepisodeaddnew', [AdminAnimeHomeController::class, 'animesepisodeaddnew'])->name('admin#anime#home#episodeaddnew');
        Route::post('animesepisodeaddnewbatch', [AdminAnimeHomeController::class, 'animesepisodeaddnewbatch'])->name('admin#anime#home#episodeaddnew#batch');
        Route::get('animesview/{id}', [AdminAnimeHomeController::class, 'animesview'])->name('admin#anime#home#view');
        Route::get('animesedit/{id}', [AdminAnimeHomeController::class, 'animesedit'])->name('admin#anime#home#edit');
        Route::post('animesupdate/{image}', [AdminAnimeHomeController::class, 'animesupdate'])->name('admin#anime#home#update');
        Route::get('animesdelete/{id}', [AdminAnimeHomeController::class, 'animesdelete'])->name('admin#anime#home#delete');

        // admin homepage episode

        Route::get('episodehomepage', [AdminEpisodeHomeController::class, 'adminEpisodeHome'])->name('admin#episode#home');
        Route::get('episodesidsort', [AdminEpisodeHomeController::class, 'episodesidsort'])->name('admin#episode#home#idsort');
        Route::get('episodestitlesort', [AdminEpisodeHomeController::class, 'episodestitlesort'])->name('admin#episode#home#titlesort');
        Route::get('episodesdelete/{id}/{number}', [AdminEpisodeHomeController::class, 'episodesdelete'])->name('admin#episode#home#delete');

        // admin homepage movie
        Route::get('moviehomepage', [AdminMovieHomeController::class, 'adminMovieHome'])->name('admin#movie#home');
        Route::get('moviesidsort', [AdminMovieHomeController::class, 'moviesidsort'])->name('admin#movie#home#idsort');
        Route::get('moviestitlesort', [AdminMovieHomeController::class, 'moviestitlesort'])->name('admin#movie#home#titlesort');
        Route::post('moviesgenresort', [AdminMovieHomeController::class, 'moviesgenresort'])->name('admin#movie#home#genresort');
        Route::get('moviesview/{id}', [AdminMovieHomeController::class, 'moviesview'])->name('admin#movie#home#view');
        Route::get('moviesedit/{id}', [AdminMovieHomeController::class, 'moviesedit'])->name('admin#movie#home#edit');
        Route::post('moviesupdate/{image}', [AdminMovieHomeController::class, 'moviesupdate'])->name('admin#movie#home#update');
        Route::get('moviesdelete/{id}', [AdminMovieHomeController::class, 'moviesdelete'])->name('admin#movie#home#delete');

        // admin homepage genre

        Route::get('genrehomepage', [AdminGenreHomeController::class, 'adminGenreHome'])->name('admin#genre#home');
        Route::get('genresidsort', [AdminGenreHomeController::class, 'genresidsort'])->name('admin#genre#home#idsort');
        Route::get('genresnamesort', [AdminGenreHomeController::class, 'genresnamesort'])->name('admin#genre#home#namesort');
        Route::get('genresedit/{id}', [AdminGenreHomeController::class, 'genresedit'])->name('admin#genre#home#edit');
        Route::post('genresupdate', [AdminGenreHomeController::class, 'genresupdate'])->name('admin#genre#home#update');
        Route::get('genresdelete/{id}', [AdminGenreHomeController::class, 'genresdelete'])->name('admin#genre#home#delete');

        // admin homepage bookmark
        Route::get('bookmarkhomepage', [AdminBookmarkHomeController::class, 'adminBookmarkHome'])->name('admin#bookmark#home');
        Route::get('bookmarksidsort', [AdminBookmarkHomeController::class, 'bookmarksidsort'])->name('admin#bookmark#home#idsort');
        Route::get('bookmarksusernamesort', [AdminBookmarkHomeController::class, 'bookmarksusernamesort'])->name('admin#bookmark#home#usernamesort');
        Route::get('bookmarksanimenamesort', [AdminBookmarkHomeController::class, 'bookmarksanimenamesort'])->name('admin#bookmark#home#animenamesort');
        Route::get('bookmarksview/{id}', [AdminBookmarkHomeController::class, 'bookmarksview'])->name('admin#bookmark#home#view');
        Route::get('bookmarksdelete/{id}', [AdminBookmarkHomeController::class, 'bookmarksdelete'])->name('admin#bookmark#home#delete');

        // admin homepage comment
        Route::get('commenthomepage', [AdminCommentHomeController::class, 'adminCommentHome'])->name('admin#comment#home');
        Route::get('commentsidsort', [AdminCommentHomeController::class, 'commentsidsort'])->name('admin#comment#home#idsort');
        Route::get('commentsusernamesort', [AdminCommentHomeController::class, 'commentsusernamesort'])->name('admin#comment#home#usernamesort');
        Route::get('commentsanimenamesort', [AdminCommentHomeController::class, 'commentsanimenamesort'])->name('admin#comment#home#animenamesort');
        Route::get('commentsview/{id}', [AdminCommentHomeController::class, 'commentsview'])->name('admin#comment#home#view');
        Route::get('commentsdelete/{id}', [AdminCommentHomeController::class, 'commentsdelete'])->name('admin#comment#home#delete');

        // admin add new anime

        Route::get('addnewanime', [AnimeController::class, 'newAnime'])->name('admin#add#anime');
        Route::post('addnewanime/create', [AnimeController::class, 'createAnime'])->name('admin#create#anime');

        // admin add new movie
        Route::get('addnewmovie', [MovieController::class, 'newMovie'])->name('admin#add#movie');
        Route::post('addnewmovie/create', [MovieController::class, 'createMovie'])->name('admin#create#movie');

        // admin add new genre

        Route::get('addnewgenre', [GenreController::class, 'newGenre'])->name('admin#add#genre');
        Route::post('addnewgenre/create', [GenreController::class, 'createGenre'])->name('admin#create#genre');
    });
});