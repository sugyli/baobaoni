<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth;

class VerificationNovel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = request()->url();
        $weburi = get_sys_set('weburi');
        $wapuri = get_sys_set('wapuri');
        if(str_contains($url, $weburi) || str_contains($url, $wapuri)){
            return $next($request);
        }
        return redirect('/', 301);

    }
}
