@extends('layouts.sidebar')

@section('title', 'Edit Store')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1> Edit Store</h1>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <h1 class="mb-4">Store Management</h1>
            <form action="{{ url('admin/update/store', $store->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="storeName" class="form-label">Store Name</label>
                    <input type="text" class="form-control" id="storeName" name="store_name"
                        value="{{ old('store_name', $store->store_name) }}" placeholder="Enter store name" required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude"
                        value="{{ old('latitude', $store->latitude) }}" placeholder="Enter latitude" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude"
                        value="{{ old('longitude', $store->longitude) }}" placeholder="Enter longitude" required>
                </div>
                <div class="mb-3">
                    <label for="map" class="form-label">Select Location</label>
                    <div id="map" data-lat="{{ $store->latitude ?? 0 }}" data-lng="{{ $store->longitude ?? 0 }}"
                        style="height: 300px; width: 100%;"></div>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
const lat = parseFloat(document.getElementById('map').getAttribute('data-lat'));
const lng = parseFloat(document.getElementById('map').getAttribute('data-lng'));
const map = L.map('map').setView([lat || 0, lng || 0], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
}).addTo(map);
let marker = L.marker([lat || 0, lng || 0]).addTo(map);
map.on('click', function(e) {
    const {
        lat,
        lng
    } = e.latlng;
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
    marker.setLatLng(e.latlng);
});

const geocoder = L.Control.Geocoder.nominatim();
const geocodeControl = L.Control.geocoder({
    geocoder: geocoder,
    placeholder: "Search for a place",
    collapsed: false
}).addTo(map);

geocodeControl.on('markgeocode', function(e) {
    const latLng = e.geocode.center;
    document.getElementById('latitude').value = latLng.lat;
    document.getElementById('longitude').value = latLng.lng;
    marker.setLatLng(latLng);
    map.setView(latLng, 13);
});
</script>

@endsection