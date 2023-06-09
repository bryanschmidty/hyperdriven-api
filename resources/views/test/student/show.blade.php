@extends('test.student.layout')

@section('title', 'Show Student')

@section('studentContent')
    <h3>Show Student</h3>

    <div id="student-info"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('selectUser').addEventListener('change', () => {
                let select = document.getElementById('selectUser');
                let studentId = select.value;
                callApi('GET', `parent/student/${studentId}`)
                    .then(student => {
                        document.getElementById('student-info').innerHTML = `
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <td>${student.name}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>${student.email}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>${student.phone}</td>
                                </tr>
                                <tr>
                                    <th>School</th>
                                    <td>${student.school}</td>
                                </tr>
                                <tr>
                                    <th>Age</th>
                                    <td>${student.age}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>${student.gender}</td>
                                </tr>
                            </table>
                        `;

                    })
                    .catch(err => console.log(err));
            });
        });
    </script>
@endsection
