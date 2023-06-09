@extends('test.layout')

@section('title', 'Update Parent')

@section('content')
    <h1>Update Parent</h1>
    <form id="update-parent-form" action="#">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="phone">Cell Phone:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <input type="submit" value="Update Parent">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            callApi('GET', 'parent')
                .then(data => {
                    if (!data) {
                        return;
                    }
                    document.getElementById('name').value = data.name;
                    document.getElementById('email').value = data.email;
                    document.getElementById('phone').value = data.phone;
                })
                .catch(error => console.error('Error:', error));
        });


        document.getElementById('update-parent-form').addEventListener('submit', function (event) {
            event.preventDefault();

            var body = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value
            };

            callApi('PUT', 'parent', body)
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        });
    </script>

@endsection
