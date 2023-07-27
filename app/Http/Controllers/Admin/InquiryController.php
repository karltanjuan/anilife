<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\InquiryControllerInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InquiryExport;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogHelper;
use Carbon\Carbon;
use Storage;
use PDF;

class InquiryController extends Controller implements InquiryControllerInterface
{
    public function index($filter)
    {
        $carbon = new Carbon();
        $today = $carbon->now()->format("Y-m-d");
        $today_count = Inquiry::where('created_at', 'like', '%'.$today.'%')->count();
        $last_week_count = Inquiry::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->count();
        $inquiries = [];

        if ($filter == "all") {
            $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        } else if ($filter == "today") {
            $inquiries = Inquiry::where('created_at', 'like', '%'.$today.'%')
                            ->orderBy('created_at', 'desc')
                            ->get();
        } else if ($filter == "last-week") {
            $inquiries = Inquiry::whereBetween('created_at', [$carbon->now()->subWeek()->startOfWeek(), $carbon->now()->subWeek()->endOfWeek()])
                ->orderBy('created_at', 'desc')
                ->get();
        }


        return view('admin.inquiry', [
            'inquiries'       => $inquiries, 
            'today_count'     => $today_count,
            'last_week_count' => $last_week_count
        ]);
    }

    public function exportExcel($filter)
    {
        $carbon = new Carbon();
        $today = $carbon->now()->format("Y-m-d");
        $inquiries = [];

        if ($filter == "all") {
            $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        } else if ($filter == "today") {
            $inquiries = Inquiry::where('created_at', 'like', '%'.$today.'%')
                            ->orderBy('created_at', 'desc')
                            ->get();
        } else if ($filter == "last-week") {
            $inquiries = Inquiry::whereBetween('created_at', [$carbon->now()->subWeek()->startOfWeek(), $carbon->now()->subWeek()->endOfWeek()])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        ActivityLogHelper::save(
            'Inquiry', 
            'Export Excel', 
            request()->ip(),
            auth()->user()->id
        );

        $filename = "anilife-inquiries-".date("Y-m-d").".csv";
        return Excel::download(new InquiryExport($inquiries), $filename);
    }

    public function exportPDF($filter)
    {   
        $carbon = new Carbon();
        $today = $carbon->now()->format("Y-m-d");
        $inquiries = [];

        if ($filter == "all") {
            $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        } else if ($filter == "today") {
            $inquiries = Inquiry::where('created_at', 'like', '%'.$today.'%')
                            ->orderBy('created_at', 'desc')
                            ->get();
        } else if ($filter == "last-week") {
            $inquiries = Inquiry::whereBetween('created_at', [$carbon->now()->subWeek()->startOfWeek(), $carbon->now()->subWeek()->endOfWeek()])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        ActivityLogHelper::save(
            'Inquiry', 
            'Export PDF', 
            request()->ip(),
            auth()->user()->id
        );

        $pdf = PDF::loadView('admin.export_pdf.inquiry', ['inquiries' => $inquiries])->setPaper('a4', 'landscape');
        $filename = "anilife-inquiries-".date("Y-m-d").".pdf";
        return $pdf->stream($filename);
    }

}
