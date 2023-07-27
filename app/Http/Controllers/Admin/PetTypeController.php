<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\PetTypeControllerInterface;
use App\Helpers\ActivityLogHelper;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\PetType;
use Carbon\Carbon;
use Validator;
use Storage;

class PetTypeController extends Controller implements PetTypeControllerInterface
{
    public function index()
    {
        $pet_types = PetType::orderBy('created_at', 'desc')->get();
        return view('admin.pet_types', ['pet_types' => $pet_types]);
    }

    public function store(Request $request) {
        $validator = $this->validatePetType($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // save to database
        $pet_type = new PetType();
        $pet_type->type = $request->type;
        $pet_type->save();

        ActivityLogHelper::save(
            'Pet Types', 
            'Create', 
            request()->ip(),
            auth()->user()->id
        );


        if ($pet_type) {
            return response()->json([
                'message' => 'Pet Type created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function update(Request $request) {
        $validator = $this->validatePetType($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // update to database
        $pet_type = PetType::where('id', $request->id);
        $pet_type->update([
            'type' => $request->type,
        ]);

    
        ActivityLogHelper::save(
            'Pet Types', 
            'Update', 
            request()->ip(),
            auth()->user()->id
        );

        if ($pet_type) {
            return response()->json([
                'message' => 'Pet Type updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validatePetType($request) {
        return Validator::make($request->all(), [ 
            'type' => ['required', 'string'],
        ]);
    }

    public function delete(Request $request)
    {
        $pet_type = PetType::where('id', $request->id)->delete();

        ActivityLogHelper::save(
            'Pet Types', 
            'Delete', 
            request()->ip(),
            auth()->user()->id
        );

        return response()->json([
            'message' => 'Pet Type deleted successfully!',
            'code'    => '200'
        ], 200);
        
    }

    public function getId(Request $request)
    {
        $pet_type = PetType::where('id', $request->id)->get();
        return response()->json(['pet_type' => $pet_type]);
    }

}
