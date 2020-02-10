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

Route::get("phpinfo", function() {
    phpinfo();
});

Route::get("test", function() {
    $domain = \App\Domain::first();
    $options = \App\Option::all();
    $domain->options()->detach($options);
});

Route::get('/', function () {
    return view('home');
});

Route::get('/domains/import', 'DomainController@import');
Route::post('/domains/import/settings', 'DomainController@settings');
Route::get('/domains/search', 'DomainController@search');

Route::resources([
    'domains' => 'DomainController',
]);