<?php

namespace App\Providers;

use App\Models\{
    Category,
    Plan,
    Tenant,
    Product
};
use App\Observers\{
    PlanObserver,
    TenantObserver,
    CategoryObserver,
    ProductObserver
};
use App\Repositories\Contracts\{
    TenantRepositoryInterface,
};
use App\Repositories\{
    TenantRepository,
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
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Criando um bind para o interface TenantRepositoryInterface chamar o repository TenantRepository////////////////////////
        /// A idéia de usa-la é que caso algum dia resolva mudar para outro ORM mudamos para a outra classe usar essa interface////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class,
        );
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
    }
}
