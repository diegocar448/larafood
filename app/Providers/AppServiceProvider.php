<?php

namespace App\Providers;

use App\Models\{
    Category,
    Plan,
    Tenant,
    Product,
    Client,
    Table
};
use App\Observers\{
    PlanObserver,
    TenantObserver,
    CategoryObserver,
    ProductObserver,
    TableObserver,
    ClientObserver
};

use App\Services\TenantService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Table::observe(TableObserver::class);
        Client::observe(ClientObserver::class);
    }
}
