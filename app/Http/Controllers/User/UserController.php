<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserVital;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UserPregnancyInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMedicalInformation;
use App\Models\UserPersonalInformation;
use App\Models\UserObstetricalInformation;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = User::isActive()->isUser()
            ->with(['personal_information', 'obstetrical_information', 'medical_information', 'pregnancy_information'])
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
            ->with(['personal_information', 'obstetrical_information', 'medical_information', 'pregnancy_information'])
            ->find(auth()->id());

        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone')
        ]);

        // if ($user->name !== $request->input('name')) {
        //     $user-> = ;
        //     $user->save();
        // }

        // $user->phone = $request->input('phone');
        // $user->save();

        return response()->json([
            'message' => 'Personal information updated successfully',
            'data' => $user
        ]);
    }

    public function updateObstetricalInformation(Request $request)
    {
        $this->validate($request, [
            'previous_pregnancies' => 'required',
            'liveborns' => 'required',
            'stillbirths' => 'required',
            'previous_mode_of_delivery' => 'required'
        ], [
            'previous_pregnancies' => 'No. of pevious pregnancies is required',
            'liveborns' => 'No. of live borns is required',
            'stillbirths' => 'No. of still  births is required',
            'previous_mode_of_delivery' => 'Previous mode of delivery is required'
        ]);

        UserObstetricalInformation::updateOrCreate([
            'user_id' => auth()->id()
        ], [
            'previous_pregnancies' => $request->input('previous_pregnancies'),
            'liveborns' => $request->input('liveborns'),
            'stillbirths' => $request->input('stillbirths'),
            'previous_mode_of_delivery' => $request->input('previous_mode_of_delivery')
        ]);

        $user = User::isActive()->isUser()
            ->with(['personal_information', 'obstetrical_information', 'medical_information', 'pregnancy_information'])
            ->find(auth()->id());

        return response()->json([
            'message' => 'Obstetrical information updated successfully',
            'data' => $user
        ]);
    }

    public function updateMedicalInformation(Request $request)
    {
        $this->validate($request, [
            'bloodgroup' => 'required',
            'rhesus_factor' => 'required'
        ],[
            'bloodgroup' => 'Blood Group is required',
            'rhesus_factor' => 'Rhesus Factor is required',
        ]);

        UserMedicalInformation::updateOrCreate([
            'user_id' => auth()->id()
        ], [
            'bloodgroup' => $request->input('bloodgroup'),
            'rhesus_factor' => $request->input('rhesus_factor'),
            'allergies' => $request->input('allergies'),
        ]);

        $user = User::isActive()->isUser()
            ->with(['personal_information', 'obstetrical_information', 'medical_information', 'pregnancy_information'])
            ->find(auth()->id());

        return response()->json([
            'message' => 'Medical information updated successfully',
            'data' => $user
        ]);
    }

    public function savePregnancyInformation(Request $request)
    {
        $this->validate($request, [
            'date_concieved' => 'required',
        ],[
            'date_concieved' => 'Date Concieved is required',
        ]);

        UserPregnancyInfo::updateOrCreate([
            'user_id' => auth()->id()
        ], [
            'date_concieved' => (new Carbon($request->input('date_concieved')))->format('Y-m-d'),
            'first_trimester_ends' => (new Carbon($request->input('first_trimester_ends')))->format('Y-m-d'),
            'second_trimester_ends' => (new Carbon($request->input('second_trimester_ends')))->format('Y-m-d'),
            'estimated_due_date' => (new Carbon($request->input('estimated_due_date')))->format('Y-m-d'),
            'delivery_status' => false
        ]);

        $user = User::isActive()->isUser()
            ->with(['personal_information', 'obstetrical_information', 'medical_information', 'pregnancy_information'])
            ->find(auth()->id());

        return response()->json([
            'message' => 'Pregnancy information saved successfully',
            'data' => $user
        ]);
    }

    public function recordVitals(Request $request)
    {
        $this->validate($request, [
            'weight' => 'required',
            'blood_pressure_systolic' => 'required',
            'blood_pressure_diastolic' => 'required',
            'temperature' => 'required',
            'fluid_intake' => 'required'
        ],[
            'weight' => 'Weidht is required',
            'blood_pressure_systolic' => 'Blood Pressure systolic is required',
            'blood_pressure_diastolic' => 'Blood Pressure diastolic is required',
            'temperature' => 'Temperature is required',
            'fluid_intake' => 'Fluid intake is required'
        ]);

        auth()->user()->vitals()->create([
            'weight' => $request->input('weight'),
            'blood_pressure_systolic' => $request->input('blood_pressure_systolic'),
            'blood_pressure_diastolic' => $request->input('blood_pressure_diastolic'),
            'temperature' => $request->input('temperature'),
            'fluid_intake' => $request->input('fluid_intake'),
            'drug_intake' => $request->input('drug_intake') ?? 0
        ]);

        $vitals = UserVital::whereUserId(auth()->id())->get();

        return response()->json([
            'message' => 'Vitals recorded successfully',
            'data' => $vitals
        ]);
    }

    public function getVitals(Request $request)
    {
        $vitals = UserVital::whereUserId(auth()->id())->get();

        return response()->json([
            'message' => 'Vitals loaded successfully',
            'data' => $vitals
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}
