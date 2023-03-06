<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\User;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardPointController extends Controller
{
    public function rewards_points()
    {
        $rewards_data = Reward::get();
        
        $arr = array("status" => true, "message" => "Reward List", "data" => $rewards_data );

        return \Response::json($arr);
    }

    public function users_rewards_points()
    {
        $user = User::select('reward_points')->where('id',Auth::user()->id)->first();
        
        $arr = array("status" => true, "message" => "User Data", "data" => $user );

        return \Response::json($arr);
    }
    // public function rewards()
    // {
    //     return Helper::reward(3000);
    // }

}
