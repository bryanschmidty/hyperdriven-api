@extends('layout')

@section('title', 'Create Student')

@section('content')
    <h2>Create Student</h2>

    <form id="create-student-form" action="javascript:submitForm()">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone">
        </div>
        <div>
            <label for="school">School</label>
            <input type="text" id="school" name="school">
        </div>
        <div>
            <label for="age">Age</label>
            <input type="number" id="age" name="age">
        </div>
        <div>
            <label for="gender">Gender</label>
            <input type="text" id="gender" name="gender">
        </div>
        <div>
            <label for="defer">Defer</label>
            <input type="checkbox" id="defer" name="defer">
        </div>
        <div>
            <label for="active">Active</label>
            <input type="checkbox" id="active" name="active">
        </div>

        <button type="submit">Submit</button>
    </form>

    <button id="fill-random-info" onclick="fillRandomInfo()">Fill with Random Information</button>

    <script>
        function submitForm() {
            var form = document.getElementById('create-student-form');
            let request = {
                name: form.name.value,
                email: form.email.value,
                phone: form.phone.value,
                school: form.school.value,
                age: form.age.value,
                gender: form.gender.value,
                defer: form.defer.checked,
                active: form.active.checked,
            }

            callApi('POST', 'parent/student', request)
                .then(response => console.log(response))
                .catch(error => console.error(error));
        }

        function fillRandomInfo() {
            let number = Math.floor(Math.random() * 1000);
            let phone = Math.floor(Math.random() * 9000000000) + 1000000000; // Random 10 digit number
            let genders = ['Male', 'Female'];
            let randomGender = genders[Math.floor(Math.random() * genders.length)];

            document.getElementById('name').value = 'Test Student ' + number;
            document.getElementById('email').value = 'test' + number + '@example.com';
            document.getElementById('phone').value = phone;
            document.getElementById('school').value = 'Test School ' + number;
            document.getElementById('age').value = Math.floor(Math.random() * 8) + 10;
            document.getElementById('gender').value = randomGender;
        }
    </script>

@endsection
