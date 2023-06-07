@extends('layout')

@section('title', 'Login')

@section('content')

    <h2>Login Form</h2>

    <select id="selectUser" onchange="selectUser()">
        <option>Select User</option>
    </select>

<form id="loginForm">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" value="password" required><br>
    <button type="button" id="submitBtn">Submit</button>
</form>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            e.preventDefault();

            let request = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            }

            callApi('POST', 'login', request).then(data => {
                setToken(data.data.token)
                updateUser(data.data.user);
            })
        });

        document.addEventListener('DOMContentLoaded', function() {
            callApi('GET', 'admin/users')
                .then(users => {
                    let select = document.getElementById('selectUser');
                    users.forEach(user => {
                        let option = document.createElement('option');
                        option.text = user.name;
                        option.value = user.email;
                        select.add(option);
                    });
                })
                .catch(error => console.error(error));
        });

        function selectUser() {
            let select = document.getElementById('selectUser');
            let email = select.value;
            document.getElementById('email').value = email;
        }
    </script>

@endsection
