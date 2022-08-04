@extends('index')

@section('content')
    <div class="center"><a href="/admin">ADMIN</a></div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session()->get('message') }}</div>
    @endif

    <div class="index">
        <form action="/save" method="POST">
            @csrf
            <div class="grid">
                <div><label for="email">Email:</label></div>
                <div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div><label for="pesel">PESEL:</label></div>
                <div>
                    <input id="pesel" type="text" name="pesel">
                    @error('pesel')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div><label for="name">Imię:</label></div>
                <div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div><label for="surname">Nazwisko:</label></div>
                <div>
                    <input id="surname" type="text" name="surname" value="{{ old('surname') }}">
                    @error('surname')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="btn-center"><input type="submit" class="btn btn-primary" value="Save"></div>
        </form>
    </div>
@endsection