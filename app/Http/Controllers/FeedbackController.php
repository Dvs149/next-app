<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    
    public function feedback(Request $request)
    {
        $userid = Auth::user()->id;

        $request->validate([
            'rate' => 'required|in:1,2,3,4,5',
            'type' => 'required|in:suggestion,complaint,compliment',
            'feedback_message' => 'required|max:500',
        ]);

        $feedback = new Feedback;
        $feedback->rate = $request->rate;
        $feedback->type = $request->type;
        $feedback->feedback_message = $request->feedback_message;
        $feedback->user_id = $userid;

        $feedback->save();

        $arr = array("status" => true, "message" => "Feedback submitted successfully.", "data" => []);

        return response()->json($arr,201);
    }
}
