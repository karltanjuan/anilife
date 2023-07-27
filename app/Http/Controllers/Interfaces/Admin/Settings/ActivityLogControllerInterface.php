<?php

namespace App\Http\Controllers\Interfaces\Admin\Settings;

use Illuminate\Http\Request;

interface ActivityLogControllerInterface
{
    public function index($module, $log_type, $date_from, $date_to);
    public function exportExcel($module, $log_type, $date_from, $date_to);
    public function exportPDF($module, $log_type, $date_from, $date_to);
    public function activityLogQueries($module, $log_type, $date_from, $date_t);
    
}
