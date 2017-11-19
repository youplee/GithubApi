<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
     Route::post('/registerUser','Auth\RegisterController@create');

Auth::routes();


Route::group([ 'middleware' => ['verify']], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('user','UserController');
    Route::resource('profil','ProfilController');
    Route::post('searchgithub', 'SearchController@searchGithub');
    Route::get('loadData', 'LanguageController@loadData');
    Route::get('/loadProfil', 'UserController@loadProfil');
    Route::post('ajoutFavori', 'CatalogueController@ajoutFavori');
    Route::post('sendEmailFavori', 'CatalogueController@sendEmailFavori');
    Route::post('retraitFavori', 'CatalogueController@retraitFavori');
    Route::post('sendEmailRetraitFavori', 'CatalogueController@sendEmailRetraitFavori');
   Route::post('retraitFavoriFromProfil', 'CatalogueController@retraitFavoriFromProfil');
});

Route::get('/logout','Auth\LoginController@logout');

Route::group([ 'middleware' => ['verifyLogin']], function () {
    
    //  Route::post('/login','auth\AuthController@login');
     Route::post('/login','Auth\LoginController@connexion');
    
 });
