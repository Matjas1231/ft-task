<?php

namespace App\Repositories;

use App\Models\Post;

class EloquentPostRepository implements PostRepositoryInterface
{
    public function getAllPaginated(int $numberPerPage = 10)
    {
        return Post::with('user')
            ->orderBy('created_at', 'DESC')
            ->cursorPaginate($numberPerPage);
    }

    public function store(array $dataToSave)
    {
        $post = new Post();
        $post->create($dataToSave);
    }

    public function getById(int $postId)
    {
        $post = Post::find($postId);
        return $post;
    }

    public function update(array $dataToUpdate)
    {
        $post = $this->getById($dataToUpdate['id']);

        $post->update($dataToUpdate);
    }

    public function delete(int $postId)
    {
        $post = $this->getById($postId);
        $post->delete();
    }
}
