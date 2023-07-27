<?php

namespace App\Http\Controllers\Interfaces\Admin;

use Illuminate\Http\Request;

interface ServiceControllerInterface
{
    public function index();
    public function store(Request $request);
    public function update(Request $request);
    public function validateService($request);
    public function delete(Request $request);
    public function getId(Request $request);
}