<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\AppointmentControllerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminUpdateAppointmentEmail;
use App\Models\User;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\PetBreed;
use App\Models\Service;
use App\Models\Appointment;
use Carbon\Carbon;
use Validator;
use Storage;

class AppointmentController extends Controller implements AppointmentControllerInterface
{
    public function index()
    {
        $appointments = Appointment::orderBy('created_at', 'desc')
                                    ->get();

        return view('admin.appointments', [
            'appointments' => $appointments
        ]);
    }

    public function getPets(Request $request) {
        $pets = Pet::where('owner_id', $request->id)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'pets' => $pets,
            'code' => '200'
        ]);
    }

    public function getServices() {
        $services  = Service::orderBy('name', 'asc')->get();
        
        return response()->json([
            'services'  =>  $services,
            'code' => '200'
        ]);
    }

    public function update(Request $request) {
    
        // update to database
        $appointment = Appointment::where('id', $request->id);
        $appointment->update([
            'status'        => $request->status,
        ]);

        $appointment = Appointment::where('id', $request->id)->get()[0];

        if ($request->status == 0) {
            $status = "Pending";
        } elseif ($request->status == 1) {
            $status = "Confirmed";
        } elseif ($request->status == 2) {
            $status = "Cancelled";
        } elseif ($request->status == 3) {
            $status = "Completed";
        } 

        Mail::to($appointment->email_address)
            ->send(new AdminUpdateAppointmentEmail(
                $appointment->code,
                $appointment->customer_name,
                $appointment->scheduled_at,
                $appointment->updated_at,
                $status
            )
        );

        if ($appointment) {
            return response()->json([
                'message' => 'Appointment updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function getId(Request $request)
    {
        $appointment = Appointment::where('id', $request->id)->get();
        return response()->json(['appointment' => $appointment]);
    }

}
