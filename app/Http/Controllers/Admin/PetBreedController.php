<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\PetBreedControllerInterface;
use App\Helpers\ActivityLogHelper;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\PetType;
use App\Models\PetBreed;
use Carbon\Carbon;
use Validator;
use Storage;

class PetBreedController extends Controller implements PetBreedControllerInterface
{
    public function index()
    {
        $pet_breeds = PetBreed::orderBy('created_at', 'desc')->get();
        return view('admin.pet_breeds', ['pet_breeds' => $pet_breeds]);
    }

    public function getPetTypes()
    {
        $pet_types = PetType::orderBy('type', 'asc')->get();
        return response()->json(['pet_types' => $pet_types]);
    }

    public function store(Request $request) {
        $validator = $this->validatePetBreed($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // save to database
        $pet_breed = new PetBreed();
        $pet_breed->type  = $request->type;
        $pet_breed->breed = $request->breed;
        $pet_breed->save();

        ActivityLogHelper::save(
            'Pet Breeds', 
            'Create', 
            request()->ip(),
            auth()->user()->id
        );


        if ($pet_breed) {
            return response()->json([
                'message' => 'Pet Breed created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function update(Request $request) {
        $validator = $this->validatePetBreed($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // update to database
        $pet_breed = PetBreed::where('id', $request->id);
        $pet_breed->update([
            'type' => $request->type,
            'breed' => $request->breed,
        ]);
    
        ActivityLogHelper::save(
            'Pet Breeds', 
            'Update', 
            request()->ip(),
            auth()->user()->id
        );

        if ($pet_breed) {
            return response()->json([
                'message' => 'Pet Breed updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validatePetBreed($request) {
        return Validator::make($request->all(), [ 
            'type' => ['required', 'string'],
            'breed' => ['required', 'string'],
        ]);
    }

    public function delete(Request $request)
    {
        $pet_breed = PetBreed::where('id', $request->id)->delete();

        ActivityLogHelper::save(
            'Pet Breeds', 
            'Delete', 
            request()->ip(),
            auth()->user()->id
        );

        return response()->json([
            'message' => 'Pet Breed deleted successfully!',
            'code'    => '200'
        ], 200);
    }

    public function getId(Request $request)
    {
        $pet_breed = PetBreed::where('id', $request->id)->get();
        return response()->json(['pet_breed' => $pet_breed]);
    }

}
