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

Auth::routes();

Route::get('/', 'MainController@index');
Route::get('/results', 'MainController@results');

Route::get('/questions', 'MainController@getQuestions');

Route::post('/responses', 'MainController@saveResponses');
Route::get('/responses', 'MainController@getResponses');