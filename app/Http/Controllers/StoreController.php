<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Services\LocationService;

class StoreController extends Controller
{

protected $locationService;

public function __construct(LocationService $locationService)
{
   $this->locationService = $locationService;
}
   
    public function index()
{
    $stores = Store::all();
    $locationService = new \App\Services\LocationService(); 
   
    $stores = $stores->map(function ($store) use ($locationService) {
        $store->location_name = $locationService->getLocationName($store->latitude, $store->longitude);
        return $store;
    });

    return view('admin.store', compact('stores'));
}

    public function addStore(){
        return view('admin.store-form');
    }
    public function saveStore(Request $request)
{
    $validatedData = $request->validate([
        'store_name' => 'required|string|max:255',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
    ]);
    try {
        $store = new Store();
        $store->store_name = $validatedData['store_name'];
        $store->latitude = $validatedData['latitude'];
        $store->longitude = $validatedData['longitude'];
        $store->save();

        return redirect('admin/store')->with('success', 'Store added successfully!');
    } catch (\Exception $e) {
        return redirect('admin/store')->with('error', 'Failed to add store. Please try again.');
    }
}
public function edit($id)
{
    $store = Store::findOrFail($id);
    return view('admin.edit-store', compact('store'));
}
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'store_name' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);
    $store = Store::findOrFail($id);
    $store->update([
        'store_name' => $validatedData['store_name'],
        'latitude' => $validatedData['latitude'],
        'longitude' => $validatedData['longitude'],
    ]);
    return redirect()->route('admin.store')->with('success', 'Store updated successfully!');
}
public function destroy($id)
{
    $store = Store::find($id);

    if ($store) {
        $store->delete();
        return redirect('admin/store')->with('success', 'Store deleted successfully.');
    } else {
        return redirect('admin/store')->with('error', 'Store not found.');
    }
}

}