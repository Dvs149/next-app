<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\ThemeColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function get_theme_color()
    {

        $theme = ThemeColor::where('user_id',Auth::user()->id)->first();

        if(empty($theme)){
            $arr = array("status" => true, "message" => "Theme color not yet set by you.", "data" => array());
        }else{
            $arr = array("status" => true, "message" => "Theme color fetch successfully", "data" => $theme);
        }
        return \Response::json($arr);

    }
    public function edit_theme_color(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), 
            [
                'red_color' => 'required|between:0,255',
                'green_color' => 'required|between:0,255',
                'blue_color' => 'required|between:0,255',
                'theme_mode' => 'required|in:dark,light',
            ]);

        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 422);
        } 
        
        $theme = ThemeColor::updateOrCreate([
                        'user_id'   =>  $id,
                    ],[
                        'red_color' => $request->get('red_color'),
                        'green_color' => $request->get('green_color'),
                        'blue_color' => $request->get('blue_color'),
                        'theme_mode' => $request->get('theme_mode'),
                    ]);
        $arr = array("status" => true, "message" => "Theme color updated successfully", "data" => $theme);
        
        return \Response::json($arr);
    }

}
