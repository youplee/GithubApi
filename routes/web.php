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
    //traitement page d acceuil
    Route::get('/home', 'HomeController@index');
    // traitement recherche github api
    Route::post('searchgithub', 'SearchController@searchGithub');
    // chargement donnee de la page d acceuil
    Route::get('loadData', 'LanguageController@loadData');
    // chargement donnee profil
    Route::get('/loadProfil', 'UserController@loadProfil');
    // ajout favoris
    Route::post('ajoutFavori', 'CatalogueController@ajoutFavori');
    // envoi d email apres l ajout d un favoris
    Route::post('sendEmailFavori', 'CatalogueController@sendEmailFavori');
    // suppression d un favoris depuis la page d acceuil
    Route::post('retraitFavori', 'CatalogueController@retraitFavori');
    // l envoie d un email apres la suppression d un favoris
    Route::post('sendEmailRetraitFavori', 'CatalogueController@sendEmailRetraitFavori');
    // suppression d un favoris depuis la page profil
   Route::post('retraitFavoriFromProfil', 'CatalogueController@retraitFavoriFromProfil');
   // affichage profil
    Route::resource('profil','ProfilController');
});

Route::get('/logout','Auth\LoginController@logout');

Route::group([ 'middleware' => ['verifyLogin']], function () {
    
    //  Route::post('/login','auth\AuthController@login');
     Route::post('/login','Auth\LoginController@connexion');
    
 });
