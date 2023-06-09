@extends('test.layout')

@section('content')
    <select id="selectUser">
        <option>Select User</option>
    </select>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            callApi('GET', 'parent/student').then(users => {
                let select = document.getElementById('selectUser');
                users.forEach(user => {
                    let option = document.createElement('option');
                    option.text = user.name;
                    option.value = user.id;
                    select.add(option);
                });
            }).catch(err => console.log(err))
        });
    </script>

    @yield('studentContent')
@endsection
