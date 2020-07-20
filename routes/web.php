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
    ->middleware('auth')
    ->group(function () {


        /* Route::get('test-acl', function () {
            dd(auth()->user()->permissions());
        }); */


        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Role x User///////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('users/{id}/role/{idRole}/detach', "ACL\RoleUserController@detachRolesUser")->name('users.role.detach');
        Route::post('users/{id}/roles/store', "ACL\RoleUserController@attachRolesUser")->name('users.roles.attach');
        Route::any('users/{id}/roles/create', "ACL\RoleUserController@rolesAvailable")->name('users.roles.available');
        Route::get('users/{id}/roles', "ACL\RoleUserController@roles")->name('users.roles');
        Route::get('roles/{id}/users', "ACL\RoleUserController@users")->name('roles.users');



        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Permission x Roles/////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('roles/{id}/permission/{idPermission}/detach', "ACL\PermissionRoleController@detachPermissionsRole")->name('roles.permission.detach');
        Route::post('roles/{id}/permissions/store', "ACL\PermissionRoleController@attachPermissionsRole")->name('roles.permissions.attach');
        //Route::any('profile/{id}/permissions/create/search', "ACL\PermissionRoleController@filterPermissionsAvailable")->name('roles.permissions.available.search');
        Route::any('roles/{id}/permissions/create', "ACL\PermissionRoleController@permissionsAvailable")->name('roles.permissions.available');
        Route::get('roles/{id}/permissions', "ACL\PermissionRoleController@permissions")->name('roles.permissions');
        Route::get('permissions/{id}/role', "ACL\PermissionRoleController@roles")->name('permissions.roles');




        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Rotas Tenants//////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('tenants/search', 'TenantController@search')->name("tenants.search");
        Route::resource('tenants', 'TenantController');





        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Rotas Mesas//////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('tables/search', 'TableController@search')->name("tables.search");
        Route::resource('tables', 'TableController');





        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Produtos x Categorias/////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('products/{id}/category/{idCategory}/detach', "CategoryProductController@detachCategoriesProduct")->name('products.category.detach');
        Route::post('products/{id}/categories/store', "CategoryProductController@attachCategoriesProduct")->name('products.categories.attach');
        Route::any('products/{id}/categories/create', "CategoryProductController@categoriesAvailable")->name('products.categories.available');
        Route::get('products/{id}/categories', "CategoryProductController@categories")->name('products.categories');
        Route::get('categories/{id}/products', "CategoryProductController@products")->name('categories.products');





        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Rotas Produtos/////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('products/search', 'ProductController@search')->name("products.search");
        Route::resource('products', 'ProductController');

        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Rotas Categorias/////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('categories/search', 'CategoryController@search')->name("categories.search");
        Route::resource('categories', 'CategoryController');


        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Rotas Usuários//////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('users/search', 'UserController@search')->name("users.search");
        Route::resource('users', 'UserController');




        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Plan x Profile/////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('plans/{id}/profile/{idProfile}/detach', "ACL\PlanProfileController@detachProfilePlan")->name('plans.profile.detach');
        Route::post('plans/{id}/profiles/store', "ACL\PlanProfileController@attachProfilesPlan")->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', "ACL\PlanProfileController@profilesAvailable")->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', "ACL\PlanProfileController@profiles")->name('plans.profiles');
        Route::get('profiles/{id}/plans', "ACL\PlanProfileController@plans")->name('profiles.plans');


        ////////////////////////////////////////////////////////////////////////
        ///////////////////////Plan x Roles/////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('plans/{id}/role/{idProfile}/detach', "ACL\PlanProfileController@detachProfilePlan")->name('plans.role.detach');
        Route::post('plans/{id}/roles/store', "ACL\PlanProfileController@attachProfilesPlan")->name('plans.roles.attach');
        Route::any('plans/{id}/roles/create', "ACL\PlanProfileController@rolesAvailable")->name('plans.roles.available');
        Route::get('plans/{id}/roles', "ACL\PlanProfileController@roles")->name('plans.roles');
        Route::get('roles/{id}/plans', "ACL\PlanProfileController@plans")->name('roles.plans');



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
        ///////////////////////Routes Roles//////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::any('roles/search', 'ACL\RoleController@search')->name("roles.search");
        Route::resource('roles', 'ACL\RoleController');



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



//////////////////////////////////////////////////////////////////////////////
///////////////////////////////Site///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
Route::get('/plan/{url}', 'Site\SiteController@plan')->name("plan.subscription");
Route::get('/', 'Site\SiteController@index')->name("site.home");



//////////////////////////////////////////////////////////////////////////////
///////////////////////Rotas de Autenticação//////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
Auth::routes(['register' => true]);

//Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
