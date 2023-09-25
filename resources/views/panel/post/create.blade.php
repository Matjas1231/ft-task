@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Add a new Post
        </div>
        <div class="card-body">
            @include('shared.messages')

            <form method="POST" action="{{ route('panel.post.store') }}">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control"
                        name="title" required>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control" required></textarea>
                </div>

                {{-- // TODO dodac obsługę pliku --}}
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
