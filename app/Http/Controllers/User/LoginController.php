<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email' => 'Enter your email to login',
            'password' => 'Password is required to login'
        ]);

        $user = User::with(['personal_information'])->isUser()->isActive()
            ->where('email', $request->input('email'))
            ->first();

        // if (!$user || !Hash::check($request->input('password'), $user->makeVisible(['password'])->password)) {
        //     return response()->json([
        //         'message' => 'Authentication Error'
        //     ], 412);
        // }

        if (!Auth::guard('web')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'user',
            'status' => 1
        ])) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Authentication Error'
            ], 412);
        }

        // if ($this->guard->attempt(
        //     $request->only(Fortify::username(), 'password'),
        //     $request->boolean('remember'))
        // ) {
        //     return $next($request);
        // }

        return response()->json([
            'message' => 'Authentication Successful',
            'data' => $user->makeHidden(['password'])
        ]);
    }
}
