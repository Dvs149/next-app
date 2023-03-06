<?php

namespace App\Http\Controllers;

use Helper;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeamColleagues;

class BusinessInfoController extends Controller
{
    public function business_info_backup(Request $request)
    {
        try {
            // decrypt id
            $user_id = (int)Helper::decrypt($request->business_user_id);
            
            // add parameter by decrypting
            if($request->business_user_id){
                $request->merge([   
                            'business_user_id' => $user_id,
                        ]);
            }
            $request->validate([
                'business_user_id' => 'required|exists:users,id|not_in:0',
            ]);
            
            $user = User::with('business_info','photo_gallery')
                        ->where('id',$user_id)
                        ->first();
            // hide unwanted parameter
            if(isset($user->business_info)){
                $user->business_info->makeHidden('id','user_id');
            }

            $team_colleagues_ids = TeamColleagues::where('user_id',$user_id)->pluck('tac_id');
            $team_colleagues_list = User::select('id','name','profile_photo')
                                ->where('role','user')
                                ->whereIn('id',$team_colleagues_ids)
                                ->orderBy('name')
                                ->with('business_info:b_title,user_id')
                                ->get()
                                ->each(function($user){
                                    $user->b_title = isset($user->business_info->b_title)?$user->business_info->b_title:null;
                                })
                                ->makeHidden(['business_info','reward_type','id','cover_photo_url']);

            //add team info array to user's info
            $user->team_colleagues_list = $team_colleagues_list->toArray();            
            // dd($user->toArray());
            $arr = array("status" => true, "message" => "User data", "data" => $user);
            return response()->json($arr, 200);

        } catch (Exception $e) {
            return response()->json([
                                "status" => false,
                                "message" => $e->getMessage(),
                                "errors" => is_array($errors) ? $errors : [],
                        ], 422);
        }
    }

    public function get_business_info(Request $request,$u_id)
    {
        try {
            // decrypt id
            $user_id = (int)Helper::decrypt($u_id);
            
            // add parameter by decrypting
            if($user_id){
                $request->merge([   
                            'business_user_id' => $user_id,
                        ]);
            }
            $request->validate([
                'business_user_id' => 'required|exists:users,id|not_in:0',
            ]);
            
            $user = User::with('business_info','photo_gallery','themecolor')
                        ->where('id',$user_id)
                        ->first();
            // hide unwanted parameter
            if(isset($user->business_info)){
                $user->business_info->makeHidden('id','user_id');
            }

            $team_colleagues_ids = TeamColleagues::where('user_id',$user_id)->count();

            //add team info array to user's info
            $user->team_colleagues_count = $team_colleagues_ids;
            // dd($user->toArray());
            $arr = array("status" => true, "message" => "User data", "data" => $user);
            return response()->json($arr, 200);

        } catch (Exception $e) {
            return response()->json([
                                "status" => false,
                                "message" => $e->getMessage(),
                                "errors" => [],
                        ], 422);
        }
    }
    public function tac_info(Request $request,$u_id)
    {
        // decrypt id
        $user_id = (int)Helper::decrypt($u_id);
        
        // add parameter by decrypting
        if($user_id){
            $request->merge([   
                        'business_user_id' => $user_id,
                    ]);
        }
        $request->validate([
            'business_user_id' => 'required|exists:users,id|not_in:0',
        ]);

        $team_colleagues_ids = TeamColleagues::where('user_id',$user_id)->pluck('tac_id');
        $team_colleagues_list = User::select('id','name','profile_photo')
                                ->where('role','user')
                                ->whereIn('id',$team_colleagues_ids)
                                ->orderBy('name')
                                ->with('business_info:b_title,user_id')
                                ->get()
                                ->each(function($user){
                                    $user->b_title = isset($user->business_info->b_title)?$user->business_info->b_title:null;
                                })
                                ->makeHidden(['business_info','reward_type','id','cover_photo_url']);
        
        
        $arr = array("status" => true, "message" => "Team and collegue of business profile", "data" => $team_colleagues_list);
        return response()->json($arr, 200);
    }
}
