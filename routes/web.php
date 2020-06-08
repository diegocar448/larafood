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

        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Plan x Profile/////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('plans/{id}/profile/{idProfile}/detach', "ACL\PlanProfileController@detachProfilePlan")->name('plans.profile.detach');
        Route::post('plans/{id}/profiles/store', "ACL\PlanProfileController@attachProfilesPlan")->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', "ACL\PlanProfileController@profilesAvailable")->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', "ACL\PlanProfileController@profiles")->name('plans.profiles');
        Route::get('profiles/{id}/plans', "ACL\PlanProfileController@plans")->name('profiles.plans');
        //Route::any('profile/{id}/plans/create/search', "ACL\PlanProfileController@filterplansAvailable")->name('plans.plans.available.search');


        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Permission x Profile/////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('profiles/{id}/permission/{idPermission}/detach', "ACL\PermissionProfileController@detachPermissionsProfile")->name('profiles.permission.detach');
        Route::post('profiles/{id}/permissions/store', "ACL\PermissionProfileController@attachPermissionsProfile")->name('profiles.permissions.attach');
        //Route::any('profile/{id}/permissions/create/search', "ACL\PermissionProfileController@filterPermissionsAvailable")->name('profiles.permissions.available.search');
        Route::any('profiles/{id}/permissions/create', "ACL\PermissionProfileController@permissionsAvailable")->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', "ACL\PermissionProfileController@permissions")->name('profiles.permissions');
        Route::get('permissions/{id}/profile', "ACL\PermissionProfileController@profiles")->name('permissions.profiles');




        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Routes Permissions///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('permissions/search', 'ACL\PermissionController@search')->name("permissions.search");
        Route::resource('permissions', 'ACL\PermissionController');

        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Routes Profiles//////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('profiles/search', 'ACL\ProfileController@search')->name("profiles.search");
        Route::resource('profiles', 'ACL\ProfileController');



        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Routes Details Plans/////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
        Route::get('plans/{url}/details/{idDetail}/show', 'DetailPlanController@show')->name('details.plan.show');
        Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
        Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
        Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
        Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
        Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');





        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Routes Plans//////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get("plans/create", "PlanController@create")->name('plans.create');
        Route::put("plans/{url}/update", "PlanController@update")->name('plans.update');
        Route::get("plans/{url}/edit", "PlanController@edit")->name('plans.edit');
        Route::any("plans/search", "PlanController@search")->name('plans.search');
        Route::delete("plans/{url}", "PlanController@destroy")->name('plans.destroy');
        Route::get("plans/{url}", "PlanController@show")->name('plans.show');
        Route::get("plans", "PlanController@index")->name('plans.index');
        Route::post("plans", "PlanController@store")->name('plans.store');


        //////////////////////////////////////////////////////////////////////////////
        ///////////////////////Routes Home Dashboard//////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////
        Route::get("/", "PlanController@index")->name('admin.index');
    });

//Route::resource("admin/plans", "Admin\PlanController@index")->name('plans.index');


/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', 'Site\SiteController@index')->name("site.home");



//////////////////////////////////////////////////////////////////////////////
///////////////////////Rotas de Autenticação//////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
Auth::routes(['register' => false]);
//Auth::routes();



//Route::get('/home', 'HomeController@index')->name('home');
