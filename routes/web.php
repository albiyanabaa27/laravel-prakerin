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

//Route::get('archive', function () {
  //  return view('archive');
//});

Route::get('category', function () {
    return view('category');
});

Route::get('contact', function () {
    return view('contact');
});

Route::get('regular-page', function () {
    return view('regular-page');
});

Route::get('single-blog', function () {
    return view('single-blog');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
