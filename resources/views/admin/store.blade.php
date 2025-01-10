@extends('layouts.sidebar')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1> Store Management</h1>
            <a href="{{url('admin/add-store')}}" class="btn btn-success">
                Add Store
            </a>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif
    <div class="card mt-4">
        <div class="card-body">
            @if($stores->isEmpty())
            <div class="alert alert-warning">
                No data found.
            </div>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width: 20%;">#</th>
                        <th scope="col" style="width: 20%;">Store Name</th>
                        <th scope="col" style="width: 40%;">Location</th>
                        <th scope="col" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stores as $index => $store)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $store->store_name }}</td>
                        <td>{{ $store->location_name }}</td>
                        <td>
                            <a href="{{ url('admin/edit-store/'.$store->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ url('admin/delete/store/'.$store->id) }}" method="post"
                                style="display: inline-block;"
                                onsubmit="return confirmDelete('Are you sure you want to delete this store?.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
<script>
function confirmDelete(message) {
    return confirm(message);
}
setTimeout(() => {
    const successAlert = document.getElementById('success-alert');
    const errorAlert = document.getElementById('error-alert');

    if (successAlert) successAlert.style.display = 'none';
    if (errorAlert) errorAlert.style.display = 'none';
}, 5000);
</script>

@endsection