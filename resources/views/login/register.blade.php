@extends('layout')

@section('title', 'Register')

@section('content')

<h2>Register Form</h2>

<form id="registerForm">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="phone">Phone:</label><br>
    <input type="tel" id="phone" name="phone" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    <label for="password_confirmation">Confirm Password:</label><br>
    <input type="password" id="password_confirmation" name="password_confirmation" required><br>
    <button type="button" id="submitBtn">Submit</button>
</form>

<button onclick="populateForm()">Populate Form</button>

<script>
    function populateForm() {
        let number = Math.floor(Math.random() * 1000);
        let phone = Math.floor(Math.random() * 9000000000) + 1000000000; // Random 10 digit number

        document.getElementById('name').value = 'Test User ' + number;
        document.getElementById('email').value = 'test' + number + '@example.com';
        document.getElementById('phone').value = phone;
        document.getElementById('password').value = 'password';
        document.getElementById('password_confirmation').value = 'password';
    }

    document.getElementById('submitBtn').addEventListener('click', function(e) {
        e.preventDefault();

        let request = {
            user_type: 'parent',
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,
        }
        callApi('POST', 'register', request).then(data => {
            if (data?.data && data.data.token && data.data.user) {
                setToken(data.data.token);
                updateUser(data.data?.user);
            }
        })
    });
</script>
@endsection
