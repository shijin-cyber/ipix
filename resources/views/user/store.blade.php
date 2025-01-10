@extends('layouts.user')

@section('content')
<div class="container my-4">
    <h2 class="text-center mb-4">Nearby Stores</h2>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($stores->isEmpty())
    <div class="card mb-4 shadow-sm">
        <div class="card-body text-center">
            <h5 class="card-title text-muted">No Stores Found</h5>
            <p class="card-text text-muted">There are no nearby stores to display at the moment.</p>
        </div>
    </div>
    @else

    <div class="row">
        @foreach($stores as $store)
        <div class="col-md-4">
            <div class="card mb-4 fixed-card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $store->store_name }}</h5>
                    <p class="card-text text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $store->location_name }}
                    </p>
                    <p class="card-text">
                        <strong>Distance:</strong> {{ number_format($store->distance, 2) }} km
                    </p>
                </div>
                <div class="card-footer text-end">
                    <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection