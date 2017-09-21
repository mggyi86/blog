<?php

namespace App\Providers;

use App\Views\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', NavigationComposer::class);
        // view()->composer('layouts.sidebar', function($view) {
        //     $popularPosts = Post::published()->popular()->take(3)->get();

        //     return $view->with('popularPosts', $popularPosts);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
