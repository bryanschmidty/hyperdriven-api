@extends('layout')

@section('title', 'Show Parent')

@section('content')
    <h2>Parent Information</h2>
    <div id="parent-info">Loading...</div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            callApi('GET', 'parent')
                .then(data => {
                    let parentInfo = document.getElementById('parent-info');

                    if (!data) {
                        parentInfo.innerHTML = 'Not logged in'
                        return
                    }
                    parentInfo.innerHTML = `
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <td>${data.name}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>${data.email}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>${data.phone}</td>
                                </tr>
                            </table>
                        `;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
