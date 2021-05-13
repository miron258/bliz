<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class ImgThumbnailsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Обращаемся к свойству app это и есть наше хранилище в основном родительском классе
        //Service Provider и привязываем регистрируем наш кастомный созданный сервис с необходимым функионалом
        //Указываем название ячейки где будет размещен наш функционал вторым параметром передаем объект с созданным сервисом
        //Здесь мы кладем регистрируем в наш сервис контейнер объект с нашим кастомным классом
        //Регистрируем в наш сервис контейнр созланный сервис
        $this->app->bind('imgThumbnails', 'App\Services\ImgThumbnails');
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
