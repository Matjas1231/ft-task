@extends('layout')

@include('shared.messages')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            Users list
        </div>
        <div class="card-body">

            @if (!$users->isEmpty())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">role</th>
                            <th scope="col">Creation date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="pointer">
                                <td>{{ $loop->index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->created_at }}</td>

                                <td>
                                    <a class="btn btn-info" href="{{ route('panel.user.edit', ['userId' => $user->id]) }}">Edit</a>

                                    <a class="btn btn-danger" href="{{ route('panel.user.delete', ['userId' => $user->id]) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2>
                    <strong>No Users</strong>
                </h2>
            @endif

        </div>
    </div>
@endsection
