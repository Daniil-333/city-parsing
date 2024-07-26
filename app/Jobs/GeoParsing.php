<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\GeoParserService;

class GeoParsing implements ShouldQueue
{
    use Queueable;

    private string $link;

    /**
     * Create a new job instance.
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     */
    public function handle(GeoParserService $geoParser): void
    {
        $geoParser->handleGeo($this->link);
    }
}
