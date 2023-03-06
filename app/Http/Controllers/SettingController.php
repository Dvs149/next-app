<?php

namespace App\Http\Controllers;

use \Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SettingController extends Controller
{
    public function setting(){

        $data = User::select('type_of_account','name','email','mobile','expiration_date')->where('id', Auth::user()->id)->first();
        $arr = array("status" => true, "message" => "Setting of user", "data" => $data);

        return response()->json($arr, 200);
    }

    public function edit_setting(Request $request){

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), 
            [
                'type_of_account' => 'required',
                'name' => 'required|max:25',
                'email' => 'required|email|unique:users,email,'.$id,
                'mobile' => 'required|numeric|min:9|unique:users,mobile,'.$id,
            ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $user = User::where('id', $id)->first();
        $user->type_of_account = $request->get('type_of_account',null);
        $user->name = $request->get('name',null);
        $user->email = $request->get('email',null);
        $user->mobile = $request->get('mobile',null);
        // $user->expiration_date = $request->get('expiration_date',null);

        if(isset($request->password) && $request->password!=""){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $arr = array("status" => true, "message" => "Setting changed successfully.", "data" => $user);

        return response()->json($arr , 200);
    }
    
    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::user()->id;
        $rules = array(
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => false, "message" => $validator->errors()->first(), "data" => array());
            // return response()->json(['error'=>$validator->errors()]);
            // return response()->json($arr);
        } else {
            try {
                if ((Hash::check(request('current_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => false, "message" => "Current password is wrong.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => false, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => true, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => false, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }
    
}
