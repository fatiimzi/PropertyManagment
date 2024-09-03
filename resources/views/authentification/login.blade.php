@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form id="loginForm"  method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <p class="mt-3 text-center">
                Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register here</a>
            </p>
        </div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Get the CSRF token from the meta tag
    // const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    fetch('http://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // 'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        body: JSON.stringify({ email, password })
    })
    .then(response => response.json());
    .then(data => {
        if (data.token) {
            // Store the JWT token in localStorage
            localStorage.setItem('token', data.token);
        console.log(data.token);
            // Redirect to the properties page
             window.location.href = '{{ route('properties.index') }}'
            ;
        } else {
            alert('Invalid credentials');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script>
@endsection
