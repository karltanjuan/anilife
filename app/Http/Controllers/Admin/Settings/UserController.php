<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\Settings\UserControllerInterface;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogHelper;
use Carbon\Carbon;
use Validator;

class UserController extends Controller implements UserControllerInterface
{

    public function index()
    {
        $users = User::where('role', '!=', 3)->orderBy('updated_at', 'desc')->get();
        return view('admin.settings.users', ['users' => $users]);
    }

    public function store(Request $request) {
        $validator = $this->validateStore($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // save to database
        $user = new User();
        $user->first_name    = $request->first_name;
        $user->middle_name   = $request->middle_name;
        $user->last_name     = $request->last_name;
        $user->email_address = $request->email_address;
        $user->username      = $request->username;
        $user->password      = bcrypt($request->password);
        $user->contact_no    = $request->contact_no;
        // $user->position      = $request->position;
        $user->role          = $request->role;
        $user->status        = $request->status;
        $user->save();

        ActivityLogHelper::save(
            'Users', 
            'Create', 
            request()->ip(),
            auth()->user()->id
        );

        if ($user) {
            return response()->json([
                'message' => 'User created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function update(Request $request) {
        $validator = $this->validateUpdate($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // update to database
        $user = User::where('id', $request->id);
        $user->update([
            'first_name'    => $request->first_name,
            'middle_name'   => $request->middle_name,
            'last_name'     => $request->last_name,
            'email_address' => $request->email_address,
            'username'      => $request->username,
            // 'password'      => bcrypt($request->password),
            'contact_no'    => $request->contact_no,
            // 'position'      => $request->position,
            'role'          => $request->role,
            'status'        => $request->status,
        ]);

        ActivityLogHelper::save(
            'Users', 
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

    public function validateStore($request) {
        return Validator::make($request->all(), [ 
            'first_name'        => ['required', 'string'],
            'last_name'         => ['required', 'string'],
            'username'          => 'required|unique:users|string',
            'email_address'     => 'required|unique:users|email',
            'password'          => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'contact_no'        => ['required', 'digits:11'],
            // 'position'          => ['required', 'string'],
            'role'              => ['required', 'numeric'],
            'status'            => ['required', 'numeric'],
        ]);
    }

    public function validateUpdate($request) {

        return Validator::make($request->all(), [ 
            'first_name'        => ['required', 'string'],
            'last_name'         => ['required', 'string'],
            'username'          => 'required|string|unique:users,username,'.$request->id.',id',
            'email_address'     => 'required|unique:users,email_address,'.$request->id.',id',
            // 'password'          => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'contact_no'        => ['required', 'digits:11'],
            // 'position'          => ['required', 'string'],
            'role'              => ['required', 'numeric'],
            'status'            => ['required', 'numeric'],
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        ActivityLogHelper::save(
            'Users', 
            'Delete', 
            request()->ip(),
            auth()->user()->id
        );

        return response()->json([
            'message' => 'User deleted successfully!',
            'code'    => '200'
        ], 200);
        
    }

    public function getUserById(Request $request)
    {
        $user = User::where('id', $request->id)->get();
        return response()->json(['user' => $user]);
    }

}
