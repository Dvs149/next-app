<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use App\MSG;
use Unifonic;
use Validator;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;




class AuthController extends Controller
{


    public function registrationForm(Request $request){

        return View("auth.registration");

    }

    public function loginForm(Request $request){

        return View("auth.login");

    }

    public function forgotPassword(Request $request) {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if( $request->is('api/*')){
        
            if($status == Password::RESET_LINK_SENT){
                $arr = array("status" => true, "message" => "Password reset link sent successfully");

                // return response()->json(["message" => "Password reset link sent successfully"]);
                return response()->json($arr);
            }else{
                $arr = array("status" => false, "message" => "Something went wrong!");

                // return response()->json(["message" => "Something went wrong!"]);
                return response()->json($arr);
            }
        

        }else{

            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])->withSuccess('Mail sent successfully!')
                        : back()->withErrors(['email' => __($status)]);
        }

    }

    public function resetPassword(Request $request){

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if( $request->is('api/*')){
            
            if($status == Password::PASSWORD_RESET){
                return response()->json(["message" => "Password changed successfully"]);
            }else{
                return response()->json(["message" => "Something went wrong!"]);
            }

        }else{

            return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))->withSuccess('Password changed successfully!')
                    : back()->withErrors(['email' => [__($status)]]);    
        }
        
    }


    public function dashboard(Request $request){


        $total_user_count = User::where('role','user')->get()->count();
        $tot_standard_user_count = User::where('role','user')
                                ->where('type_of_account','Standard')
                                ->get()->count();
        $tot_Premium_user_count = User::where('role','user')
                                ->where('type_of_account','Premium')
                                ->get()->count();
        // dd($total_user_count,$tot_standard_user_count,$tot_Premium_user_count);
        $average_rate = round(Feedback::avg('rate'),1) ;
        $dashboard = [
                "total_user" => $total_user_count,
                "standard_user" => $tot_standard_user_count,
                "premium_user" => $tot_Premium_user_count,
                "average_rating" => $average_rate
            ];

        return View("admin.dashboard.dashboard",compact('dashboard'));

    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ],[
            'email.exists' => 'Email does not match.', 
        ]);

        $remember_me = ($request->remember_me) ? true : false;
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember_me)) {
            
            if( $request->is('api/*')){
                $user = Auth::user();
                $first_time = $user->first_time;
                if($first_time){
                    $user->first_time = 0;
                    $user->save();
                }

            	$device_name = ($request->device_name) ? $request->device_name : config("app.name");
                
                $arr = array("status" => true, "message" => "Login Successfully", "token" => Auth::user()->createToken($device_name)->plainTextToken , "first-time" => $first_time);

                return response()->json($arr);
            
            }else{

            	$request->session()->regenerate();
                if($request->expectsJson()){
                    return response()->json(["message" => "User logged in successfully!"]);
                }
            	// return redirect()->intended('/');
                return redirect()->route('admin.dashboard');
            }

        }else{
            
            throw ValidationException::withMessages(['The credentials are incorrect']);
        }

    }

    public function create_otp(Request $request){

        $validator = Validator::make($request->all(), 
            [
                'mobile' => 'required|numeric|min:9',
            ]);

        if ($validator->fails()) {
            $arr = array("status" => false, "message" => "Something went wrong", 'error'=>$validator->errors());
            return response()->json($arr, 422);
        } 

        $mobile = $request->mobile;

        $user = User::where('mobile', $mobile)->first();
        if ( !isset($user['mobile']) || $user['mobile'] =="" ) {
            $status_code = 422;
			$response['error'] = 1; 
			$response['message'] = 'Your number is not regiestered, please register first.';

            $arr = array("status" => false, "message" => $response['message'], 'error'=>$response['error']);

		} else {

			$otp = rand(100000, 999999);
            $user->otp = $otp;

            $msg = strip_tags( "NEXTAP-otp:" ).$otp;

            $user->save();

            // temporary commented sms service
            // $sms = Helper::CURLsendsms($mobile,$msg);

            //temporary email service instead of sms

            $details = [
                'title' => 'Nextap OTP:',
                'body' => $otp
            ];
            $mail_send = \Mail::to($user->email)->send(new \App\Mail\OTPMail($details));



			if(isset($sms) && !$sms && $mail_send){
                $status_code = 422;
				$response['error'] = 1;
				$response['message'] = "Something went wrong, try again";
                $arr = array("status" => false, "message" => $response['message'], 'error'=>$response['error']);
			}else{
                $status_code = 200;

				$response['error'] = 0;
				$response['message'] = 'Your OTP is created.';
                $arr = array("status" => true, "message" => $response['message'], 'error'=>$response['error']);
                
			}
		}

        return response()->json($arr, $status_code);
    }

    public function login_mobile(Request $request){

        // $request->validate([
            
        // ]);
        $input = $request->all();

        $rules = [
            'mobile' => 'required|numeric|exists:users,mobile',
            'otp' => 'required|numeric'
        ];

        $msg = [
            'mobile.exists' => 'Entered mobile is invalid.',
        ];

        $validator = Validator::make($input, $rules, $msg);
        if ($validator->fails()) {
            $arr = array("status" => false, "message" => "Login failed",'error'=>$validator->errors()  );
            return response()->json($arr,422);
        } 


        $mobile = $request->mobile;

        $user = User::where('mobile', $mobile)->first();
        $remember_me = ($request->remember_me) ? true : false;
        
        $credentials = $request->only('email', 'otp');
        
        if ($user->otp == $request->otp) {
            Auth::login($user);
            if( $request->is('api/*')){

            	$device_name = ($request->device_name) ? $request->device_name : config("app.name");
                $arr = array("status" => true, "message" => "Login Successfully", "token" => Auth::user()->createToken($device_name)->plainTextToken );
                return response()->json($arr, 200);

            }else{

            	$request->session()->regenerate();
                if($request->expectsJson()){
                    
                    return response()->json(["message" => "User logged in successfully!"]);
                }
            	// return redirect()->intended('/');
                return redirect()->route('admin.dashboard');

            }
        }else{
            throw ValidationException::withMessages(['The credentials are incorrect']);
        }

    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:App\Models\User,email|max:100',
            'password' => 'required|confirmed|min:6',
            'name' => 'required|max:25'
        ]);
        
        
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        
        if($request->path()=="admin/register"){
            $user->role = 'admin';
        }
        $user->save();

        

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            if( $request->is('api/*')){

            	$device_name = ($request->device_name) ? $request->device_name : config("app.name");
                $arr = array("status" => true, "message" => "Password reset link sent successfully","token" => Auth::user()->createToken($device_name)->plainTextToken);
                return response()->json($arr, 200);
            
            }else{

            	$request->session()->regenerate();
                if($request->expectsJson()){
                    return response()->json(["message" => "User registered successfully!"]);
                }
            	return redirect()->route('admin.dashboard');
            }
            
        }

        return response()->json(["email" => $request->email, "password" => $request->password], 422);
    }


    public function logout(Request $request){

        if( $request->is('api/*')){

        	Auth::user()->currentAccessToken()->delete();
    	
    	}else{
	        Auth::guard('web')->logout();
        	$request->session()->invalidate();
    		$request->session()->regenerateToken();

            if($request->expectsJson()){
                return response()->json(["message" => "User logged out successfully!"]);
            }
    	       
            return redirect()->route('login');
    	}

        return response()->noContent();
    }

    public function user(Request $request)
    {
        $arr = array("status" => true, "message" => "User data fetch successfully", "data" => $request->user());
        return response()->json($arr,200);
    }


}