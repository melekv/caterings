@extends('index')

@section('content')
    <div class="center"><a href="/logout">Logout</a></div>

    <div>
        <table class="table">
            <thead>
                <th>#</th>
                <th>Email</th>
                <th>PESEL</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Active</th>
                <th>Source</th>
                <th>Age (or time left until 18)</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->pesel }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->active }}</td>
                        <td>{{ $user->source }}</td>
                        <td>{{ $user->age }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>Time span:
        <span><a href="/admin/3">3 days</a></span>
        <span><a href="/admin/7">7 days</a></span>
        <span><a href="/admin/30">30 days</a></span>
        <span><a href="/admin">reset</a></span>
    </div>
@endsection