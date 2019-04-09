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
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::middleware('auth:admin')->group(function (){
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

        Route::get('/import', 'Admin\ImportController@index')->name('admin.import');

        Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');

        Route::get('/classes', 'Admin\SchoolClassController@index')->name('admin.classes');
        Route::put('/classes', 'Admin\SchoolClassController@store');

        Route::post('/import', 'Admin\ImportController@store');
    });
});
