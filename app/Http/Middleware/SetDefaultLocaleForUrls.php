<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\URL;

class SetDefaultLocaleForUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->input('geoSlug');

        /* 1. Если locale == NULL */
        if(is_null($locale)) {
            URL::defaults(['locales' => $locale]);
        }

        else {
            view()->share('locale_title', $request->input('geoTitle') ?? null);
            view()->share('locale_slug', $locale ?? null);
            URL::defaults(['locales' => $locale]);
        }

        return $next($request);
    }
}
