<?php

namespace App\Http\Controllers\Interfaces\Customer;

use Illuminate\Http\Request;

interface AuthControllerInterface
{   
    public function getRegister();
    public function postRegister(Request $request); 
    public function validateRegister($request);
    public function getVerifyEmail($token);
    public function postVerifyEmail(Request $request);
    public function getLogin();
    public function postLogin(Request $request);
    public function validateLogin(Request $request);
    public function getforgotPassword();
    public function postforgotPassword(Request $request);
    public function validateForgotPassword($request);
    public function getResetPassword($token);
    public function postResetPassword(Request $request);

    public function logout();
    
}
