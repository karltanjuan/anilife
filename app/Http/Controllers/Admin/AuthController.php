<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\AuthControllerInterface;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogHelper;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class AuthController extends Controller implements AuthControllerInterface
{
    public function getLogin()
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }

    public function postLogin(Request $request)
    {

        $validator = $this->validateLogin($request);
        $response = response()->json(['message' => 'Invalid username or password', 'code' => '422']);

        if (!$validator->passes()) {
            return response()->json(['message' => $validator->errors()->all(), 'code' => '422']);
        }

        $user = User::where('username', $request->username)
                    ->where('status', 1)
                    ->where('role', 1)
                    ->orWhere('role', 2)
                    ->first();

        if (!$user) {
            return $response;
        }

        if (!Hash::check($request->password, $user->password)) {
            return $response;
        }

        Auth::login($user);

        ActivityLogHelper::save(
            'User Login', 
            'Login', 
            request()->ip(),
            auth()->user()->id
        );

        return response()->json(['message' => 'Login successfully!', 'code' => '200']);        

    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function validateLogin(Request $request)
    {
         return Validator::make($request->all(), [ 
            'username' => 'required|string',
            'password' => ['required', 'string', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'captcha'  => ['required', 'captcha']
        ]);
    }

    public function getforgotPassword()
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.forgot-password');
        
    }

    public function postforgotPassword(Request $request)
    {
    
        $validator = $this->validateForgotPassword($request);
        $response = response()->json(['message' => 'Email address not found', 'code' => '422']);

        if (!$validator->passes()) {
            return $response;
        }

        $user = User::where('email_address', $request->email_address)->first();

        if (!$user) {
            return $response;
        }

        $token = $user->username.md5(rand(1, 10) . microtime());
        $token_expired_at = Carbon::now()->addDay(1)->format("Y-m-d");

        $user_token = User::where('email_address', $request->email_address)
                      ->update([
                        'token'            => $token,
                        'token_expired_at' => $token_expired_at
                      ]);

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $operating_system = "";
        $browser = "";

        if (preg_match('/linux/i', $agent)) {
            $operating_system = 'Linux OS';
        } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $agent)) {
            $operating_system = 'Mac OS';
        } elseif (preg_match('/windows|win32|win98|win95|win16/i', $agent)) {
            $operating_system = 'Windows OS';
        } elseif (preg_match('/ubuntu/i', $operating_system)) {
            $operating_system = 'Ubuntu OS';
        }

        if(preg_match('/MSIE/i',$agent) && !preg_match('/Opera/i',$agent)){
            $browser = 'Internet Explorer';
        }elseif(preg_match('/Firefox/i',$agent)){
            $browser = 'Mozilla Firefox';
        }elseif(preg_match('/OPR/i',$agent)){
            $browser = 'Opera';
        }elseif(preg_match('/Chrome/i',$agent) && !preg_match('/Edge/i',$agent)){
            $browser = 'Google Chrome';
        }elseif(preg_match('/Safari/i',$agent) && !preg_match('/Edge/i',$agent)){
            $browser = 'Apple Safari';
        }elseif(preg_match('/Netscape/i',$agent)){
            $browser = 'Netscape';
        }elseif(preg_match('/Edge/i',$agent)){
            $browser = 'Edge';
        }elseif(preg_match('/Trident/i',$agent)){
            $browser = 'Internet Explorer';
        }

        // Sent to email here
        Mail::to($request->email_address)
            ->send(new ForgotPassword(
                $user->username,
                $request->email_address,
                $token,
                $operating_system,
                $browser
            )
        );

        return response()->json(['message' => 'Reset password emailed successfully. Kindly check your inbox.', 'code' => '200']);        

    }

    public function validateForgotPassword($request) {
        return Validator::make($request->all(), [ 
            'email_address'     => 'required|email',
        ]);
    }

    public function getResetPassword($token)
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        }

        $token = User::where('token', $token)
                ->where('token_expired_at', '>', date('Y-m-d'))
                ->first();

        if (!$token) {
            return view('admin.reset-password-expired');
        }

        return view('admin.reset-password');
    }

    public function postResetPassword(Request $request)
    {
        $user = User::where('token', $request->reset_token)
                ->where('token_expired_at', '>', date('Y-m-d'))
                ->first();

        if (!$user) {
            return response()->json([
                'error' => ['Token link is expired.'],
                'code'  => '422'
            ]);
        }

        $validator = $this->validateResetPassword($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }   

        $user = User::where('id', $user->id)
                    ->update([
                        'password'          => Hash::make($request->new_password, ['rounds' => 12]),
                        'token'             => null,
                        'token_expired_at'  => null
                    ]);
        
        return response()->json([
            'message' => 'Password reset successfully',
            'code'    => '200'
        ]);
        
    }

    public function logout()
    {
        if (isset(auth()->user()->id)) {
            ActivityLogHelper::save(
                'User Logout', 
                'Logout', 
                request()->ip(),
                auth()->user()->id
            );
        }

        Session::flush();
        Auth::logout();
        return redirect('/admin/login');
    }

    public function validateResetPassword(Request $request) {
        return Validator::make($request->all(), [
            'new_password'          => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'password_confirmation' => ['required', 'same:new_password']
        ]);
    }
  
}
