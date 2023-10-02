<?php

namespace App\Providers;

use App\View\Components\ProfileStats;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(
            'components.Profilestats', ProfileStats::class);
    }
}
