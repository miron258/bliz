<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;

class DisplayDetection {

    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $agent = new Agent();
        $chunkNum = 6;

        if ($agent->isTablet()) {
            $chunkNum = 4;
        }
        if ($agent->isMobile()) {
            $chunkNum = 2;
        }

        return $chunkNum;
    }

}
