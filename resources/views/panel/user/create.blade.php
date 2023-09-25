@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Create User
        </div>
        <div class="card-body">

            @include('shared.messages')

            <form method="POST" action="{{ route('panel.user.store') }}">
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

                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role">
                        <option value="user">User</option>
                        <option value="editor">Edtior</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
