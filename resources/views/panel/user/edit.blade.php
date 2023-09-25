@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Create User
        </div>
        <div class="card-body">

            @include('shared.messages')

            <form method="POST" action="{{ route('panel.user.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $user->email }}">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" minlength="3" maxlength="15" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : ''}}>User</option>
                        <option value="editor" {{ $user->role === 'editor' ? 'selected' : ''}}>Edtior</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : ''}}>Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
