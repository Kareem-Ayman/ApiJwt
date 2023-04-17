<?php

namespace App\Http\Middleware;

use Closure;

class GetLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale('ar');
        if(isset($request->Lang) && $request->Lang == 'en'){
            app()->setLocale('en');
        }
        return $next($request);
    }
}
