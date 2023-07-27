<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\ProfileControllerInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogHelper;
use Validator;

class ProfileController extends Controller implements ProfileControllerInterface
{
    public function updateProfile(Request $request)
    {

        $validator = $this->validateUpdateProfile($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // update to database
        $user = User::where('id', auth()->user()->id);
        $user->update([
            'first_name'    => $request->profile_first_name,
            'middle_name'   => $request->profile_middle_name,
            'last_name'     => $request->profile_last_name,
            'username'      => $request->profile_username,
            'email_address' => $request->profile_email_address,
            'contact_no'    => $request->profile_contact_no,
        ]);

        ActivityLogHelper::save(
            'Profile', 
            'Update', 
            request()->ip(),
            auth()->user()->id
        );

        if ($user) {
            return response()->json([
                'message' => 'User updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = $this->validateUpdatePassword($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }   

        $user = User::where('id', auth()->user()->id)->first();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'error' => ['The current password is incorrect'],
                'code'  => '422'
            ]);
        }

        $user = User::where('id', auth()->user()->id)
                    ->update([
                        'password' => Hash::make($request->new_password, ['rounds' => 12])
                    ]);

        ActivityLogHelper::save(
            'Profile Password', 
            'Update', 
            request()->ip(),
            auth()->user()->id
        );
        
        return response()->json([
            'message' => 'Password updated successfully',
            'code' => '200'
        ]);
    }

    public function validateUpdateProfile(Request $request) {
        return Validator::make($request->all(), [ 
            'profile_first_name'    => ['required', 'string'],
            'profile_middle_name'   => ['required', 'string'],
            'profile_last_name'     => ['required', 'string'],
            'profile_username'      => 'required|string|unique:users,username,'.auth()->user()->id.',id',
            'profile_email_address' => 'required|unique:users,email_address,'.auth()->user()->id.',id',
            'profile_contact_no'    => ['required', 'digits:11'],
        ]);
    }

    public function validateUpdatePassword(Request $request) {
        return Validator::make($request->all(), [
            'current_password'      => ['required', 'string'],
            'new_password'          => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'password_confirmation' => ['required', 'same:new_password']
        ]);
    }

}
