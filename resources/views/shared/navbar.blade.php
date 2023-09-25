<div>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top main-color{{ request()->is('*panel*') ? '-dark' : '' }}">
        <a class="navbar-brand" href="{{ route('home') }}">Blog App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home </a>
                </li>
            </ul>

        </div>

        @can('editor-level')
        <div class="dropdown mr-2">
            <button class="btn btn-dark dropdown-toggle" type="button" id="panelDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Panel
            </button>
            <div class="dropdown-menu" aria-labelledby="panelDropdown">
                <a class="dropdown-item" href="{{ route('panel.post.create') }}">Add a new post</a>
                <a class="dropdown-item" href="{{ route('panel.index') }}">Posts list</a>
                @can('admin-level')
                    <a class="dropdown-item" href="{{ route('panel.user.list') }}">Users list</a>
                    <a class="dropdown-item" href="{{ route('panel.user.create') }}">Add user</a>
                @endcan
            </div>
        </div>

        @endcan

        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-light">Logout ({{ Auth::user()->name }})</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-light">Login</a>
            @endauth
        </div>
    </nav>
</div>
