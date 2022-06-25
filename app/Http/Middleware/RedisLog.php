<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class RedisLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->fullUrlWithoutQuery(['search']);
        $uri = str_replace("http://localhost:8000", "", $uri);
        $current_date = date("Y-m-d");

        $entry= Redis::hget('log', $uri . ":" .$current_date);

        if(!$entry){
            Redis::hset('log', $uri . ":" .$current_date, 1);
        }else{
            Redis::hincrby('log',  $uri . ":" .$current_date, 1);
        }
        return $next($request);
    }
}
