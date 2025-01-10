@extends('layouts.user')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-light rounded">
                <div class="card-body text-center">
                    <h2 class="display-4 text-primary mb-4">Welcome to the Store Locator!</h2>
                    <p class="lead mb-4 text-muted">We help you find the nearest stores easily. Check out the stores
                        near you and get directions quickly.</p>

                    <!-- Hero Image Section -->
                    <div class="mb-4">
                        <img src="https://play-lh.googleusercontent.com/pPSF_vJoWXgt5uL53vwD33YX-ZLZm9ZLEpFTkrCBEayVA7_bAFx7rpEYMWM7ly3U1Lw"
                            alt="Store Locator" class="img-fluid rounded shadow">
                    </div>

                    <!-- Action Button with Hover Effect -->
                    <a href="javascript:void(0);" onclick="getNearbyStores()" class="btn btn-primary btn-lg shadow-lg">
                        <i class="fas fa-location-arrow"></i> Check Nearby Stores
                    </a>

                    <!-- Note under button -->
                    <p class="mt-3 text-muted">Allow location access to find stores closest to you.</p>

                    <div id="loadingSpinner" class="spinner-border text-primary" style="display: none;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function getNearbyStores() {
    document.getElementById('loadingSpinner').style.display = 'block';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Redirect to the nearby stores route with location data
            const url = `/check-near-stores?latitude=${latitude}&longitude=${longitude}`;
            window.location.href = url;
        }, function(error) {
            document.getElementById('loadingSpinner').style.display = 'none';
            alert('Unable to fetch your location. Please enable location access.');
        });
    } else {
        document.getElementById('loadingSpinner').style.display = 'none';
        alert('Geolocation is not supported by your browser.');
    }
}
window.onload = function() {
    document.getElementById('loadingSpinner').style.display = 'none';
};
</script>
@endsection