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

Route::get('/', ['as'=>'home', function()
{
    return View::make('hello')->with('title', "Androcles - Un CMS para protectoras de animales");
}]);

Route::group(array('prefix' => 'animals'), function()
{
    // Bind route parameters.
    Route::pattern('status', '[a-z\-]+');
    Route::pattern('species', '[a-z\-]+');
    Route::model('animal','Animal');
    // Show pages
    Route::get('/',                 ['as'=>'animals.index',                              'uses' => 'AnimalsController@read']);
    Route::get('/create',           ['as'=>'animals.create', 'before'=>'hasAccess',      'uses' => 'AnimalsController@create']);
    Route::get('/{status}',         ['as'=>'animals.status',                             'uses' => 'AnimalsController@readStatus']);
    Route::get('/{status}/{species}', ['as'=>'animals.status.species',                   'uses' => 'AnimalsController@readStatusSpecies']);
    Route::get('/{animal}',         ['as'=>'animals.show',                               'uses' => 'AnimalsController@readSingle']);
    Route::get('/{animal}/update',  ['as'=>'animals.edit',   'before'=>'hasAccess',      'uses' => 'AnimalsController@update']);
    Route::get('{animal}/delete',   ['as'=>'animals.remove', 'before'=>'hasAccess',      'uses' => 'AnimalsController@delete']);
    // Handle form submissions.
    Route::post('/create',          ['as'=>'animals.store',  'before'=>'csrf|hasAccess', 'uses' => 'AnimalsController@saveCreate']);
    Route::post('/{animal}/update', ['as'=>'animals.update', 'before'=>'csrf|hasAccess', 'uses' => 'AnimalsController@saveUpdate']);
    Route::post('/{animal}/delete', ['as'=>'animals.delete', 'before'=>'csrf|hasAccess', 'uses' => 'AnimalsController@doDelete']);
});

Route::group(array('prefix' => 'news'), function()
{
    // Bind route parameters.
    Route::model('news', 'News');
    // Show pages.
    Route::get('/',                 ['as'=>'news.index',                              'uses' => 'NewsController@index']);
    Route::get('/create',           ['as'=>'news.create', 'before'=>'hasAccess',      'uses' => 'NewsController@create']);
    Route::get('/{news}',           ['as'=>'news.show',                               'uses' => 'NewsController@show']);
    Route::get('/edit/{news}',      ['as'=>'news.edit',   'before'=>'hasAccess',      'uses' => 'NewsController@edit']);
    Route::get('/delete/{news}',    ['as'=>'news.remove', 'before'=>'hasAccess',      'uses' => 'NewsController@delete']);
    // Handle form submissions.
    Route::post('/create',          ['as'=>'news.store',  'before'=>'csrf|hasAccess', 'uses' => 'NewsController@handleCreate']);
    Route::post('/edit',            ['as'=>'news.update', 'before'=>'csrf|hasAccess', 'uses' => 'NewsController@handleEdit']);
    Route::post('/delete',          ['as'=>'news.delete', 'before'=>'csrf|hasAccess', 'uses' => 'NewsController@handleDelete']);
});


Route::group(array('prefix' => 'users'), function()
{
    // Bind route parameters.
    Route::model('user', 'User');
    // Show pages.
    Route::get('/logout',           ['as' => 'logout',      'uses' => 'UsersController@getLogout']);
    Route::get('/login',            ['as' => 'login',       'uses' => 'UsersController@getLogin']);

    Route::get('/',                 ['as'=>'users.index',   'uses' => 'UsersController@index']);
    Route::get('/create',           ['as'=>'users.create',  'uses' => 'UsersController@create']);
    Route::get('/{user}',           ['as'=>'users.show',    'uses' => 'UsersController@show']);
    Route::get('/{user}/edit',      ['as'=>'users.edit',    'uses' => 'UsersController@edit']);
    Route::get('/{user}/password',  ['as'=>'users.password','uses' => 'UsersController@password']);
    Route::get('/{user}/delete',    ['as'=>'users.delete',  'uses' => 'UsersController@delete']);
    // Handle form submissions.
    Route::post('/login',           ['as'=>'login.post',    'uses' => 'UsersController@postLogin']);
    Route::post('/store',           ['as'=>'users.store',   'uses' => 'UsersController@store']);
    Route::post('{user}/update',    ['as'=>'users.update',  'uses' => 'UsersController@update']);
    Route::post('{user}/passwd',    ['as'=>'users.passwd',  'uses' => 'UsersController@passwd']);
    Route::post('{user}/destroy',   ['as'=>'users.destroy', 'uses' => 'UsersController@destroy']);
});


Route::group(array('prefix' => 'links'), function()
{
    // Bind route parameters.
    Route::model('link', 'Link');
    // Show pages.  csrf|hasAccess tests are in the Controller constructor.
    Route::get('/',                 ['as'=>'links.index',   'uses'=>'LinksController@index']);
    Route::get('/create',           ['as'=>'links.create',  'uses'=>'LinksController@create']);
    Route::get('/{link}',           ['as'=>'links.show',    'uses'=>'LinksController@show']);
    Route::get('/{link}/edit',      ['as'=>'links.edit',    'uses'=>'LinksController@edit']);
    Route::get('/{link}/delete',    ['as'=>'links.delete',  'uses'=>'LinksController@delete']);
    // Handle form submissions.
    Route::post('/store',           ['as'=>'links.store',   'uses'=>'LinksController@store']);
    Route::post('/{link}/update',   ['as'=>'links.update',  'uses'=>'LinksController@update']);
    Route::post('/{link}/destroy',  ['as'=>'links.destroy', 'uses'=>'LinksController@destroy']);
});


Route: Route::controller('password', 'RemindersController');
