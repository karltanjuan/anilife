<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Customer\PetHistoryControllerInterface;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use Carbon\Carbon;
use Validator;
use Storage;

class PetHistoryController extends Controller implements PetHistoryControllerInterface
{
    public function index()
    {
        $pets   = Pet::orderBy('created_at', 'desc')->where('owner_id', auth()->user()->id)->get();
    
        $data = [
            'pets' => $pets,
        ];

        return view('customer.pets-history', $data);
    }

    public function getPetHistory(Request $request) {
        $appointments = Appointment::where('status', 3)
                            ->where('email_address', auth()->user()->email_address)
                            ->get();

        $histories = [];

        foreach ($appointments as $appointment) {
            foreach (json_decode($appointment['appointment_details']) as $details) {
                if ((int)$request->id == (int)$details->hidden_id) {
                    $histories[] = [
                        'pet_name'            => $details->pet_name,
                        'service_name'        => $details->service_name,
                        'service_description' => $details->service_description,
                        'service_price'       => $details->service_price,
                        'created_at'          => $appointment['created_at']
                    ];

                }
            }
        }

        return response()->json(['histories' => $histories]);
    }

}
