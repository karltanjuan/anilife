<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\Settings\ActivityLogControllerInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivityLogExport;
use App\Models\ActivityLog;
use App\Models\User;
use App\Helpers\ActivityLogHelper;
use Carbon\Carbon;
use Storage;
use PDF;

class ActivityLogController extends Controller implements ActivityLogControllerInterface
{
    public function index($module, $log_type, $date_from, $date_to)
    {
        $activity_logs = $this->activityLogQueries($module, $log_type, $date_from, $date_to);

        return view('admin.settings.activity-logs', ['activity_logs' => $activity_logs]);
    }

    public function exportExcel($module, $log_type, $date_from, $date_to)
    {
        $activity_logs = $this->activityLogQueries($module, $log_type, $date_from, $date_to);

        ActivityLogHelper::save(
            'Activity Logs', 
            'Export Excel', 
            request()->ip(),
            auth()->user()->id
        );

        $filename = "anilife-activity-logs-".date("Y-m-d").".csv";

        return Excel::download(new ActivityLogExport($activity_logs), $filename);
    }

    public function exportPDF($module, $log_type, $date_from, $date_to)
    {   
        $activity_logs = $this->activityLogQueries($module, $log_type, $date_from, $date_to);

        ActivityLogHelper::save(
            'Activity Logs', 
            'Export PDF', 
            request()->ip(),
            auth()->user()->id
        );

        $pdf = PDF::loadView('admin.export_pdf.activity-log', ['activity_logs' => $activity_logs])->setPaper('a4', 'landscape');
        $filename = "anilife-activity-log-".date("Y-m-d").".pdf";

        return $pdf->stream($filename);
    }

    public function activityLogQueries($module, $log_type, $date_from, $date_to)
    {
        return ActivityLog::when($module, function($query) use ($module){
                if ($module != "All") {
                    return $query->where('activity_logs.module', $module);
                }
            })
            ->when($log_type, function($query) use ($log_type){
                if ($log_type != "All") {
                    return $query->where('activity_logs.log_type', $log_type);
                }
            })
            ->when($date_from, function($query) use ($date_from, $date_to){
                return $query->whereDate('activity_logs.created_at', '>=', $date_from)
                             ->whereDate('activity_logs.created_at', '<=', $date_to);
            })
            ->select('activity_logs.module', 'activity_logs.log_type', 'activity_logs.ip_address', 'activity_logs.created_at', 'users.first_name', 'users.middle_name', 'users.last_name')
            ->join('users', 'activity_logs.created_by', '=', 'users.id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

}
