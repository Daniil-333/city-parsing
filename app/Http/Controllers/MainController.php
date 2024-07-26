<?php

namespace App\Http\Controllers;

use App\Jobs\GeoParsing;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        // возможность загрузки гео-данных через Job
//        GeoParsing::dispatch('https://api.hh.ru/areas');

        $geo = Country::orderBy('title')->get();

        return view('pages.main')->with(['geoItems' => $geo]);
    }
}
