<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\ProfileControllerInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
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

        $path = null;
        $image_name = null;
        if ($request->file('photo')) {
            $image_path = $request->file('photo');
            $image_name = uniqid().md5(auth()->user()->id).$image_path->getClientOriginalName();
            $path = $request->file('photo')->storeAs('public/images/profile', $image_name);
        }

        // update to database
        $user = User::where('id', auth()->user()->id);
        $user->update([
            'first_name'    => $request->profile_first_name,
            'middle_name'   => $request->profile_middle_name,
            'last_name'     => $request->profile_last_name,
            'sex'           => $request->profile_sex,
            'username'      => $request->profile_username,
            'email_address' => $request->profile_email_address,
            'contact_no'    => $request->profile_contact_no,
            'address'       => $request->profile_address,
            'photo'         => $image_name
        ]);

        if ($user) {
            return response()->json([
                'message' => 'Your profile is updated successfully',
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

        return response()->json([
            'message' => 'Your password is updated successfully',
            'code' => '200'
        ]);
    }

    public function validateUpdateProfile(Request $request) {
        return Validator::make($request->all(), [ 
            'profile_first_name'    => ['required', 'string'],
            'profile_last_name'     => ['required', 'string'],
            'profile_sex'        => ['required', 'numeric'],
            'profile_username'      => 'required|string|unique:users,username,'.auth()->user()->id.',id',
            'profile_email_address' => 'required|unique:users,email_address,'.auth()->user()->id.',id',
            'profile_contact_no'    => ['required', 'digits:11'],
            'profile_address'       => ['required', 'string'],
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
