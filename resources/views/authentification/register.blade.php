<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Register')

@section('content')
<h1>Register</h1>

<form id="registerForm" action="{{route('register')}}"  method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<p class="mt-3">
    Already have an account? <a href="{{ route('login') }}">Login</a>
</p>

<script>

document.getElementById('registerForm').addEventListener('submit', function(event) {

    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const password_confirmation = document.getElementById('password_confirmation').value;
    console.log('helooo')
    fetch('/register', {
        method: 'POST',
        headers: {

            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, email, password, password_confirmation })
    })
     .then(response =>response.json())
    .then(data => {
        console.log(data)
        if (data.token) {
            localStorage.setItem('token', data.token);
            window.location.href = '/';
        } else {
            alert('Error: ' + JSON.stringify(data));
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>

@endsection
