<?php

namespace App\Http\Controllers\Interfaces\Customer;

use Illuminate\Http\Request;

interface AppointmentControllerInterface
{
    public function index();
    public function verifyTimeslot(Request $request);
    public function getPets();
    public function getServices();
    public function store(Request $request);
    public function update(Request $request);
    public function validateAppointmentCash($request);
    public function validateAppointmentGCash($request);
    public function getId(Request $request);
    public function reschedule(Request $request);
    public function getAllAppointments();
    
}