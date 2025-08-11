<?php

namespace App\Providers;

use App\Models\Surat;
use App\Policies\SuratPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        Surat::class => SuratPolicy::class,
    ];
}
