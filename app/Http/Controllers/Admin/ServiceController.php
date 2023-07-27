<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\ServiceControllerInterface;
use App\Helpers\ActivityLogHelper;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Service;
use Carbon\Carbon;
use Validator;
use Storage;

class ServiceController extends Controller implements ServiceControllerInterface
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('admin.services', ['services' => $services]);
    }

    public function store(Request $request) {
        $validator = $this->validateService($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // save to database
        $service = new Service();
        $service->name        = $request->name;
        $service->description = $request->description;
        $service->price       = $request->price;
        $service->save();

        ActivityLogHelper::save(
            'Services', 
            'Create', 
            request()->ip(),
            auth()->user()->id
        );


        if ($service) {
            return response()->json([
                'message' => 'Service created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function update(Request $request) {
        $validator = $this->validateService($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // update to database
        $service = Service::where('id', $request->id);
        $service->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price
        ]);

    
        ActivityLogHelper::save(
            'Services', 
            'Update', 
            request()->ip(),
            auth()->user()->id
        );

        if ($service) {
            return response()->json([
                'message' => 'Service updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateService($request) {
        return Validator::make($request->all(), [ 
            'name'        => ['required', 'string'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'string'],
        ]);
    }

    public function delete(Request $request)
    {
        $service = Service::where('id', $request->id)->delete();

        ActivityLogHelper::save(
            'Services', 
            'Delete', 
            request()->ip(),
            auth()->user()->id
        );

        return response()->json([
            'message' => 'Service deleted successfully!',
            'code'    => '200'
        ], 200);
        
    }

    public function getId(Request $request)
    {
        $service = Service::where('id', $request->id)->get();
        return response()->json(['service' => $service]);
    }

}
