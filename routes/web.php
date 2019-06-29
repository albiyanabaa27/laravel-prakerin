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

Route::get('/backend', function () {
    return view('backend');
});

Route::get('drashboardfrontend', function () {
    return view('drashboardfrontend');
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
// Route::get('/logout', 'HomeController@index')->name('logout');

// Route::get('kategori','Kategori_Controller@index');
// Route::get('artikel','Artikel_Controller@index');
// Route::get('tag','tag_Controller@index');

Route::group(['prefix'=>'admin','middleware'=>'auth'],
function (){
    Route::get('/', function(){
        return view('backend.index');
    });
    Route::resource('kategori', 'Kategori_Controller');
    Route::resource('tag', 'Tag_Controller');
    Route::resource('artikel', 'Artikel_Controller');
});