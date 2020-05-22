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

Route::prefix('admin')
    ->namespace('Admin')
    ->group(function () {

        Route::get("plans/create", "PlanController@create")->name('plans.create');
        Route::put("plans/{url}/update", "PlanController@update")->name('plans.update');
        Route::get("plans/{url}/edit", "PlanController@edit")->name('plans.edit');
        Route::any("plans/search", "PlanController@search")->name('plans.search');
        Route::delete("plans/{url}", "PlanController@destroy")->name('plans.destroy');
        Route::get("plans/{url}", "PlanController@show")->name('plans.show');
        Route::get("plans", "PlanController@index")->name('plans.index');
        Route::post("plans", "PlanController@store")->name('plans.store');

        Route::get("/", "Admin\PlanController@index")->name('admin.index');
    });

//Route::resource("admin/plans", "Admin\PlanController@index")->name('plans.index');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
