<?php

namespace App\Http\Controllers;

use App\Models\PremiumPlans;
use Illuminate\Http\Request;

class PremiumPlansController extends Controller
{
    public function premium_plans(){
        $data = PremiumPlans::all();
        
        $arr = array("status" => true, "message" => "Premium plans list", "data" => $data);

        return response()->json($arr, 200);
    }
    
}
