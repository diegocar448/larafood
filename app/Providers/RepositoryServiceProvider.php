<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    TenantRepositoryInterface,
    CategoryRepositoryInterface
};
use App\Repositories\{
    TenantRepository,
    CategoryRepository
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
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
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
