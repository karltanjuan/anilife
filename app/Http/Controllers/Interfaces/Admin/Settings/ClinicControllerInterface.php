<?php

namespace App\Http\Controllers\Interfaces\Admin\Settings;

use Illuminate\Http\Request;

interface ClinicControllerInterface
{
    public function index();
    public function update(Request $request);
    public function validateUpdate($request);
    public function getId(Request $request);
}
