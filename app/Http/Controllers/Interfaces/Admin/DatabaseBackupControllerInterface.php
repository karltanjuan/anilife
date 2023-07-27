<?php

namespace App\Http\Controllers\Interfaces\Admin;

use Illuminate\Http\Request;

interface DatabaseBackupControllerInterface
{
    public function download();
    
}
