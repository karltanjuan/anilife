<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Customer\AppointmentControllerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerUpdateAppointmentEmail;
use App\Mail\PaymentAcknowledgementEmail;
use App\Models\User;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\PetBreed;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Clinic;
use Carbon\Carbon;
use Validator;
use Storage;
use DB;

class AppointmentController extends Controller implements AppointmentControllerInterface
{
    public function index()
    {
        $customer     = User::where('id', auth()->user()->id)->get()[0];
        $setting      = Clinic::get()[0]; // 18
        $appointments = Appointment::where('email_address', auth()->user()->email_address)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $all_appointments = Appointment::whereDate('scheduled_at', '>', '"'.date('Y-m-d').'"')
                                        ->whereIn('status', [0,1,3]) // except cancelled status
                                        ->orderBy('created_at', 'desc')
                                        ->get();
                                        // ->pluck('scheduled_at');

        $appointment_arr = [];

        foreach ($all_appointments as $appointment) {
            array_push($appointment_arr, strtok($appointment->scheduled_at, " "));
        }

        return view('customer.appointments', [
            'customer'        => $customer,
            'appointments'    => $appointments,
            'appointment_arr' => array_count_values($appointment_arr),
            'setting'         => $setting
        ]);
    }

    public function verifyTimeslot(Request $request)
    {
        $date      = $request->date_slot;
        $appointments = Appointment::whereDate('scheduled_at', $date)
                                    ->where('status', '!=', [2,3])
                                    ->get();

        $booked_timeslots = $appointments->map(function ($appointment) {
            return date('g:i a', strtotime($appointment->scheduled_at));
        })->toArray();

        return response()->json($booked_timeslots);
    }

    public function getPets() {
        $pets = Pet::where('owner_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

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

    public function store(Request $request) {
        if ($request->payment_option == "Cash") {
            $validator = $this->validateAppointmentCash($request);
        } else {
            $validator = $this->validateAppointmentGCash($request);
        }

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // upload screenshot

        if ($request->payment_option == "Cash") {
            $image_name = "";
            $reference_no = "";
        } else {
            $path = null;
            $image_name = null;
            if ($request->file('payment_screenshot')) {
                $image_path = $request->file('payment_screenshot');
                $image_name = uniqid().md5(auth()->user()->id).$image_path->getClientOriginalName();
                $path = $request->file('payment_screenshot')->storeAs('public/images/screenshot', $image_name);
            }

            $reference_no = $request->payment_reference_no;
        }
        
        $appointment_code = 'AP-'.strtoupper(uniqid());
        $scheduled_at = $request->scheduled_at;
        // save to database
        $appointment = new Appointment();
        $appointment->code                 = $appointment_code;
        $appointment->customer_name        = $request->customer_name;
        $appointment->contact_no           = $request->contact_no;
        $appointment->email_address        = $request->email_address;
        $appointment->appointment_details  = $request->appointment_details;
        $appointment->payment_amount       = $request->payment_amount; // bugs here, need to store as string, not obj
        $appointment->payment_option       = $request->payment_option;
        $appointment->payment_reference_no = $reference_no;
        $appointment->payment_screenshot   = $image_name;
        $appointment->status               = 0; // Pending
        $appointment->scheduled_at         = $scheduled_at;
        $appointment->save();

        
        $admin = User::where('role', 1)->get()[0];
        Mail::to($admin->email_address)
            ->send(new CustomerUpdateAppointmentEmail(
                $appointment_code,
                $request->customer_name,
                $scheduled_at,
                date('Y-m-d H:i:s'),
                'Pending'
            )
        );

        if ($request->payment_option == "GCash") {
            Mail::to($request->email_address)
                ->send(new PaymentAcknowledgementEmail(
                    $appointment_code,
                    $request->customer_name,
                    $scheduled_at,
                    'Pending',
                    $appointment->payment_option,
                    $appointment->payment_amount,
                    $appointment->payment_reference_no,
                )
            );
        }

        if ($appointment) {
            return response()->json([
                'message' => 'Your appointment has been booked successfully',
                'code'    => '200'
            ]);
        }
    }

    public function update(Request $request) {
    
        // update to database
        $appointment = Appointment::where('id', $request->id);
        $appointment->update([
            'status'        => 2,
            'cancel_reason' => 'Cancelled by Customer'
        ]);

        $appointment = Appointment::where('id', $request->id)->get()[0];

        $admin = User::where('role', 1)->get()[0];
        Mail::to($admin->email_address)
            ->send(new CustomerUpdateAppointmentEmail(
                $appointment->code,
                $appointment->customer_name,
                $appointment->scheduled_at,
                $appointment->updated_at,
                'Cancelled'
            )
        );

        if ($appointment) {
            return response()->json([
                'message' => 'Appointment cancelled successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateAppointmentCash($request) {
        return Validator::make($request->all(), [ 
            'payment_amount'       => ['required', 'string'],
        ]);
    }

    public function validateAppointmentGCash($request) {
        return Validator::make($request->all(), [ 
            'payment_amount'       => ['required', 'string'],
            // 'payment_option'       => ['required', 'string'],
            'payment_reference_no' => ['required', 'string'],
            'payment_screenshot'   => ['required', 'mimes:jpeg,jpg,png'],
        ]);
    }

    public function getId(Request $request)
    {
        $appointment = Appointment::where('id', $request->id)->get();
        return response()->json(['appointment' => $appointment]);
    }

    public function reschedule(Request $request) {
        // update to database
        $appointment = Appointment::where('id', $request->id);
        $appointment->update([
            'scheduled_at' => $request->scheduled_at,
            'status'       => 0,
            'updated_at'   => date('Y-m-d H:i:s')
        ]);

        if ($appointment) {
            return response()->json([
                'message' => 'Appointment reschedule successfully',
                'code'    => '200'
            ]);
        }
    }

    public function getAllAppointments() {
        $setting      = Clinic::get()[0]; // 18
        $all_appointments = Appointment::whereDate('scheduled_at', '>', '"'.date('Y-m-d').'"')
                                        ->whereIn('status', [0,1,3]) // except cancelled status
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        $appointment_arr = [];

        foreach ($all_appointments as $appointment) {
            array_push($appointment_arr, strtok($appointment->scheduled_at, " "));
        }

        return response()->json([
            'appointment_arr' => array_count_values($appointment_arr),
            'setting' => $setting
        ]);
    }

}
