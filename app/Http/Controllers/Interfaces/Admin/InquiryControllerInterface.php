<?php

namespace App\Http\Controllers\Interfaces\Admin;

use Illuminate\Http\Request;

interface InquiryControllerInterface
{
    public function index($filter);
    public function exportExcel($filter);
    public function exportPDF($filter);
}
