<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Repositories\PostRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    )
    {
        $this->middleware('can:editor-level');
    }

    public function create()
    {
        return view('panel.post.create');
    }

    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;

        try {
            $this->postRepository->store($validatedData);
        } catch (Exception) {
            return redirect()
                ->route('panel.index')
                ->withErrors(['error_key' => 'Something went wrong...']);
        }

        return redirect()
            ->route('panel.index')
            ->with(['success' => 'Post added']);
    }

    public function show(int $postId)
    {
        return view('panel.post.show', [
            'post' => $this->postRepository->getById($postId)
        ]);
    }

    public function edit(int $postId)
    {
        return view('panel.post.edit', [
            'post' => $this->postRepository->getById($postId)
        ]);
    }

    public function update(PostRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $this->postRepository->update($validatedData);
        } catch (Exception) {
            return redirect()
                ->route('panel.index')
                ->withErrors(['error_key' => 'Something went wrong...']);
        }

        return redirect()
            ->route('panel.index')
            ->with(['success' => 'Post edited']);
    }

    public function delete(int $postId)
    {
        try {
            $this->postRepository->delete($postId);
        } catch (Exception) {
            return redirect()
                ->route('panel.index')
                ->withErrors(['error_key' => 'Something went wrong...']);
        }

        return redirect()
            ->route('panel.index')
            ->with(['success' => 'Post deleted']);
    }
}
