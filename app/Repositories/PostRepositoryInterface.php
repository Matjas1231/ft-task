<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function getAllPaginated(int $numberPerPage = 10);
    public function store(array $dataToSave);
    public function getById(int $postId);
    public function update(array $dataToUpdate);
    public function delete(int $postId);
}
