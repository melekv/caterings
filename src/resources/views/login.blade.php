@extends('index')

@section('content')
    <div class="index">
        <div>
            <form action="/login" method="POST">
                @csrf
                <div class="grid">
                    <div><label for="login">Login:</label></div>
                    <div>
                        <input id="login" type="login" name="login">
                        @error('login')
                            <div class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div><label for="password">Password:</label></div>
                    <div>
                        <input id="password" type="password" name="password">
                        @error('password')
                            <div class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="btn-center"><input type="submit" class="btn btn-primary" value="Login"></div>
            </form>
        </div>
    </div>
@endsection