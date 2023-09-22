<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function login()
    {
        return view('auth.login');
    }

    public function logging(LoginRequest $request)
    {
        $validatedEmail = $request->validated('email');
        $validatedPassword = $request->validated('password');

        $user = $this->userRepository->getUserByEmail($validatedEmail);

        if (!$user || !Hash::check($validatedPassword, $user->password)) {
            return redirect()
                ->route('login')
                ->withErrors(['error_key' => 'Wrong email or password']);
        }

        Auth::login($user);

        return redirect()
            ->route('home')
            ->with(['success' => 'Logged successfully']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('home')
            ->with(['success' => 'Logout successfully']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registration(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = $this->userRepository->create($validatedData);

        event(new UserRegistered($user));

        return redirect()
            ->route('login')
            ->with(['success' => 'Registration successfully']);
    }
}
