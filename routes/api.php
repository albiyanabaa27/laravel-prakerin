<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::resource('siswa','Api\SiswaController');
// Route::resource('kategori','Api\KategoriController');
// Route::resource('artikel','Api\ArtikelController');
// Route::resource('tag','Api\tagController');

Route::group(['prefix'=>'json'],
function (){
    Route::get('index', 'FrontendController@index');
    // Route::resource('tag', 'Tag_Controller');
    // Route::resource('artikel', 'Artikel_Controller');
});


