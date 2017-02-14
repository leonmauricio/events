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

Route::get('/', 'HomeController@index');

Route::resource('events', 'EventController');

Route::resource('guests', 'GuestController', ['only' => [
    'store', 'update'
]]);

Route::get('/thanks', 'ThanksController@index');

Route::get('/unsubscribe/{invitation_id}', 'UnsubscribeController@update');
Route::get('/subscribe/{invitation_id}', 'SubscribeController@update');

Route::get('/export/{id}', 'ExportController@create');

Route::get('/public/events', 'PublicEventsController@index');

Route::get('/mailer/{id}', 'MailerController@index');
Route::post('/mailer/{id}', 'MailerController@store');
