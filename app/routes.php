<?php

use \Dropbox as dbx;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Home Page
Route::get('/', 'LoginController@displayHome');

// Create Account + Dropbox OAuth
Route::get('/auth', 'LoginController@authorize');
Route::get('/create-account', 'LoginController@startAuth');
Route::post('signup-process', 'LoginController@createAccount');

// Login
Route::get('/login', 'LoginController@loginView');
Route::post('login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

// View Profile
Route::get('/user/{username}', 'HomeController@viewUserProfile');

// My Profile
Route::get('home', [
    'before' => 'auth',
    'uses' => 'HomeController@viewMyProfile'
]);
Route::get('/profile', [
    'before' => 'auth',
    'uses' => 'HomeController@viewMyProfile'
]);

// Favorites
Route::get('/favorites', [
    'before' => 'auth',
    'uses' => 'FavoritesController@viewFavorites'
]);
Route::get('/favorites/add/{username}', [
    'before' => 'auth',
    'uses' => 'FavoritesController@addFavorite'
]);
Route::get('/favorites/remove/{username}', [
    'before' => 'auth',
    'uses' => 'FavoritesController@removeFavorite'
]);