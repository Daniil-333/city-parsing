<?php

namespace App\Services;

use App\Models\City;
use App\Models\Area;
use App\Models\Country;
use Illuminate\Support\Str;
use \JsonMachine\Items;

class GeoParserService
{
    private ?array $countries;
    private ?array $areas;
    private ?array $cities;

    /**
     * @param array $countries
     * @param array $areas
     * @param array $cities
     */
    public function __construct(?array $countries = null, ?array $areas = null, ?array $cities = null)
    {
        $this->countries = $countries;
        $this->areas = $areas;
        $this->cities = $cities;
    }

    public function handleGeo($link = 'https://api.hh.ru/areas'): void
    {
        $citiesRaw = Items::fromFile($link);

        foreach ($citiesRaw as $country) {
            if($country->name != 'Россия') continue;

            $this->countries[$country->id] = $country->name;

            foreach ($country->areas as $area) {
                $this->areas[$area->id]['country_id'] = $area->parent_id;
                $this->areas[$area->id]['title'] = $area->name;

                foreach ($area->areas as $city) {
                    $this->cities[$city->id]['id'] = $city->id;
                    $this->cities[$city->id]['area_id'] = $city->parent_id;
                    $this->cities[$city->id]['title'] = $city->name;
                    $this->cities[$city->id]['slug'] = Str::slug($city->name);
                }
            }
        }

        $this->saveCountries();
        $this->saveAreas();
        $this->saveCities();
    }

    private function saveCountries(): void
    {
        foreach ($this->countries as $idCountry => $country) {
            Country::query()->firstOrCreate([
                'id' => $idCountry,
                'title' => $country,
            ]);
        }
    }

    private function saveAreas(): void
    {
        foreach ($this->areas as $idArea => $area) {
            Area::query()->firstOrCreate([
                'id' => $idArea,
                'country_id' => $area['country_id'],
                'title' => $area['title'],
            ]);
        }
    }

    private function saveCities(): void
    {
        $chunks = array_chunk($this->cities, 500);

        foreach ($chunks as $chunk) {
            City::upsert(
                $chunk,
                ['id']
            );
        }
    }
}
