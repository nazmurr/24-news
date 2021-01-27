<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composers([
            'App\Http\ViewComposers\HeaderFooterComposer@footerCompose' => 'includes.footer',
            'App\Http\ViewComposers\HeaderFooterComposer@headerCompose' => 'includes.header'
        ]);
    }
}
