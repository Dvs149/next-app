<?php

namespace App\Http\Controllers\admin;

use Helper;
use DataTables;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FeedbackController extends Controller
{
    public function feedback_list(Request $request)
    {
        $data = Feedback::with('user')->select('*')->get();
        // dd($data->toArray());`
        if ($request->ajax()) {

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $div = '<div class="center">';
                           $btn =""; 
                        //    $btn = '<a href="'.route('admin.feedback').'/edit/'.Helper::encrypt($row->id).'" target="_blank"><i class="material-icons dp48">edit</i></a>';
                            if($row->role!="admin"){
                                $btn = $btn . '<a href="'.route('admin.feedback').'/view/'.Helper::encrypt($row->id).'" target="_blank"><i class="material-icons dp48">visibility</i></a>';
                                $btn = $btn . '<a href="javascript:void(0)" class="btn-warning-cancel" data-url="'.route('admin.feedback').'/delete/'.Helper::encrypt($row->id).'" data-id="'.Helper::encrypt($row->id).'"><i class="material-icons btn-warning-confirm dp48">delete</i></a>';
                                
                            }
                            $div = $div.$btn;
                            $div = $div."</div>";
    
                            return $div;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.feedback.feedback_list');
    }

    public function feedback_edit($feedback_id)
    {   
        
        $id = Helper::decrypt($feedback_id);
        $feedback_details = Feedback::with('user')->where('id',$id)->first();
        
        if(!$id || !$feedback_details){
            abort(404);
        }

        // dd($user_business->business_info);
        // $user_business = $user->with('business_info')->first();
        return view('admin.feedback.edit_feedback',compact('feedback_details'));
    }
    public function feedback_view($feedback_id)
    {
        
        $id = Helper::decrypt($feedback_id);
        $user_detail = Feedback::where('id',$id)->with('user')->first();
        
        // if user not found than so 404
        if(!$user_detail){
            abort(404);
        }
        
        return view('admin.feedback.view_feedback',compact('user_detail'));
    }
}
