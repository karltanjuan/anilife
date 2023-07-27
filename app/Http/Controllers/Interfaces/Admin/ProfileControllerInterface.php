<?php

namespace App\Http\Controllers\Interfaces\Admin;

use Illuminate\Http\Request;

interface ProfileControllerInterface
{
    public function updateProfile(Request $request);
    public function updatePassword(Request $request);
    public function validateUpdateProfile(Request $request);
    public function validateUpdatePassword(Request $request);
    
}
