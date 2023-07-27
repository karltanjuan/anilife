<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Customer\PetControllerInterface;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\PetBreed;
use Carbon\Carbon;
use Validator;
use Storage;

class PetController extends Controller implements PetControllerInterface
{
    public function index()
    {
        $pets   = Pet::orderBy('created_at', 'desc')->where('owner_id', auth()->user()->id)->get();
        $types  = PetType::orderBy('type', 'asc')->get();
        $breeds = PetBreed::orderBy('type', 'asc')->get();
        
        $data = [
            'pets'   => $pets,
            'types'  => $types,
            'breeds' => $breeds
        ];

        return view('customer.pets', $data);
    }

    public function store(Request $request) {

        if ($request->type == "null") {
            $request->type = null;
        }

        if ($request->breed == "null") {
            $request->breed = null;
        }

        $validator = $this->validatePet($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // upload photo
        $path = null;
        $image_name = null;
        if ($request->file('photo')) {
            $image_path = $request->file('photo');
            $image_name = uniqid().md5(auth()->user()->id).$image_path->getClientOriginalName();
            $path = $request->file('photo')->storeAs('public/images/pets', $image_name);
        }

        // save to database
        $pet = new Pet();
        $pet->owner_id        = auth()->user()->id;
        $pet->name            = $request->name;
        $pet->photo           = $image_name;
        $pet->type            = $request->type;
        $pet->breed           = $request->breed;
        $pet->other_breed     = $request->other_breed == null ? 'NA' : $request->other_breed;
        $pet->age             = $request->age;
        $pet->medical_history = $request->medical_history;
        $pet->save();

        if ($pet) {
            return response()->json([
                'message' => 'Pet created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function update(Request $request) {
        $validator = $this->validatePet($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        $pet_image = Pet::where('id', $request->id)->get();
        $image_name = $pet_image[0]['photo'];

        if($request->file('photo') != null)  {
            // upload photo
            $path = null;
            if ($request->file('photo')) {
                $image_path = $request->file('photo');
                $image_name = uniqid().md5(auth()->user()->id).$image_path->getClientOriginalName();
                $path = $request->file('photo')->storeAs('public/images/pets', $image_name);
            }
        }

        // update to database
        $pet = Pet::where('id', $request->id);
        $pet->update([
            'name'            => $request->name,
            'photo'           => $image_name,
            'type'            => $request->type,
            'breed'           => $request->breed,
            'other_breed'     => $request->other_breed == null ? 'NA' : $request->other_breed,
            'age'             => $request->age,
            'medical_history' => $request->medical_history
        ]);

        if ($pet) {
            return response()->json([
                'message' => 'Pet updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validatePet($request) {
        return Validator::make($request->all(), [ 
            'name'            => ['required', 'string'],
            'age'             => ['required', 'numeric'],
            // 'type'            => ['required', 'string'],
            // 'breed'           => ['required', 'string'],
            // 'other_breed'     => ['required', 'string'],
            'medical_history' => ['required', 'string'],
            // 'photo'           => ['nullable', 'file'],
        ]);
    }

    public function delete(Request $request)
    {
        $pet = Pet::where('id', $request->id)->delete();
        
        return response()->json([
            'message' => 'Pet deleted successfully!',
            'code'    => '200'
        ], 200);
        
    }

    public function getId(Request $request)
    {
        $pet = Pet::where('id', $request->id)->get();
        return response()->json(['pet' => $pet]);
    }

    public function getBreedByType(Request $request)
    {
        $breeds = PetBreed::where('type', $request->type)->orderBy('breed', 'asc')->get();
        return response()->json(['breeds' => $breeds]);
    }

}
