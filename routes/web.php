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

use Illuminate\Support\Facades\Route;

Route::get('/', 'StatisticsController@index')->name('welcome.index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', 'StatisticsController@index')->name('welcome.index');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users/create', 'UserController@store')->name('users.store');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
//us.4

//US.5
Route::get('/users', 'UserController@index')->name('users.list');

//US.7
Route::patch('/users/{user}/block', 'UserController@blockUser')->name('users.blocked')->middleware('auth','admin');
Route::patch('/users/{user}/unblock', 'UserController@unBlockUser')->name('users.unblock')->middleware('auth','admin');
Route::patch('/users/{user}/promote', 'UserController@promoteUser')->name('users.promote')->middleware('auth','admin');
Route::patch('/users/{user}/demote', 'UserController@demoteUser')->name('users.demote')->middleware('auth','admin');

//US.9
Route::get('/me/password','Auth\ChangePasswordController@showForm')->name('passwordchange.form');
Route::patch('/me/password', 'Auth\ChangePasswordController@updatePassword')->name('password.change');

//US.10
Route::get('/me/profile', 'UserController@edit')->name('profile.edit');
Route::put('/me/profile', 'UserController@update')->name('profile.update');
//US.11
Route::get('/profiles', 'UserController@profiles')->name('profiles');
//US.12
Route::get('/me/associates', 'AssociatesController@associatesGet')->name('associates');

//US.13
Route::get('/me/associate-of', 'AssociatesController@associatesOf')->name('associate.of');

//US.14
Route::get('/accounts/{user}', 'AccountsController@accountsUser')->name('accounts.users')->middleware('associateOf');
Route::get('/accounts/{user}/opened', 'AccountsController@opened')->name('users.accounts.opened')->middleware('associateOf');
Route::get('/accounts/{user}/closed', 'AccountsController@closed')->name('users.accounts.closed')->middleware('associateOf');

//US.15
Route::delete('/account/{account}', 'AccountsController@accountDelete')->name('account.delete')->middleware('owner');
Route::patch('/account/{account}/close', 'AccountsController@accountClose')->name('users.accounts.close')->middleware('owner');

//US.16
Route::patch('/account/{account}/reopen', 'AccountsController@accountReopen')->name('users.account.reopen')->middleware('auth','owner');

//US.17
Route::get('/account', 'AccountsController@create')->name('account.create');
Route::post('/account', 'AccountsController@store')->name('account.store');

//US.18
Route::get('/account/{account}', 'AccountsController@edit')->name('account.edit');
Route::put('/account/{account}', 'AccountsController@update')->name('account.update');

//US.20 
Route::get('/movements/{account}', 'MovementsController@movementsAccount')->name('movements.account');

//US.21 
Route::get('/movements/{account}/create', 'MovementsController@movementCreate')->name('movement.create');
Route::post('/movements/{account}/create', 'MovementsController@movementStore')->name('movement.store');
Route::get('/movement/{movement}', 'MovementsController@edit')->name('movement.edit');
Route::put('/movement/{movement}', 'MovementsController@update')->name('movement.update');
Route::delete('/movement/{movement}', 'MovementsController@movementDelete')->name('movement.delete');

//US.23
Route::post('/documents/{movement}', 'MovementsController@documentsMovement')->name('documents.movement');

//US.24
Route::delete('/document/{document}', 'MovementsController@documentDelete')->name('document.delete');

//US.25
Route::get('/document/{document}', 'MovementsController@documentGet')->name('document.get');

//US.26
Route::get('/dashboard/{user}', 'UserController@dashboard')->name('dashboard');

//US.29
Route::post('/me/associates', 'AssociatesController@associatesPost')->name('associates.post');

//US.30
Route::delete('/me/associates/{user}', 'AssociatesController@associatesUserDelete')->name('associates.user.delete');

Route::get('/home', 'HomeController@index')->name('home');
