@extends('test.layout')

@section('title', 'All Students')

@section('content')

    <h2>All Students</h2>

    <table id="studentsTable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>School</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>
        </thead>
        <tbody>
        <!-- Rows will be inserted here -->
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            callApi('GET', 'parent/student')
                .then(students => {
                    let tbody = document.getElementById('studentsTable').getElementsByTagName('tbody')[0];

                    students.forEach(student => {
                        let row = tbody.insertRow();

                        row.insertCell().textContent = student.name;
                        row.insertCell().textContent = student.email;
                        row.insertCell().textContent = student.phone;
                        row.insertCell().textContent = student.school;
                        row.insertCell().textContent = student.age;
                        row.insertCell().textContent = student.gender;
                    });
                })
                .catch(err => console.log(err));
        });
    </script>

@endsection
