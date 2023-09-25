@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Password reset
        </div>
        <div class="card-body">
            @include('shared.messages')

            <form method="POST" action="{{ route('forget.password.post') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control"
                        name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Send password reset link</button>
            </form>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('login') }}"> Login? </a>
        </div>
    </div>
@endsection
