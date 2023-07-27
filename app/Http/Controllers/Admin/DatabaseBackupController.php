<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\Admin\DatabaseBackupControllerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Storage;
use File;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogHelper;

class DatabaseBackupController extends Controller implements DatabaseBackupControllerInterface
{
    public function download()
    {
        $artisan = Artisan::call('backup:run');

        if ($artisan == 0) {

            ActivityLogHelper::save(
                'Database Backup', 
                'Download Database Backup', 
                request()->ip(),
                auth()->user()->id
            );

            return response()->json([
                'message' => Artisan::output(),
                'code'    => 200
            ]);
        }

        return response()->json([
            'message' => 'Database backup failed. Contact your web admin to fix the issue.\n',
            'code'    => 500
        ]);
    }

}