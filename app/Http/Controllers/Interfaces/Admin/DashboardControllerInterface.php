<?php

namespace App\Http\Controllers\Interfaces\Admin;

use Illuminate\Http\Request;

interface DashboardControllerInterface
{
    public function index();
    public function view();
    public function getWeeklyAppointment();
    
}
