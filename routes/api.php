<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('users', 'UserController@store');
Route::get('users/{id}', 'UserController@show');

Route::get('donasi', 'DonasiController@index');
Route::post('donasi', 'DonasiController@store');
Route::get('donasi/{id}', 'DonasiController@show');
Route::get('donasi/kategori/{kategori}', 'DonasiController@getDonasiByKategori');
Route::get('donasi/tingkatan/{tingkatan}', 'DonasiController@getDonasiByTingkatan');
Route::get('donasi-pilihan', 'DonasiController@getDonasiPilihan');

Route::post('donasi/{id}/tambah', 'UserDonasiController@store');
Route::get('donasi/{donasiId}/daftar-donatur', 'UserDonasiController@getDaftarDonatur');
Route::get('users/{userId}/daftar-donasi', 'UserDonasiController@getDaftarDonasi');
