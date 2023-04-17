<?php

namespace App\Http\Middleware;

use Closure;

class CheckPassword
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
        if($request->api_password !== env('API_PASSWORD', "Oyp4KlpnLhYQXJ8M")){
            return response()->json(["message"=>"Not Authenticated"]);
        }
        return $next($request);
    }
}
