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

Route::get('/api/groups', 'GroupController@apiGroup');
Route::post('/api/group/add', 'GroupController@addGroup');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/projects', 'GroupController@index')->name('projects');
Route::get('/project/{id}', 'GroupController@project')->name('project');