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

Route::get('archive', function () {
    return view('frontend.archive');
});

Route::get('category', function () {
    return view('frontend.category');
});

Route::get('contact', function () {
    return view('frontend.contact');
});

Route::get('elements', function () {
    return view('frontend.element');
});

Route::get('news-details', function () {
    return view('frontend.news-details');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
