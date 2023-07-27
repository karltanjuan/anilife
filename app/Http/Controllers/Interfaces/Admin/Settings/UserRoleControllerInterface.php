<?php

namespace App\Http\Controllers\Interfaces\Admin\Settings;

use Illuminate\Http\Request;

interface UserRoleControllerInterface
{
    public function index();
    public function store(Request $request);
    public function update(Request $request);
    public function validateRole($request);
    public function deleteUserRole(Request $request);
    public function getUserRoleById(Request $request);
    
}
