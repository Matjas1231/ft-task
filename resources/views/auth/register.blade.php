@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">

            @include('shared.messages')

            <form method="POST" action="{{ route('registration') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" minlength="3" maxlength="15" name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control"
                        name="password" minlength="8" required>
                </div>

                <div class="form-group">
                    <label>Verify Password</label>
                    <input type="password" class="form-control"
                        name="password_confirmation" minlength="8" required>
                </div>

                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('login') }}"> Already have an account? </a> |
            <a href="{{ route('forget.password.get') }}"> Forgot your password? </a>
        </div>
    </div>
@endsection
