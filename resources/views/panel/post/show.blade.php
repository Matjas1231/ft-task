@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            Title: <strong>{{ $post->title }}</strong>
        </div>
        <div class="card-body">
            <div class="form-group">
                <a>
                    {{ $post->content }}
                </a>
            </div>

            {{-- // TODO dodac obsługę pliku --}}
            {{-- <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control"> --}}
            {{-- </div> --}}
        </div>
        <div class="card-footer">
            Creation Date: <strong>{{ $post->created_at }}</strong> | Author: <strong>{{ $post->user->name }} ({{ $post->user->email }})</strong>
        </div>
    </div>
@endsection
