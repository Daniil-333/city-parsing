<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

use App\Models\City;

class StartSessionLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1) ?? null;
        $session = DB::table('sessions')
            ->where('id', $request->session()->getId())->first();

        if($session) {
            // если есть Локаль
            if($locale) {
                $city = $this->getCityIfExist($locale);
                // если есть город в БД
                if($city) {
                    $request->merge([
                        'geoTitle' => $city->title,
                        'geoSlug' => $city->slug
                    ]);
                    DB::table('sessions')
                        ->where('id', $request->session()->getId())
                        ->update(['geo' => $city->slug]);
                }
                // если нет города в БД
                else {
                    // если это роут
                    if(in_array($locale, $this->getNamesRoutes())) {
                        URL::defaults(['locales' => null]);

                        $request->merge([
                            'geoTitle' => null,
                            'geoSlug' => null
                        ]);

                        return $next($request);
                    }

                    return redirect("/", 301);
                }
            }
            // если нет Локали
            else {
                // если есть город в сессии
                if($session->geo) {
                    $city = $this->getCityIfExist($session->geo);
                    $request->merge([
                        'geoTitle' => $city->title,
                        'geoSlug' => $session->geo
                    ]);
                    return redirect("/{$session->geo}", 301);
                }
            }
        }
        // если пользователь зашёл впервые (или с нового браузера)
        else {}

        return $next($request);
    }

    /**
     * Получение города (если есть)
     * @param $slug
     * @return mixed
     */
    private function getCityIfExist($slug): mixed
    {
        if(!$slug) return false;

        return City::where('slug', $slug)->first();
    }


    /**
     * Получение имён всех роутов
     * @return array
     */
    private function getNamesRoutes(): array
    {
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            if($route->getName()) $result[] = $route->getName();
        }

        return $result ?? [];
    }
}
