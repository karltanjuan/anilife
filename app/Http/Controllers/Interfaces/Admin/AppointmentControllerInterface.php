<?php

namespace App\Http\Controllers\Interfaces\Admin;

use Illuminate\Http\Request;

interface AppointmentControllerInterface
{
    public function index();
    public function getPets(Request $request);
    public function getServices();
    public function update(Request $request);
    public function getId(Request $request);
}