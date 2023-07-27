<?php

namespace App\Helpers;

use App\Models\ActivityLog;

class ActivityLogHelper
{
    public static function save($module, $log_type, $ip_address, $created_by)
    {
    	$log = new ActivityLog();
        $log->module     = $module;
        $log->log_type   = $log_type;
        $log->ip_address = $ip_address;
        $log->created_by = $created_by;
        $log->save();
    }

   
}
