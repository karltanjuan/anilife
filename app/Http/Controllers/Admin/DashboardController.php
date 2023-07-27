<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\DashboardControllerInterface;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\PetType;
use App\Models\PetBreed;
use App\Models\Clinic;
use App\Models\Inquiry;
use Carbon\Carbon;


class DashboardController extends Controller implements DashboardControllerInterface
{
    public function index()
    {
        $setting      = Clinic::get()[0];
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

        return view('admin.dashboard', [
            'appointments'    => $appointments,
            'appointment_arr' => array_count_values($appointment_arr),
            'setting'         => $setting
        ]);
    }

    public function view()
    {

        $carbon = new Carbon();
        $today = $carbon->now()->format("Y-m-d");

        $data = [
            'services_count'  => Service::count(),
            'pending_count'   => Appointment::where('status', 0)->count(),
            'confirmed_count' => Appointment::where('status', 1)->count(),
            'cancelled_count' => Appointment::where('status', 2)->count(),
            'completed_count' => Appointment::where('status', 3)->count(),
            'inquiries_count' => Inquiry::where('created_at', 'like', '%'.$today.'%')->count(),
            'customer_count'  => User::where('role', 3)->where('status', 1)->count(),
            'type_count'      => PetType::count(),
            'breed_count'     => PetBreed::count(),
            'male_count'      => User::where('role', 3)->where('status', 1)->where('sex', 0)->count(),
            'female_count'    => User::where('role', 3)->where('status', 1)->where('sex', 1)->count(),
        ];

        return response()->json($data);

    }

    public function getWeeklyAppointment()
    {
        $daysOfWeek = [
            'Sunday', 
            'Monday', 
            'Tuesday', 
            'Wednesday', 
            'Thursday', 
            'Friday', 
            'Saturday'
        ];

        $startDate = Carbon::now()->startOfWeek();
        $endDate   = Carbon::now()->endOfWeek();

        $appointments = Appointment::where('status', 3)
            ->whereBetween('scheduled_at', [$startDate, $endDate])
            ->get();

        $appointmentsPerDay = array_fill_keys($daysOfWeek, 0);

        foreach ($appointments as $appointment) {
            $dayOfWeek = Carbon::parse($appointment->scheduled_at)->format('l');
            $appointmentsPerDay[$dayOfWeek]++;
        }

        $result = [];

        foreach ($appointmentsPerDay as $dayOfWeek => $numAppointments) {
            $result[] = [
                'day'   => $dayOfWeek, 
                'count' => $numAppointments
            ];
        }

        return response()->json($result);
    }

    // public function documentRequestCount($acronym)
    // {
    //     return Document::where('document_type', $acronym)
    //         ->join('document_requests', 'documents.request_id', '=', 'document_requests.id')
    //         ->whereNotNull('document_requests.confirmed_at')
    //         ->where('status', 0)
    //         ->count();
    // }

}
