<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getUserByEmail(string $email);
    public function getById(int $userId);
    public function create(array $data);
    public function update(array $dataToUpdate);
    public function getAll();
    public function delete(int $userId);
}
