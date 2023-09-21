<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getUserByEmail(string $email);
    public function create(array $data);
}
