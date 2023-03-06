<?php

namespace App\Http\Controllers;

use Helper;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeamColleagues;
use Illuminate\Support\Facades\Auth;

class TeamColleaguesController extends Controller
{
    public function get_team_colleagues_data()
    {
        // $id = (int)Helper::decrypt(Auth::user()->id);
        $id = Auth::user()->id;
        // dd($id);
        $team_colleagues_ids = TeamColleagues::where('user_id',$id)->pluck('tac_id');
        $team_colleagues_list = User::select('id','name','profile_photo')
                                ->where('role','user')
                                ->whereIn('id',$team_colleagues_ids)
                                ->orderBy('name')
                                ->with('business_info:b_title,user_id')
                                ->with('business_info')
                                ->get()
                                ->each(function($user){
                                    $user->b_title = isset($user->business_info->b_title)?$user->business_info->b_title:null;
                                })
                                ->makeHidden(['business_info','reward_type','id','cover_photo_url']);
        
        
        $count_team_colleagues = count($team_colleagues_list);
        if(!$count_team_colleagues){
            $arr = array("status" => true, "message" => "Doesnt have team or colleagues.", "data" => $team_colleagues_list);
        } else {
            $arr = array("status" => true, "message" => "Team and Colleagues list.", "data" => $team_colleagues_list);
        }

        return response()->json($arr,200);
    }

    public function save_team_colleague(Request $req)
    {
        // dd($req->all());
        $userid=Auth::user()->id;
        
        $tac_id = (int)Helper::decrypt($req->u_id);
        // add parameter by decrypting
        if($req->u_id){
            $req->merge([   
                        'team_or_collegues' => $tac_id,
                    ]);
        }

        //added for unique validation 
        $req->merge([   
                        'logged_in_user' => $userid,
                    ]);
        $input = $req->all();
        $rules = array(
            'logged_in_user' => 'different:team_or_collegues|not_in:0',
            'team_or_collegues' => 'required|not_in:0',
            // 'team_or_collegues' => 'required|unique:team_and_colegues,tac_id|not_in:0',
        );

        $customMessages = [
            'team_or_collegues.required' => 'Team mate Id required.',
            // 'team_or_collegues.unique' => 'This user is already in other user\'s team or colleagues.',
        ];

        $validator = Validator::make($input, $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(["status" => false, 'error'=>$validator->errors()],422);
        }

        $count_if_allready_in_team = TeamColleagues::where('user_id',$userid)
                                                    ->where('tac_id',$tac_id)
                                                    ->get()->count();
        if(!$count_if_allready_in_team){
            $tac_save = new TeamColleagues;
            $tac_save->tac_id = $tac_id;
            $tac_save->user_id = $userid;
            $tac_save->save();

            $arr = array("status" => true, "message" => "Team or Colleagues saved successfully");
            return response()->json($arr,201);
        } else {
            $arr = array("status" => false, "message" => "This user is already in your list.");
            return response()->json($arr,422);
        }

    }
    public function search_name(Request $request)
    {
        // dd(Auth::user()->id);
        $request->validate([
            'name' => 'required|max:25'
        ]);

        // $id = (int)Helper::decrypt(Auth::user()->id);
        $id = Auth::user()->id;
        //get all user's  id who is in someonce team
        $allready_in_team = TeamColleagues::pluck('tac_id');
        //add logged in user id
        $allready_in_team[count($allready_in_team)+1] = $id;
        
        // get user without any team.
        $list = User::select('id','name','profile_photo')
                        ->where('role','user')
                        ->where(function($q) use ($allready_in_team){
                            $q->whereNotIn('id',$allready_in_team);
                        });
        if($request->name!=''){
            $name = $request->name;
            $list->where(function($q) use ($name) {
                        $q->where('name','like','%'.$name.'%');
            });
        }
        // get list by name order
        $list = $list->orderBy('name')->get()->makeHidden(['reward_type']);
        $count_list= count($list);

        if($count_list){
            $arr = array("status" => true , "message" => "User list fetch successfully.", "data" => $list);
        } else {
            $arr = array("status" => false, "message" => "No user found.", "data" => $list);
        }

        return response()->json($arr,200);
    }

    public function search_team_colleague_name(Request $request,$name)
    {
        // dd(Auth::user()->id);

        if($request->name){
            $request->merge([   
                        'name' => $name,
                    ]);
        }
        $request->validate([
            'name' => 'required|max:25'
        ]);

        // $id = (int)Helper::decrypt(Auth::user()->id);
        $id = Auth::user()->id;
        //get all user's  id who is in someonce team
        // $allready_in_team = TeamColleagues::pluck('tac_id');
        $allready_in_team = [];
        // dd(count($allready_in_team));
        //add logged in user id
        $allready_in_team[count($allready_in_team)+1] = $id;
     

        // get user without any team.
        $list = User::select('id','name','profile_photo')
                        ->where('role','user')
                        ->where(function($q) use ($allready_in_team){
                            $q->whereNotIn('id',$allready_in_team);
                        });
        if($request->name!=''){
            $name = $request->name;
            $list->where(function($q) use ($name) {
                $q->where('name','like','%'.$name.'%');
            });
        }
        // get list by name order
        $list = $list->orderBy('name')->get()->makeHidden(['reward_type','cover_photo_url']);
        $count_list= count($list);

        if($count_list){
            $arr = array("status" => true , "message" => "User list fetch successfully.", "data" => $list);
        } else {
            $arr = array("status" => false, "message" => "No user found.", "data" => $list);
        }

        return response()->json($arr,200);
    }
    public function delete_team_mate(Request $request,$u_id)
    {
        $userid = Auth::user()->id;
        $tac_id = Helper::decrypt($u_id);

        // add parameter by decrypting
        if($request->u_id){
            $request->merge([ 'team_or_collegues' => $tac_id, ]);
        }

        //added for unique validation 
        $request->merge([   
                        'logged_in_user' => $userid,
                    ]);
        $input = $request->all();
        $rules = array(
            'logged_in_user' => 'different:team_or_collegues|not_in:0',
            'team_or_collegues' => 'required|not_in:0',
            // 'team_or_collegues' => 'required|unique:team_and_colegues,tac_id|not_in:0',
        );

        $customMessages = [
            'team_or_collegues.required' => 'Team mate Id required.',
            // 'team_or_collegues.unique' => 'This user is already in other user\'s team or colleagues.',
        ];

        $validator = Validator::make($input, $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(["status" => false, 'error'=>$validator->errors()],422);
        }

        $team_mate = TeamColleagues::where('user_id',$userid)
                                                    ->where('tac_id',$tac_id)
                                                    ->first();

        
        if($team_mate){
            $team_mate->delete();
            $arr = array("status" => true , "message" => "Team mate deleted from list.", "data" => []);
            return response()->json($arr,200);

        } else {
            $arr = array("status" => false , "message" => "Team mate not found.", "data" => []);
            return response()->json($arr,422);
        }

    }
    
}
