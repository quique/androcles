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

// See http://laravel.com/docs/routing


Route::get('/',     ['as'=>'home',      'uses' => 'HomeController@index']);


Route::group(array('prefix' => 'animals'), function()
{
    // Bind route parameters.
    Route::pattern('status', '[a-z\-]+');
    Route::pattern('species', '[a-z\-]+');
    Route::model('animal','Animal');
    // Show pages
    Route::get('/',                     ['as'=>'animals.index',                               'uses' => 'AnimalsController@index']);
    Route::get('/create',               ['as'=>'animals.create',  'before'=>'hasAccess',      'uses' => 'AnimalsController@create']);
    Route::get('/{status}',             ['as'=>'animals.status',                              'uses' => 'AnimalsController@readStatus']);
    Route::get('/{status}/{species}',   ['as'=>'animals.status.species',                      'uses' => 'AnimalsController@readStatusSpecies']);
    Route::get('/{animal}',             ['as'=>'animals.show',                                'uses' => 'AnimalsController@show']);
    Route::get('/{animal}/edit',        ['as'=>'animals.edit',    'before'=>'hasAccess',      'uses' => 'AnimalsController@edit']);
    Route::get('/{animal}/delete',      ['as'=>'animals.delete',  'before'=>'hasAccess',      'uses' => 'AnimalsController@delete']);
    // Handle form submissions.
    Route::post('/store',               ['as'=>'animals.store',   'before'=>'csrf|hasAccess', 'uses' => 'AnimalsController@store']);
    Route::post('/{animal}/update',     ['as'=>'animals.update',  'before'=>'csrf|hasAccess', 'uses' => 'AnimalsController@update']);
    Route::post('/{animal}/destroy',    ['as'=>'animals.destroy', 'before'=>'csrf|hasAccess', 'uses' => 'AnimalsController@destroy']);
});


Route::group(array('prefix' => 'news'), function()
{
    // Bind route parameters.
    Route::model('news', 'News');
    // Show pages.
    Route::get('/',                 ['as'=>'news.index',                               'uses' => 'NewsController@index']);
    Route::get('/create',           ['as'=>'news.create',  'before'=>'hasAccess',      'uses' => 'NewsController@create']);
    Route::get('/{news}',           ['as'=>'news.show',                                'uses' => 'NewsController@show']);
    Route::get('/{news}/edit',      ['as'=>'news.edit',    'before'=>'hasAccess',      'uses' => 'NewsController@edit']);
    Route::get('/{news}/delete',    ['as'=>'news.delete',  'before'=>'hasAccess',      'uses' => 'NewsController@delete']);
    // Handle form submissions.
    Route::post('/store',           ['as'=>'news.store',   'before'=>'csrf|hasAccess', 'uses' => 'NewsController@store']);
    Route::post('/{news}/update',   ['as'=>'news.update',  'before'=>'csrf|hasAccess', 'uses' => 'NewsController@update']);
    Route::post('/{news}/destroy',  ['as'=>'news.destroy', 'before'=>'csrf|hasAccess', 'uses' => 'NewsController@destroy']);
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


Route::group(array('prefix' => 'volunteers'), function()
{
    // Bind route parameters.
    Route::model('volunteer', 'Volunteer');
    // Show pages.  csrf|auth checks are in the constructor in VolunteersController.
    Route::get('/',                     ['as'=>'volunteers.index',   'uses'=>'VolunteersController@index']);
//  Route::get('/create',               ['as'=>'volunteers.create',  'uses'=>'VolunteersController@create']);
    Route::get('/{volunteer}',          ['as'=>'volunteers.show',    'uses'=>'VolunteersController@show']);
    Route::get('/{volunteer}/edit',     ['as'=>'volunteers.edit',    'uses'=>'VolunteersController@edit']);
//  Route::get('/{volunteer}/delete',   ['as'=>'volunteers.delete',  'uses'=>'VolunteersController@delete']);
    // Handle form submissions.
//  Route::post('/store',               ['as'=>'volunteers.store',   'uses'=>'VolunteersController@store']);
    Route::post('/{volunteer}/update',  ['as'=>'volunteers.update',  'uses'=>'VolunteersController@update']);
//  Route::post('/{volunteer}/destroy', ['as'=>'volunteers.destroy', 'uses'=>'VolunteersController@destroy']);
});



Route::group(array('prefix' => 'info'), function()
{
    Route::get('/about', function() { return Response::view('info/about', ['title' => 'Quiénes somos']); });
    Route::get('/a-day', function() { return Response::view('info/aday',  ['title' => 'Un día en la protectora']); });
    Route::get('/get-involved', function() { return Response::view('info/get-involved',  ['title' => 'Cómo ayudar']); });
    Route::get('/contact', function() { return Response::view('info/contact',  ['title' => 'Contacto']); });
});
