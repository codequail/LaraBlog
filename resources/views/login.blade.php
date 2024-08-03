@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="w-50 w-sm-100 mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-4">Login</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ route('register') }}" type="submit" class="btn btn-outline">Register</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
