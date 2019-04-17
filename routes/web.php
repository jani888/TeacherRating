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
    return redirect('login');
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/rate', 'RatingController@create');

Route::get('/teacher/{teacher}', 'TeacherController@show');

Route::prefix('admin')->group(function (){
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.auth.login');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::middleware('auth:admin')->group(function (){
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

        Route::get('/import', 'Admin\ImportController@index')->name('admin.import');

        Route::get('/results', 'Admin\ResultsController@index')->name('admin.results');
        Route::get('/results/export', 'Admin\ResultsController@export')->name('admin.export-results');

        Route::get('/admins', 'Admin\AdminController@index')->name('admin.admins');
        Route::get('/admins/create', 'Admin\AdminController@create')->name('admin.admins.create');
        Route::post('/admins', 'Admin\AdminController@store')->name('admin.admins.store');
        Route::get('/admins/{admin}/edit', 'Admin\AdminController@edit')->name('admin.admins.edit');
        Route::delete('/admins/{admin}', 'Admin\AdminController@delete')->name('admin.admins.delete');
        Route::put('/admins/{admin}', 'Admin\AdminController@update')->name('admin.admins.update');

        Route::get('/rating_types', 'Admin\RatingTypeController@index')->name('admin.rating_types');
        Route::post('/rating_types', 'Admin\RatingTypeController@store');
        Route::delete('/rating_types/{ratingType}', 'Admin\RatingTypeController@delete')->name('admin.rating_types.delete');
        Route::put('/rating_types/{ratingType}', 'Admin\RatingTypeController@update')->name('admin.rating_types.update');

        Route::get('/classes', 'Admin\SchoolClassController@index')->name('admin.classes');
        Route::put('/classes', 'Admin\SchoolClassController@store');

        Route::post('/import', 'Admin\ImportController@store');
    });
});
