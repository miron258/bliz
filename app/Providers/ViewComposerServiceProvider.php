<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\HeaderMenuComposer;
use App\Http\ViewComposers\FooterMenuComposer;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
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
        $this->composeHeader();
        $this->composeFooter();
    }


    private function composeHeader()
    {
        View::composer(
            ['layouts.header'], HeaderMenuComposer::class
        );
    }

    private function composeFooter()
    {
        View::composer(
            [ 'layouts.footer'], FooterMenuComposer::class
        );
    }
}
