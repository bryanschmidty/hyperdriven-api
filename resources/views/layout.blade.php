<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .app-container {
            display: flex;
        }

        .sidebar {
            flex: 0 0 200px;
            background-color: #f8f9fa;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li a {
            color: #333;
            text-decoration: none;
        }

        .container {
            margin-top: 20px;
        }

        #studentsTable td {
            padding: 2px 8px;
        }

    </style>
</head>
<body>
    <div class="app-container">
        <nav class="sidebar">
            <div id="user-name">No user</div>
            <ul>
                <h3>Login</h3>
                <li><a href="{{ url('login/register') }}">Register</a></li>
                <li><a href="{{ url('login/login') }}">Login</a></li>
                <li><a href="{{ url('login/logout') }}">Logout</a></li>
            </ul>

            <ul>
                <h3>Parent</h3>
                <li><a href="{{ url('parent/show') }}">Show Parent</a></li>
                <li><a href="{{ url('parent/update') }}">Update Parent</a></li>
            </ul>

            <ul>
                <h3>Student</h3>
                <li><a href="{{ url('student/index') }}">All Students</a></li>
                <li><a href="{{ url('student/show') }}">Show Student</a></li>
                <li><a href="{{ url('student/create') }}">Create Student</a></li>
                <li><a href="{{ url('student/update') }}">Update Student</a></li>
                <li><a href="{{ url('student/delete') }}">Delete Student</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        var token = getToken();

        if (token) {
            callApi('GET', 'whoami').then(data => {
                updateUser(data?.user);
                console.log(data.user.name)
            });
        } else {
            console.log('No token found in the cookies.');
            updateUser()
        }

        function callApi(method, endpoint, body = null) {
            let options = {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": "Bearer " + getToken()
                },
            };

            if (body) {
                options.body = JSON.stringify(body);
            }

            return fetch("{{ config('app.url') }}/api/" + endpoint, options)
                .then(response => response.text().then(text => {
                    if (!response.ok) {
                        console.error('Error:', JSON.parse(text));
                    } else {
                        return text ? JSON.parse(text) : {};
                    }
                }))
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        // Helper function to get the token from the cookie
        function getToken() {
            return document.cookie.replace(/(?:(?:^|.*;\s*)token\s*\=\s*([^;]*).*$)|^.*$/, "$1");
        }

        // Helper function to clear the token from the cookie
        function clearToken() {
            document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }

        // Helper function to set the token in the cookie
        function setToken(token) {
            document.cookie = "token=" + token + "; path=/;";
        }

        // Helper function to update an element on the page with the user's name
        function updateUser(user = null) {
            let userNameElement = document.getElementById('user-name');

            if (user && user.name) {
                userNameElement.innerText = user.name;
            } else {
                userNameElement.innerText = 'No user';
            }
        }

    </script>
</body>
</html>
