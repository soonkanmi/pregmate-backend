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

        $user = User::with([
                'personal_information',
                'obstetrical_information',
                'medical_information',
                'pregnancy_information',
                'vitals'
            ])->isUser()->isActive()
            ->where('email', $request->input('email'))
            ->first();

        return response()->json([
            'message' => 'Authentication Successful',
            'data' => $user->makeHidden(['password'])
        ]);
    }
}
