<?php

namespace App\Http\Controllers;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use DB;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        event(new ResetPassword([
            'email' => $request->email,
            'token' => $token
        ]));

        // Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){

        //     $message->to($request->email);
        //     $message->subject('Reset Password');

        // });

        return back()->with(['success' => 'We have e-mailed your password reset link!']);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }


    public function submitResetPasswordForm(ResetPasswordRequest $request)
    {
        $validatedToken = $request->validated('token');
        $validatedPassword = $request->validated('password');

        $dataFromTokenTable = DB::table('password_reset_tokens')
                        ->select(['email', 'token'])
                        ->where(['token' => $validatedToken])
                        ->first();


        if (!$dataFromTokenTable) {
            return back()
                ->withErrors(['error_key' => 'Invalid token!']);
        }

        $dataToUpdate = [
            'email' => $dataFromTokenTable->email,
            'password' => Hash::make($validatedPassword)
        ];

        $this->userRepository->update($dataToUpdate);

        DB::table('password_reset_tokens')
            ->where(['token' => $validatedToken])
            ->delete();

        return redirect()
            ->route('login')
            ->with(['success' => 'Your password has been changed!']);
    }
}
