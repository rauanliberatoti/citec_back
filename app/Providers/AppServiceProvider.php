<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\CreateRepository;
use App\Repositories\Interface\ICityRepository;
use App\Repositories\Interface\ICreateRepository;
use App\Repositories\Interface\IOrganization;
use App\Repositories\Interface\IPasswordRepository;
use App\Repositories\Interface\IUserRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\PasswordRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerSingleTons();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerSingleTons(): void
    {
        $this->app->singleton(ICityRepository::class, CityRepository::class);
        $this->app->singleton(ICreateRepository::class, CreateRepository::class);
        $this->app->singleton(IPasswordRepository::class, PasswordRepository::class);
        $this->app->singleton(IUserRepository::class, UserRepository::class);
        $this->app->singleton(IOrganization::class, OrganizationRepository::class);
    }
}
