<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Interfaces\HomeControllerInterface;
use App\Models\Inquiry;
use App\Models\BrgyOfficial;
use Validator;

class HomeController extends Controller implements HomeControllerInterface
{

    public function index()
    {
        return view('home');
    }

    public function getInquiry() {
        return view('main.inquiry');
    }

    public function postInquiry(Request $request) {
        $validator = $this->validatePostInquiry($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }

        // save to database
        $inquiry = new Inquiry();
        $inquiry->full_name = $request->full_name;
        $inquiry->email_address = $request->email_address;
        $inquiry->contact_no = $request->contact_no;
        $inquiry->message = $request->message;
        $inquiry->save();

        if ($inquiry) {
            return response()->json([
                'code' => '200'
            ]);
        }
    }

    public function validatePostInquiry($request) {
        return Validator::make($request->all(), [ 
            'full_name'     => ['required', 'string', 'min:2'],
            'email_address' => ['required', 'string', 'email', 'max:100'],
            'contact_no'    => ['required', 'digits:11'],
            'message'       => ['required', 'string']
        ]);
    }

}
