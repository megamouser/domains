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
Route::get('/custom', function() {
    dd(config('app'));
});

Route::get('/processes', 'ProcessesController@index');
Route::get('/processes/kill/{pid}', 'ProcessesController@kill');

Route::get('/domains/statistic', 'DomainController@statistic');
Route::get('/domains/import', 'DomainController@import');
Route::post('/domains/import/settings', 'DomainController@importSettings');

Route::get('/domains/export', 'DomainController@export');
Route::get('/domains/export/settings', 'DomainController@exportSettings');

// Route::get('options/showall', 'OptionController@showAll');

Route::get('/domains/{domain}/getparams', 'DomainController@getparams');

Route::resources([
    'domains' => 'DomainController',
]);



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/settings', 'HomeController@settings');
Route::get('/settings/delete', 'HomeController@fileDelete');
Route::get('/settings/download', 'HomeController@fileDownload');

Route::get('phpinfo', function() 
{
    phpinfo();
});

Route::get('statistics', 'StatisticController@index');
Route::get('statistics/collect', 'StatisticController@collect');
Route::get('statistics/stopcollect', 'StatisticController@stopcollect');

Route::get('archieve', 'StorageController@index');
Route::get('archieve/store', 'StorageController@store');
Route::post('archieve/extract', 'StorageController@extract');
Route::post('archieve/extractwithoutparams', 'StorageController@extractwithoutparams');

// Route::get('archieve', function() {
//     dd("test");
// });