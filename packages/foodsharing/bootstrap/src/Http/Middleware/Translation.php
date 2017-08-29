<?php
/**
 * Created by PhpStorm.
 * User: foodsharing
 * Date: 28.08.17
 * Time: 11:20
 */

namespace Foodsharing\Bootstrap\Http\Middleware;

use Closure;

class Translation
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

        if(!session('locale'))
        {
            session(['locale' => config('app.fallback_locale')]);
        }

        \App::setLocale(session('locale'));

        return $next($request);
    }
}