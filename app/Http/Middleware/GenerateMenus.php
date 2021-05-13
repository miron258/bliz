<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin\Menu;
use App\Models\API\Admin\MenuItems;
use Illuminate\Support\Facades\View;

class GenerateMenus {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //Главное навигационное меню вверху сайта
        return $next($request);
    }

}
