<?php

use Illuminate\Support\Facades\Route;

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
Route::get('setlocale/{locale}', function ($locale) {
	if (in_array($locale, Config::get('app.locales'))) {
		Session::put('locale', $locale);
	}
	return redirect()->back();
});


Route::get('rigasvilni/test', 'RigasVilniController@index');
Route::get('rigasvilni/test/store', 'RigasVilniController@store');
Route::get('rigasvilni/test/json/{status}', 'RigasVilniController@getData');

