<?php

namespace App\Http\Controllers\Interfaces\Customer;

use Illuminate\Http\Request;

interface PetHistoryControllerInterface
{
    public function index();
    public function getPetHistory(Request $id);
}