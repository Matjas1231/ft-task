<div class="card text-center">
    <div class="card-header">
        Posts list
    </div>
    <div class="card-body">

        @if (!$posts->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Info</th>
                        <th scope="col">Content</th>
                        <th scope="col">Author</th>
                        <th scope="col">Creation date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="pointer">
                            <td>{{ $loop->index }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::of($post->content)->limit(60) }}</td>
                            <td>{{ $post->user->name }} ({{ $post->user->email }})</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route('panel.post.show', ['postId' => $post->id]) }}">Show More</a>

                                @can('editor-level')
                                    @if (request()->is('*panel*'))
                                        <a class="btn btn-info" href="{{ route('panel.post.edit', ['postId' => $post->id]) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ route('panel.post.delete', ['postId' => $post->id]) }}">Delete</a>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>{{ $posts->links() }}</div>
        @else
            <h2>
                <strong>No Posts</strong>
            </h2>
        @endif

    </div>
</div>
