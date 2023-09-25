<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {
        $this->middleware('can:admin-level');
    }

    public function create()
    {
        return view('panel.user.create');
    }

    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        $this->userRepository->create($validatedData);

        return redirect()
            ->route('panel.user.list')
            ->with(['success' => 'User created']);
    }

    public function edit(int $userId)
    {
        return view('panel.user.edit', [
            'user' => $this->userRepository->getById($userId)
        ]);
    }

    public function update(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();

        $this->userRepository->update($validatedData);

        return redirect()
            ->route('panel.user.list')
            ->with(['success' => 'User Changed']);
    }

    public function delete(int $userId)
    {
        try {
            $this->userRepository->delete($userId);
        } catch (RecordsNotFoundException){
            return redirect()
                ->route('panel.user.list')
                ->withErrors(['error_key' => 'Something went wrong']);
        }

        return redirect()
            ->route('panel.user.list')
            ->with(['success' => 'User deleted']);
    }
}
