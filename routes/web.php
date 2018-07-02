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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('socket', 'SocketController@index');
Route::post('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writemessage');
Route::post('join_group/send','MessagesController@postSend');
Route::get('add_group','MessagesController@getAddGroup');
Route::post('add_group','MessagesController@postAddGroup');
ROute::get('join_group/{channal}','MessagesController@joinGroup');

