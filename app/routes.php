<?php

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

Route::get('/', function()
{
	return View::make('hello');
});

Route::pattern('text_slug', '[a-z\-]+');
Route::pattern('id_slug', '[0-9]+');

Route::get('/animals', 'AnimalsController@read');
Route::get('/animals/create', 'AnimalsController@create');
Route::post('/animals/create', ['before'=>'csrf', 'uses' => 'AnimalsController@saveCreate']);
Route::get('/animals/{id_slug}', 'AnimalsController@readSingle');
Route::model('animal','Animal');
Route::get('/animals/{animal}/update', 'AnimalsController@update');
Route::post('/animals/{animal}/update', ['before'=>'csrf', 'uses' => 'AnimalsController@saveUpdate']);
Route::get('/animals/{text_slug}', 'AnimalsController@readStatus');
Route::get('/animals/{animal}/delete','AnimalsController@delete');
Route::post('/animals/{animal}/delete','AnimalsController@doDelete');
