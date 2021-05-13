<?php

namespace App\Providers;

use App\Products;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Validator;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });

        Validator::extend('cyrillic', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[А-Яа-яЁё]/u', $value);
        });
    }

}
