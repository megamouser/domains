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
Route::get("phpinfo", function() 
{
    phpinfo();
});

// Route::post('/domains/getDomains', 'DomainController@getDomains');
// Route::get('/domains/listing', 'DomainController@listing');
Route::get('/domains/import', 'DomainController@import');
Route::post('/domains/import/settings', 'DomainController@settings');
// Route::get('/domains/search', 'DomainController@search');
Route::get('/domains/get-options/{id}', 'DomainController@getOptions');
// Route::post('/domains/get-options', 'DomainController@getOptions');

Route::get('options/showall', 'OptionController@showAll');
Route::resources([
    'domains' => 'DomainController',
    'options' => 'OptionController',
    'statistic' => 'StatisticController'
]);
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

