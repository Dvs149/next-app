<?php

namespace App\Http\Controllers;

use Bitly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestBitlinkController extends Controller
{
    public function test()
    {
        $urlCreater = "api/referral?user_id=".Auth::user()->id;
        $url_for_user = url($urlCreater);
        // dd($url_for_user);
        
        $url = app('bitly')->getUrl($url_for_user); // http://bit.ly/nHcn3
        // $url = app('bitly')->getUrl('https://www.google.com/referral?user_id=1'); // http://bit.ly/nHcn3

        // $bitlyUrl = app('bitly')->getUrl(""); // http://bit.ly/nHcn3
        // dd($bitlyUrl);
        $arr = array("status" => true, "message" => "bitly link created.", "data" => $url);
        return response()->json($arr,200);
    }
}
