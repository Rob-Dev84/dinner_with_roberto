<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectCanonicalUrl
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

        $url = rtrim($request->url(), '/');
        $canonicalUrl = config('app.url') . $request->getPathInfo();

        if ($url !== $canonicalUrl) {
            return redirect($url, 301); // 301: Moved Permanently
        }

        return $next($request);
    }
}
