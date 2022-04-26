<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\UserPersonalInformation;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = User::isActive()->isUser()
            ->with(['personal_information'])
            ->find(auth()->id());

        return response()->json([
            'data' => $user
        ]);
    }

    public function updatePersonalInformation(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'date_of_birth' => 'required',
            'next_of_kin' => 'required',
            'address' => 'required',
            'occupation' => 'required'
        ], [
            'phone' => 'Phone number is required',
            'date_of_birth' => 'Date of birth is required',
            'next_of_kin' => 'Next of kin is required',
            'address' => 'Address is required',
            'occupation' => 'Occupation is required'
        ]);

        UserPersonalInformation::updateOrCreate([
            'user_id' => auth()->id()
        ], [
            'date_of_birth' => Carbon::createFromFormat('d-m-Y', $request->input('date_of_birth')),
            'next_of_kin' => $request->input('next_of_kin'),
            'address' => $request->input('address'),
            'occupation' => $request->input('occupation')
        ]);

        $user = User::isActive()->isUser()
            ->with(['personal_information'])
            ->find(auth()->id());

        $user->phone = $request->input('phone');
        $user->save();

        return response()->json([
            'message' => 'Personal information updated successfully',
            'data' => $user
        ]);
    }
}
