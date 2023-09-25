@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            @include('shared.messages')

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control"
                        name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('register') }}"> Register? </a> |
            <a href="{{ route('forget.password.get') }}"> Forgot your password? </a>
        </div>
    </div>
@endsection
