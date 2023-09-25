@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Add a new Post
        </div>
        <div class="card-body">
            @include('shared.messages')

            <form method="POST" action="{{ route('panel.post.update') }}">
                @csrf
                <input type="hidden" value="{{ $post->id }}" name="id">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control"
                        name="title" value="{{ $post->title }}" required>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control" required>{{ $post->content }}</textarea>
                </div>

                {{-- // TODO dodac obsługę pliku --}}
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
