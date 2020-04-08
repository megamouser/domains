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

Route::get('/domains/statistic', 'DomainController@statistic');
Route::get('/domains/import', 'DomainController@import');
Route::post('/domains/import/settings', 'DomainController@importSettings');

Route::get('/domains/export', 'DomainController@export');
Route::get('/domains/export/settings', 'DomainController@exportSettings');

// Route::get('options/showall', 'OptionController@showAll');

Route::get('/domains/{domain}/getparams', 'DomainController@getparams');

Route::resources([
    'domains' => 'DomainController',
    // 'options' => 'OptionController',
    // 'statistic' => 'StatisticController'
]);



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get("/settings", 'HomeController@settings');

Route::get('phpinfo', function() 
{
    phpinfo();
});