<?php

namespace App\Http\Controllers\Interfaces\Admin\Settings;

use Illuminate\Http\Request;

interface UserControllerInterface
{
    public function index();
    public function store(Request $request);
    public function update(Request $request);
    public function validateStore($request);
    public function validateUpdate($request);
    public function deleteUser(Request $request);
    public function getUserById(Request $request);
    
}
