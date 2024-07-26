<?php

namespace Database\Seeders;

use App\Services\GeoParserService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new GeoParserService())->handleGeo();
    }
}
