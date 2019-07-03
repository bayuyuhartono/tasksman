<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('standings', 'StandingFbController@get_standings');      //bayu.space/api/standings      get
Route::get('events', 'StandingFbController@get_events');            //bayu.space/api/events         get
Route::get('headtohead', 'StandingFbController@get_headtohead');    //bayu.space/api/headtohead     get

Route::get('biodata/{id}', 'BiodataController@show');               //bayu.space/api/biodata/{id}   get
Route::post('biodata', 'BiodataController@store');                  //bayu.space/api/biodata        post
Route::put('biodata/{id}', 'BiodataController@update');             //bayu.space/api/biodata/{id}   put

Route::get('projects', 'ProjectController@index');                  //bayu.space/api/projects       get
Route::get('projects/{id}', 'ProjectController@show');              //bayu.space/api/projects/{id}  get
Route::post('projects', 'ProjectController@store');                 //bayu.space/api/projects       post
Route::put('projects/{id}', 'ProjectController@update');            //bayu.space/api/projects/{id}  put

Route::post('tasks', 'TaskController@store');                       //bayu.space/api/tasks          post
