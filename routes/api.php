<?php





Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::post("/sanctum/token", "Api\Auth\AuthClientController@auth");
    Route::get("/me", "Api\Auth\AuthClientController@me");
    Route::get("/logout", "Api\Auth\AuthClientController@logout");
});


Route::group([
    "prefix" => "v1",
    "namespace" => "Api"
], function () {

    Route::get('/tenants/{uuid}', "TenantApiController@show");
    Route::get('/tenants', "TenantApiController@index");

    Route::get('/categories/{identify}', "CategoryApiController@show");
    Route::get('/categories', "CategoryApiController@categoriesByTenant");

    Route::get('/tables/{identify}', "TableApiController@show");
    Route::get('/tables', "TableApiController@tablesByTenant");

    Route::get("/products/{identify}", "ProductApiController@show");
    Route::get("/products", "ProductApiController@productsByTenant");

    //////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////Cadastrar novo Cliente(Client)///////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////
    Route::post("/client", "Auth\RegisterController@store");
});


Route::group([
    "prefix" => "v2",
    "namespace" => "Api"
], function () {

    Route::get('/tenants/{uuid}', "TenantApiController@show");
    Route::get('/tenants', "TenantApiController@index");

    Route::get('/categories/{url}', "CategoryApiController@show");
    Route::get('/categories', "CategoryApiController@categoriesByTenant");

    Route::get('/tables/{identify}', "TableApiController@show");
    Route::get('/tables', "TableApiController@tablesByTenant");

    Route::get("/products/{flag}", "ProductApiController@show");
    Route::get("/products", "ProductApiController@productsByTenant");

    Route::post("/orders", "OrderApiController@store");
    Route::get("/orders/{identify}", "OrderApiController@show");
});
