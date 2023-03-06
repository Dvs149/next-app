<?php

namespace App\Http\Controllers\admin;

use File;
use Image;
use Helper;
use Validator;
use DataTables;
use App\Models\User;
use App\Models\BusinessInfo;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use App\Mail\CreateProfileMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_list(Request $request)
    {
        $data = User::select('id','name','email','suspended','mobile','role')->get();
        // dd($data);
        if ($request->ajax()) {

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $div = '<div class="center">';
                           $btn = '<a href="'.route('admin.user').'/edit/'.Helper::encrypt($row->id).'" target="_blank"><i class="material-icons dp48">edit</i></a>';
                            if($row->role!="admin"){
                                $btn = $btn . '<a href="javascript:void(0)" class="btn-warning-cancel" data-url="'.route('admin.user').'/delete/'.Helper::encrypt($row->id).'" data-id="'.Helper::encrypt($row->id).'"><i class="material-icons btn-warning-confirm dp48">delete</i></a>';
                                $btn = $btn . '<a href="'.route('admin.user').'/view/'.Helper::encrypt($row->id).'" target="_blank"><i class="material-icons dp48">visibility</i></a>';
                                if(!$row->suspended){
                                    $btn = $btn . '<a href="javascript:void(0)" class="suspend" title="suspend" data-url="'.route('admin.user').'/suspend/'.Helper::encrypt($row->id).'" data-id="'.Helper::encrypt($row->id).'"><i class="material-icons  dp48">block</i></a>';
                                } else {
                                    // $btn = $btn . '<a href="javascript:void(0)" class="suspend" title="suspend" data-url="'.route('admin.user').'/suspend/'.Helper::encrypt($row->id).'" data-id="'.Helper::encrypt($row->id).'"><i class="material-icons  dp48">block</i></a>';
                                }
                            }
                            $div = $div.$btn;
                            $div = $div."</div>";
    
                            return $div;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.user.user_list');
    }

    public function add_user()
    {
        return view('admin.user.add_user');
    }
    public function create_user(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|unique:App\Models\User,email|max:100',
            'password' => 'required|min:6',
            'name' => 'required|max:25',
            'mobile' => 'required|numeric|unique:users,mobile',
            'country_code' => 'required',
        ]);


        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->country_code = $request->country_code;
        $user->save();

        $details = [
                'title' => 'Your profile is created.',
                'body' => 'Please login to your profile by following details.',
                'email' => $user->email,
                'password' => $request->password,
                'name' => $user->name,
                'mobile' => $user->mobile,
                'country_code' => $user->country_code
        ];

        $mail_send = \Mail::to($user->email)->send(new \App\Mail\CreateProfileMail($details));

        return redirect()->back()->with('message', 'User added!');
    }
    public function suspend_user($id)
    {
        $user_id = Helper::decrypt($id);
        $user_suspend = User::where('id',$user_id)->first();
        $user_suspend->suspended = 1;

        $user_suspend->save();
        return true;
    }
    public function edit_user($user_id)
    {

        $id = Helper::decrypt($user_id);
        $user_business = User::with('business_info','photo_gallery')->where('id',$id)->first();
        // dd($user_business->toArray());
        if(!$id || !$user_business){
            abort(404);
        }

        // dd($user_business->business_info);
        // $user_business = $user->with('business_info')->first();
        return view('admin.user.edit_user',compact('user_business'));
    }
    public function update_user(Request $request,$id)
    {
            // dd($request->all(),$id);
            $input = $request->all();
            $userid = Helper::decrypt($id);
            $rules = array(
                'email' => 'required|email|unique:users,email,'.$userid,
                'name' => 'required|max:25',
                'mobile' => 'required|numeric|unique:users,mobile,'.$userid,
                'country_code' => 'required',
                'profile_photo' => 'mimes:jpeg,jpg,png,gif',
                'cover_photo' => 'mimes:jpeg,jpg,png,gif',
                'document_file' => 'mimes:pdf|max:25000',
                'b_bio' => 'required|max:255',
                // 'b_name' => 'required|max:30',
                // 'b_email' => 'required|max:75',
                'b_title' => 'required|max:25',
                'b_company_name' => 'required|max:25',
                'b_department' => 'required|max:25',
                'b_contact_number' => 'required|max:12',
                'b_ext' => 'required|max:10',
                'b_website' => 'required|max:255',
                'b_whatsapp_url' => 'required|max:255',
                'b_location_latitude' => 'required|max:25',
                'b_location_longitute' => 'required|max:25',
                'profile_photo' => 'image|mimes:jpeg,png|max:2048',
                'cover_photo' => 'image|mimes:jpeg,png|max:2048',
                'document_file' => 'mimes:pdf|max:2048',
            );
            
            
            $validator = Validator::make($input, $rules);
            
            $user = User::updateOrCreate(['id' => $userid],[
                'name' => $request->get("name",null),
                'mobile' => $request->get("mobile",null),
                'email' => $request->get("email",null),
                'country_code' => $request->get("country_code",null),
                
                'facebook_link' => $request->get("facebook_link",null),
                'snapchat_link' => $request->get("snapchat_link",null),
                'twitter_link' => $request->get("twitter_link",null),
                'tiktok_link' => $request->get("tiktok_link",null),
                'linkedin_link' => $request->get("linkedin_link",null),
                'instagram_link' => $request->get("instagram_link",null),
                'youtube_link' => $request->get("youtube_link",null),
                'behance_link'=> $request->get("behance_link",null),
                'soundcloud_link'=> $request->get("soundcloud_link",null),
                'podcast_link'=> $request->get("podcast_link",null),
                
                'facebook_visibility' => $request->get("facebook_visibility",0),
                'snapchat_visibility' => $request->get("snapchat_visibility",0),
                'twitter_visibility' => $request->get("twitter_visibility",0),
                'tiktok_visibility' => $request->get("tiktok_visibility",0),
                'linkedin_visibility' => $request->get("linkedin_visibility",0),
                'instagram_visibility' => $request->get("instagram_visibility",0),
                'youtube_visibility' => $request->get("youtube_visibility",0),
                'behance_visibility'=> $request->get("behance_visibility",0),
                'soundcloud_visibility'=> $request->get("soundcloud_visibility",0),
                'podcast_visibility'=> $request->get("podcast_visibility",0),
                
                'facebook_order' => $request->get("facebook_order",null),
                'snapchat_order' => $request->get("snapchat_order",null),
                'twitter_order' => $request->get("twitter_order",null),
                'tiktok_order' => $request->get("tiktok_order",null),
                'linkedin_order' => $request->get("linkedin_order",null),
                'instagram_order' => $request->get("instagram_order",null),
                'youtube_order' => $request->get("youtube_order",null),
                'behance_order'=> $request->get("behance_order",null),
                'soundcloud_order'=> $request->get("soundcloud_order",null),
                'podcast_order'=> $request->get("podcast_order",null),
                
                'youtube_video_link' => $request->get("youtube_video_link",null)
                ]
            );
            
            $user->save();
            // dd($user);
            
            $business_info = BusinessInfo::updateOrCreate([
                'user_id' => $userid

            ],[
                'b_bio' => $request->get('b_bio',null),
                'b_title' => $request->get('b_title',null),
                'b_company_name' => $request->get('b_company_name',null),
                'b_department' => $request->get('b_department',null),
                'b_contact_number' => $request->get('b_contact_number',null),
                'b_ext' => $request->get('b_ext',""),
                'b_website' => $request->get('b_website',null),
                'b_whatsapp_url' => $request->get('b_whatsapp_url',null),
                'b_location_latitude' => $request->get('b_location_latitude',"0"),
                'b_location_longitute' => $request->get('b_location_longitute',"0")
            ]);
            $business_info->save();
            // dd('dd');
            if($request->hasfile('photo_gallery')) {
                // dd('d');
                    $images = $request->file('photo_gallery');
                    foreach($images as $image) {
                        $fileName = md5(date('Y-m-d H:i:s:u')).rand(10,10000);
                        $fileNameWithExtension = $fileName.'.'.$image->getClientOriginalExtension();
                        $filePath = $image->storeAs(config('custom.PHOTO_GALLERY_ORIGINAL_PATH'), $fileNameWithExtension, 'public');
                        $pg = new PhotoGallery;
                        
                        // resize photo if more then 700kb
                        if($image->getSize()/1000 > 700){
                            $img = Image::make($image->getRealPath());
                            $destinationPath = storage_path('app/public/'.config('custom.PHOTO_GALLERY_SMALL_PATH'));
                            $img->resize(1000, 1000, function ($constraint) {
                                $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$fileNameWithExtension); 
                            // dd($image);
                        } else {
                            $filePath = $image->storeAs(config('custom.PHOTO_GALLERY_SMALL_PATH'), $fileNameWithExtension, 'public');
                        }
                        
                        // array_push($file_list,$fileNameWithExtension);

                        $pg->photo = $fileNameWithExtension;
                        $pg->user_id = $user->id;
                        $pg->save();
                        // echo $pg->id."<br>";
                        // array_push($collet_pg_id,$pg->id);
                    }
                }


            
            $user_business = User::with('business_info')->where('id',$user->id)->first();
            $message = 'User updated';
            return view('admin.user.edit_user',compact('user_business','message'));
    }

    public function view_user($id)
    {
        $id = Helper::decrypt($id);
        $user_detail = User::where('id',$id)->with('business_info','photo_gallery')->first();
        // if user not found than so 404
        if(!$user_detail){
            abort(404);
        }
        // dd($user_detail->profile_photo_url);
        return view('admin.user.view_user',compact('user_detail'));
    }

    
    
    public function delete_photo_gallery($id,$pid)
    {
        // dd($id,$pid);
        $user_id = Helper::decrypt($id);
        $photo_id = Helper::decrypt($pid);

        $photo_galley = PhotoGallery::findOrFail($photo_id);
        $file= $photo_galley->photo;
        
        $old_file_path_original_path = storage_path(config('custom.DELETE_PHOTO_GALLERY_PATH_ORIGINAL_SIZE')).'/'.$file;
        $old_file_path_small_path = storage_path(config('custom.DELETE_PHOTO_GALLERY_PATH_SMALL_SIZE')).'/'.$file;
        // check path exist for both photo for original and shrink size
        if (File::exists($old_file_path_original_path) || File::exists($old_file_path_small_path)) {
            @unlink($old_file_path_original_path);
            @unlink($old_file_path_small_path);
        }
        $photo_galley->delete();

        return $pid;

    }

    public function delete_user($id)
    {

           $user_id = Helper::decrypt($id); 

           $user = User::where('id',$user_id)->with('feedback','team_colleagues','photo_gallery','themecolor','business_info')->first();
        //    dd($user->role);
           if($user->role=="admin"){
               abort(404);
           }
           $user->business_info ? $user->business_info->delete() : 'continue';
           $user->team_colleagues ? $user->team_colleagues->delete():'continue';
           if(!$user->photo_gallery->isEmpty()){
               foreach($user->photo_gallery as $pg) 
                {
                    $file= $pg->photo;
        
                    $old_file_path_original_path = storage_path(config('custom.DELETE_PHOTO_GALLERY_PATH_ORIGINAL_SIZE')).'/'.$file;
                    $old_file_path_small_path = storage_path(config('custom.DELETE_PHOTO_GALLERY_PATH_SMALL_SIZE')).'/'.$file;
                    // check path exist for both photo for original and shrink size
                    if (File::exists($old_file_path_original_path) || File::exists($old_file_path_small_path)) {
                        @unlink($old_file_path_original_path);
                        @unlink($old_file_path_small_path);
                    }

                    $pg->delete();
                }
           }
        //    $user->photo_gallery ? $user->photo_gallery->delete():'continue';
           $user->delete();
           
    }
}
