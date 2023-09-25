@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Set a new password
        </div>
        <div class="card-body">

            @include('shared.messages')

            <form method="POST" action="{{ route('reset.password.post') }}">
                <input type="hidden" value="{{ $token }}" name="token">
                @csrf
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

                <button type="submit" class="btn btn-primary">Change password</button>
            </form>
        </div>
    </div>
@endsection
