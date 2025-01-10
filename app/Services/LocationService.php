<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LocationService
{
    /**
     * Get the location name based on latitude and longitude.
     *
     * @param float $latitude
     * @param float $longitude
     * @return string
     */
    public function getLocationName(float $latitude, float $longitude): string
    {
        $apiKey = '25f9aeb046a6421397ea75bb8e14f389';  
        $url = "https://api.opencagedata.com/geocode/v1/json?q={$latitude}+{$longitude}&key={$apiKey}";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['results'][0]['formatted'])) {
                return $data['results'][0]['formatted'];  
            }
        }

        return 'Unknown Location';
    }
}