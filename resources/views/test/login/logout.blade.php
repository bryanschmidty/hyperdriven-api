@extends('test.layout')

@section('title', 'Logout')

@section('content')

    <h2>Logout Form</h2>

    <button id="logoutBtn">Logout</button>

    <script>
        document.getElementById('logoutBtn').addEventListener('click', function (e) {
            e.preventDefault();

            callApi('POST', 'logout').then(() => {
                clearToken();
                console.log('Logged out successfully');
                updateUser();
            })
        });
    </script>

@endsection
