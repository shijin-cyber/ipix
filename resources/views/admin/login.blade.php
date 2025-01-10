@extends('layouts.adminlogin')

@section('title', 'Admin Login')

@section('content')
<h2>Admin Login</h2>

<!-- Display session messages if any -->
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password"
            required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>
@endsection