<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryCodeController extends Controller
{
    public function country_code()
    {
        $country_code = [
            "Bahrain" =>"+973",
            "Egypt" =>"+20",
            "Iran" =>"+98",
            "Iraq" =>"+964",
            "Israel" =>"+972",
            "Jordan" =>"+962",
            "Kuwait" =>"+965",
            "Lebanon" =>"+961",
            "Oman" =>"+968",
            "Palestinian Territory" =>"+970",
            "Qatar" =>"+974",
            "Saudi Arabia" =>"+966",
            "Syria" =>"+963",
            "Turkey" =>"+90",
            "United Arab Emirates" =>"+971",
            "Yemen" =>"+967"
        ];
        
        $arr = array("status" => true, 
            "message" => "Country code list",
            "data" => ["country_code"=>$country_code]
        );
        return response()->json($arr , 200);
    }
}
