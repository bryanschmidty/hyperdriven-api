@extends('student/layout')

@section('title', 'Update Student')

@section('studentContent')
    <h2>Update Student</h2>

    <form id="update-student-form" action="javascript:submitForm()">
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

    <script>
        function submitForm() {
            let select = document.getElementById('selectUser');
            let studentId = select.value;

            let data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                school: document.getElementById('school').value,
                age: document.getElementById('age').value,
                gender: document.getElementById('gender').value,
                defer: document.getElementById('defer').checked,
                active: document.getElementById('active').checked,
            };

            callApi('PUT', `parent/student/${studentId}`, data)
                .then(response => {
                    console.log(response); // Log the response for debugging
                })
                .catch(err => console.log(err));
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('selectUser').addEventListener('change', () => {
                let select = document.getElementById('selectUser');
                let studentId = select.value;
                callApi('GET', `parent/student/${studentId}`)
                    .then(student => {
                        document.getElementById('name').value = student.name;
                        document.getElementById('email').value = student.email;
                        document.getElementById('phone').value = student.phone;
                        document.getElementById('school').value = student.school;
                        document.getElementById('age').value = student.age;
                        document.getElementById('gender').value = student.gender;
                        document.getElementById('defer').checked = student.defer;
                        document.getElementById('active').checked = student.active;
                    })
                    .catch(err => console.log(err));
            });
        });
    </script>
@endsection
