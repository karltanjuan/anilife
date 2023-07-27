<?php

namespace App\Http\Controllers\Interfaces;

use Illuminate\Http\Request;

interface HomeControllerInterface
{

    public function index();
    public function getInquiry();
    public function postInquiry(Request $request);
    public function validatePostInquiry($request);
    
}
