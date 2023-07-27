<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\Settings\ClinicControllerInterface;
use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogHelper;
use Carbon\Carbon;
use Validator;

class ClinicController extends Controller implements ClinicControllerInterface
{

    public function index()
    {
        $clinic = Clinic::orderBy('updated_at', 'desc')->get();
        return view('admin.settings.clinic', ['clinic' => $clinic]);
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
        $clinic = Clinic::where('id', $request->id);
        $clinic->update([
            'clinic_hours_start' => $request->clinic_hours_start,
            'clinic_hours_end'   => $request->clinic_hours_end,
            'max_client'         => $request->max_client,
        ]);

        ActivityLogHelper::save(
            'Clinic', 
            'Update', 
            request()->ip(),
            auth()->user()->id
        );

        if ($clinic) {
            return response()->json([
                'message' => 'Clinic updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateUpdate($request) {
        return Validator::make($request->all(), [ 
            'clinic_hours_start' => ['required', 'string'],
            'clinic_hours_end'   => ['required', 'string'],
            'max_client'         => ['required', 'numeric'],
        ]);
    }

    public function getId(Request $request)
    {
        $clinic = Clinic::where('id', $request->id)->get();
        return response()->json(['clinic' => $clinic]);
    }


}
