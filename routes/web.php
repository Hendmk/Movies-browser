<?php

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
    return view('welcome', array('title' => 'Start page'));
});

 Route::get('/start', 'Controller@Start');

 Route::get('/getStart', 'Controller@getMovie');
 Route::get('/search/{str}', 'Controller@SearchMovie');
 Route::get('/MovieDetails/{id}', 'Controller@MovieDetails');
 Route::get('/RetriveMovieDetails/{id}', 'Controller@RetriveMovieDetails');
 Route::get('/RetriveMovieCast/{id}', 'Controller@RetriveMovieCast');
 Route::get('/RetriveCastDetails/{id}', 'Controller@RetriveCastDetails');
 Route::get('/CastDetails/{id}', 'Controller@CastDetails');
 Route::get('/MovieCastIn/{id}', 'Controller@MovieCastIn');
 Route::get('/RetriveSimilarMovies/{id}', 'Controller@RetriveSimilarMovies');
 Route::get('/RequestToken','Controller@RequestToken');
 Route::get('/sessionID', 'Controller@sessionID');
 Route::get('/checkIsfavorite/{MovieID}', 'Controller@checkIsfavorite');
 Route::get('/Addfavorite/{MovieID}', 'Controller@Addfavorite');
