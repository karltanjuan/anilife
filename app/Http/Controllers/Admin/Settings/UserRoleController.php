<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\Settings\UserRoleControllerInterface;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogHelper;
use Carbon\Carbon;
use Validator;

class UserRoleController extends Controller implements UserRoleControllerInterface
{
    public function index()
    {
        $user_roles = UserRole::orderBy('updated_at', 'desc')->get();
        return view('admin.settings.user-roles', ['user_roles' => $user_roles]);
    }

    public function store(Request $request) {
        $validator = $this->validateRole($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // save to database
        $user_role = new UserRole();
        $user_role->role_name = $request->role_name;
        $user_role->status    = $request->status;
        $user_role->save();

        ActivityLogHelper::save(
            'User Roles', 
            'Create', 
            request()->ip(),
            auth()->user()->id
        );

        if ($user_role) {
            return response()->json([
                'message' => 'User role created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function update(Request $request) {
        $validator = $this->validateRole($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // update to database
        $user_role = UserRole::where('id', $request->id);
        $user_role->update([
            'role_name' => $request->role_name,
            'status'    => $request->status,
        ]);

        ActivityLogHelper::save(
            'User Role', 
            'Update', 
            request()->ip(),
            auth()->user()->id
        );

        if ($user_role) {
            return response()->json([
                'message' => 'User role updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateRole($request) {
        return Validator::make($request->all(), [ 
            'role_name' => ['required', 'string'],
            'status'    => ['required', 'numeric'],
        ]);
    }

    public function deleteUserRole(Request $request)
    {   
        $user_role = UserRole::find($request->id);
        $user_role->delete();

        ActivityLogHelper::save(
            'User Roles', 
            'Delete', 
            request()->ip(),
            auth()->user()->id
        );

        return response()->json([
            'message' => 'User role deleted successfully!',
            'code'    => '200'
        ], 200);
        
    }

    public function getUserRoleById(Request $request)
    {
        $user_role = UserRole::where('id', $request->id)->get();
        return response()->json(['user_role' => $user_role]);
    }

}
