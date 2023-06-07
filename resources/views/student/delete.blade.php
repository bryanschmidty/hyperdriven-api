@extends('student/layout')

@section('title', 'Delete Student')

@section('studentContent')
    <h2>Delete Student</h2>

    <button type="button" id="deleteUserButton">Delete User</button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('deleteUserButton').addEventListener('click', () => {
                let select = document.getElementById('selectUser');
                let studentId = select.value;

                callApi('DELETE', `parent/student/${studentId}`)
                    .then(response => {
                        console.log(response); // Log the response for debugging

                        // Optionally, remove the deleted user from the dropdown
                        select.removeChild(select.options[select.selectedIndex]);
                    })
                    .catch(err => console.log(err));
            });
        });
    </script>
@endsection
