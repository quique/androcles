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
    return View::make('hello')->with('title', "Androcles - Un CMS para protectoras de animales");
});

Route::group(array('prefix' => 'animals'), function()
{
    // Bind route parameters.
    Route::pattern('status', '[a-z\-]+');
    //Route::pattern('species', '[0-9]+');
    Route::pattern('species', '[a-z\-]+');
    Route::model('animal','Animal');
    // Show pages
    Route::get('/', 'AnimalsController@read');
    Route::get('/create', 'AnimalsController@create');
    Route::get('/{status}', 'AnimalsController@readStatus');
    Route::get('/{status}/{species}', 'AnimalsController@readStatusSpecies');
    Route::get('/{animal}', 'AnimalsController@readSingle');
    Route::get('/{animal}/update', 'AnimalsController@update');
    Route::get('{animal}/delete', 'AnimalsController@delete');
    // Handle form submissions.
    Route::post('/create', ['before'=>'csrf', 'uses' => 'AnimalsController@saveCreate']);
    Route::post('/{animal}/update', ['before'=>'csrf', 'uses' => 'AnimalsController@saveUpdate']);
    Route::post('/{animal}/delete', ['before'=>'csrf', 'uses' => 'AnimalsController@doDelete']);
});

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
