<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Services\LocationService;

class UserStoreController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function nearbyStores(Request $request)
    {
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');
        
        if (!$userLatitude || !$userLongitude) {
            return back()->with('error', 'Unable to fetch your location. Please allow location access.');
        }
     
        $stores = Store::selectRaw(
            '*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
            * cos(radians(longitude) - radians(?)) + sin(radians(?)) 
            * sin(radians(latitude)))) AS distance',
            [$userLatitude, $userLongitude, $userLatitude]
        )
        ->orderBy('distance', 'asc') 
        ->get();

        $stores->each(function ($store) {
            $store->location_name = $this->locationService->getLocationName($store->latitude, $store->longitude);
        });

        return view('user.store', compact('stores'));
    }
}