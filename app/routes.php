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
Route::get('/animals/{animal}/delete', 'AnimalsController@delete');
Route::post('/animals/{animal}/delete', ['before'=>'csrf', 'uses' => 'AnimalsController@doDelete']);


Route::group(array('prefix' => 'news'), function()
{
    // Bind route parameters.
    Route::model('news', 'News');
    // Show pages.
    Route::get('/', 'NewsController@index');
    Route::get('/create', 'NewsController@create');
    Route::get('/{news}', 'NewsController@show');
    Route::get('/edit/{news}', 'NewsController@edit');
    Route::get('/delete/{news}', 'NewsController@delete');
    // Handle form submissions.
    Route::post('/create', ['before'=>'csrf', 'uses' =>'NewsController@handleCreate']);
    Route::post('/edit', ['before'=>'csrf', 'uses' =>'NewsController@handleEdit']);
    Route::post('/delete', ['before'=>'csrf', 'uses' =>'NewsController@handleDelete']);
});