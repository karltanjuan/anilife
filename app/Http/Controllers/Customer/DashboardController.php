<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Customer\DashboardControllerInterface;
use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\BusinessPermit;
use App\Models\BlotterRecord;
use App\Models\Request as DocumentRequest;
use App\Models\Document;


class DashboardController extends Controller implements DashboardControllerInterface
{
    public function index()
    {
        return view('customer.dashboard');
    }

    public function view()
    {
        $data = [
            'population_count'      => Resident::whereNotNull('confirmed_at')->count(),
            'voters_count'          => Resident::whereNotNull('confirmed_at')->where('voter_status', 1)->count(),
            'non_voters_count'      => Resident::whereNotNull('confirmed_at')->where('voter_status', 2)->count(),
            'pwd_count'             => Resident::whereNotNull('confirmed_at')->where('pwd', 1)->count(),
            'senior_citizen_count'  => Resident::whereNotNull('confirmed_at')->where('age', '>=', 60)->count(),
            'establishment_count'   => BusinessPermit::where('expired_at', '>', date('Y-m-d'))->count(),
            'blotter_count'         => BlotterRecord::count(),
            'employed_count'        => Resident::whereNotNull('confirmed_at')->where('employment_status', 1)->count(),

            'indigency_count'       => $this->documentRequestCount('i'),
            'clearance_count'       => $this->documentRequestCount('c'),
            'residency_count'       => $this->documentRequestCount('r'),
            'business_permit_count' => $this->documentRequestCount('b'),

            'male_count'            => Resident::whereNotNull('confirmed_at')->where('sex', 1)->count(),
            'female_count'          => Resident::whereNotNull('confirmed_at')->where('sex', 2)->count(),
        ];

        return response()->json($data);

    }

    public function documentRequestCount($acronym)
    {
        return Document::where('document_type', $acronym)
            ->join('document_requests', 'documents.request_id', '=', 'document_requests.id')
            ->whereNotNull('document_requests.confirmed_at')
            ->where('status', 0)
            ->count();
    }

}
