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
}
