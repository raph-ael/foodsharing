<?php

namespace Foodsharing\TranslationManager;

use Closure;

class RouteAfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* @var $translationManager Manager */
        $translationManager = \App::make(ManagerServiceProvider::PACKAGE);

        $response = $next($request);

        $translationManager->afterRoute($request, $response);

        return $response;
    }
}
