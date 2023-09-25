<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class PanelController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private UserRepositoryInterface $userRepository
    )
    {
        $this->middleware('can:editor-level');
    }

    public function index()
    {
        return view('panel.index', [
            'posts' => $this->postRepository->getAllPaginated(10)
        ]);
    }

    public function createPost()
    {
        return view('panel.post.create');
    }

    public function usersList()
    {
        return view('panel.user.list', [
            'users' => $this->userRepository->getAll()
        ]);
    }
}

