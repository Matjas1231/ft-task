<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\RecordsNotFoundException;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function getUserByEmail(string $email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            return $user;
        } catch (RecordsNotFoundException){
            return false;
        }
    }

    public function getById(int $userId)
    {
        $user = User::find($userId);
        return $user;
    }

    public function create(array $data)
    {
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->role = 'user';

        $user->save();

        return $user;
    }

    public function update(array $dataToUpdate)
    {
        $user = $this->getUserByEmail($dataToUpdate['email']);
        $user->update($dataToUpdate);
    }

    public function getAll()
    {
        return User::all();
    }

    public function delete(int $userId)
    {
        $user = $this->getById($userId);
        $user->delete();
    }
}
