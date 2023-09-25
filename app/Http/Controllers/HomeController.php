<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {}

    public function home()
    {
        return view('home', [
            'posts' => $this->postRepository->getAllPaginated(10)
        ]);
    }
}
