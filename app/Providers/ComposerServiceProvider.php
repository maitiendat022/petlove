<?php

namespace App\Providers;

use App\Composers\CartComposer;
use App\Composers\CategoryComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        //
        View::composer('client.layouts.navbar', CategoryComposer::class);
        View::composer('client.layouts.navbar', CartComposer::class);
        View::composer('client.shop.cart', CartComposer::class);
        View::composer('client.layouts.content.sidebar_shop', CategoryComposer::class);
        View::composer('client.layouts.content.header_ct', CategoryComposer::class);
    }
}
