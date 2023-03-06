<?php

namespace App\Http\Controllers;

use DB;
use File;
use Image;
use Validator;
use App\Models\User;
use App\Models\BusinessInfo;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function get_profile_data()
    {

        $user_id = Auth::user()->id;
        $user = User::with('business_info','photo_gallery')->where('id',$user_id)->first();
        if($user->business_info){
            $user->business_info->makeHidden('id','user_id');
        }
        
        $arr = array("status" => true, "message" => "User data", "data" => $user);

        return response()->json($arr, 200);
        
    }
    public function save_profile_data(Request $request)
    {
        DB::beginTransaction();
        
        // try {
            $input = $request->all();
            $userid = Auth::user()->id;
            $rules = array(
                'email' => 'required|email|unique:users,email,'.$userid,
                'name' => 'required|max:25',
                'mobile' => 'required|numeric|unique:users,mobile,'.$userid,
                // 'country_code' => 'required',
                // 'profile_photo' => 'mimes:jpeg,jpg,png,gif',
                // 'cover_photo' => 'mimes:jpeg,jpg,png,gif',
                // 'document_file' => 'mimes:pdf|max:25000',
                'b_bio' => 'max:255',
                'b_title' => 'max:255',
                'b_company_name' => 'max:255',
                'b_department' => 'max:255',
                'b_contact_number' => 'max:12',
                'b_ext' => 'max:10',
                'b_website' => 'max:255',
                'b_whatsapp_url' => 'max:255',
                // 'profile_photo' => 'mimes:jpeg,png|max:2048',
                // 'cover_photo' => 'mimes:jpeg,png|max:2048',
                // 'document_file' => 'mimes:pdf|max:2048',
            );

            $messages = array(
                'email.required' => 'The email is required.', 
                'name.required' => 'The name is required.',
                'mobile.required' => 'The mobile is required.',
                // 'country_code.required' => 'The country code is required.',
                // 'b_bio.required' => 'The bio is required.',
                // 'b_bio.max' => 'The bio must not be greater than 255 characters.',
                // 'b_title.required' => 'The title is required.',
                // 'b_company_name.required' => 'The company name is required.',
                // 'b_department.required' => 'The department is required.',
                // 'b_contact_number.required' => 'The contact number is required.',
                // 'b_ext.required' => 'The Ext is required.',
                // 'b_website.required' => 'The website is required.',
                // 'b_whatsapp_url.required' => 'The whatsapp url is required.',
                // 'profile_photo.mimes'=>'The profile photo must be image with type jpeg, png.',
                // 'cover_photo.mimes'=>'The cover photo photo must be image with type jpeg, png.',
                // 'document_file.mimes' => 'The document file must be file with type pdf.'
            );
            
            $validator = Validator::make($input, $rules, $messages);
            
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()],422);
            } 
            
            $user = User::updateOrCreate(['id' => Auth::user()->id],[
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
                
                'facebook_visibility' => $request->get("facebook_visibility","0"),
                'snapchat_visibility' => $request->get("snapchat_visibility","0"),
                'twitter_visibility' => $request->get("twitter_visibility","0"),
                'tiktok_visibility' => $request->get("tiktok_visibility","0"),
                'linkedin_visibility' => $request->get("linkedin_visibility","0"),
                'instagram_visibility' => $request->get("instagram_visibility","0"),
                'youtube_visibility' => $request->get("youtube_visibility","0"),

                'behance_visibility'=> $request->get("behance_visibility","0"),
                'soundcloud_visibility'=> $request->get("soundcloud_visibility","0"),
                'podcast_visibility'=> $request->get("podcast_visibility","0"),
                
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
            
            
            if($request->hasfile('profile_photo')) {
                if(!empty($user->profile_photo)){
                    //check wether image is stored or not, if stored then removed old image
                    $file= $user->profile_photo;
                    $old_file_path = storage_path(config('custom.PROFILE_PHOTO_PATH')).$file;
                    
                    if (File::exists($old_file_path)) {
                        @unlink(storage_path(config('custom.PROFILE_PHOTO_PATH')).$file);
                    }
                }
                $fileName = md5(date('Y-m-d H:i:s:u')).rand(10,10000).'.'.$request->profile_photo->getClientOriginalExtension();
                $filePath = $request->file('profile_photo')->storeAs('uploads/profile_photo', $fileName, 'public');
                $user->profile_photo = $fileName;
            }
            
            if($request->hasfile('cover_photo')) {
                if(!empty($user->cover_photo)){
                    //check wether image is stored or not, if stored then removed old image
                    $file= $user->cover_photo;
                    $old_file_path = storage_path(config('custom.COVER_PHOTO_PATH')).$file;
                    if (File::exists($old_file_path)) {
                        @unlink(storage_path(config('custom.COVER_PHOTO_PATH')).$file);
                    }
                }
                $fileName = md5(date('Y-m-d H:i:s:u')).rand(10,10000).'.'.$request->cover_photo->getClientOriginalExtension();
                $filePath = $request->file('cover_photo')->storeAs('uploads/cover_photo', $fileName, 'public');
                $user->cover_photo = $fileName;
            }
            
            $user->save();
            
            $business_info = BusinessInfo::updateOrCreate([
                'user_id' => Auth::user()->id
            ],[
                // 'b_name' => $request->get('b_name',null),
                'b_bio' => $request->get('b_bio',''),
                // 'b_email' => $request->get('b_email',null),
                'b_title' => $request->get('b_title',''),
                'b_company_name' => $request->get('b_company_name',''),
                'b_department' => $request->get('b_department',''),
                'b_contact_number' => $request->get('b_contact_number',''),
                'b_ext' => $request->get('b_ext',''),
                'b_website' => $request->get('b_website',''),
                'b_whatsapp_url' => $request->get('b_whatsapp_url',''),
                'b_location_latitude' => $request->get('b_location_latitude',''),
                'b_location_longitute' => $request->get('b_location_longitute','')
            ]);
            
            if($request->hasfile('document_file')) {
                if(!empty($business_info->document_file)){
                    //check wether image is stored or not, if stored then removed old image
                    $file= $business_info->document_file;
                    $old_file_path = storage_path(config('custom.DOCUMENT_FILE_PATH')).$file;
                    if (File::exists($old_file_path)) {
                        @unlink(storage_path(config('custom.DOCUMENT_FILE_PATH')).$file);
                    }
                }
                $fileName = md5(date('Y-m-d H:i:s:u')).rand(10,10000).'.'.$request->document_file->getClientOriginalExtension();
                $filePath = $request->file('document_file')->storeAs('uploads/document_file', $fileName, 'public');
                $business_info->document_file = $fileName;
            }
            $business_info->save();

                // store photo gallery
            if($request->hasfile('photo_gallery')) {
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
                        } else {
                            $filePath = $image->storeAs(config('custom.PHOTO_GALLERY_SMALL_PATH'), $fileNameWithExtension, 'public');
                        }
                        
                        // array_push($file_list,$fileNameWithExtension);

                        $pg->photo = $fileNameWithExtension;
                        $pg->user_id = Auth::user()->id;
                        $pg->save();
                    }
                }
            
                // get all info of user in reponse
                $user_id = Auth::user()->id;
                $user = User::with('business_info','photo_gallery')->where('id',$user_id)->first();
                if($user->business_info){
                    $user->business_info->makeHidden('id','user_id');
                }

            DB::commit();
            $arr = array("status" => true, "message" => "Profile updated successfully", "data" => $user);
            return response()->json($arr , 200);
            
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     $arr = array("status" => false, "message" => "Something went wrong.", "data" => array());
        //     return response()->json($arr , 422);
        // }
    }

    public function save_media(Request $request)
    {
        DB::beginTransaction();
        // dd($request->all());
        
        try {
            $input = $request->all();
            // $userid = Auth::user()->id;
            $rules = array(
                // 'photo_gallery' => 'image|mimes:jpeg,png,jpg|max:2048',
                // 'photo_gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                // 'photo_gallery' => 'required',
                // 'photo_gallery.*'          => 'mimes:jpeg,png,jpg,gif|max:2048',
                // 'photo_gallery' => 'required',
                'photo_gallery.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
            );
            // $messages = array(
                // 'photo_gallery.mimes' => 'Only jpeg,png and bmp images are allowed',
                // 'photo_gallery.*.mimes'=>'The photo gallery must be image with type jpeg, png.',
                // 'photo_gallery.*.mimes' => 'Only jpeg,png,gif and jpg are allowed',
                // 'photo_gallery.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',

                
            // );
            
            $validator = Validator::make($input, $rules);
            // dd($validator);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()],422);
            } 
            // dd($validator->fails());
            
                $user = Auth::user();

                // store photo gallery id 
                $collet_pg_id = array();
                // echo count($request->hasfile('photo_gallery'));
                // die;


            if($request->hasfile('photo_gallery')) {
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
                        array_push($collet_pg_id,$pg->id);
                    }
                }
                
                
                // store youtube link
                // if($request->get('youtube_video_link')){
                //     $user->youtube_video_link = $request->get('youtube_video_link');
                //     $user->save();
                // }

                // store document
                // $business_info = BusinessInfo::where('user_id',$user->id)->first();
                // if($request->hasfile('document_file')) {
                    
                //     if(!empty($business_info->document_file)){
                //         //check wether image is stored or not, if stored then removed old image
                //         $file= $business_info->document_file;
                //         // $old_file_path = storage_path(config('custom.DOCUMENT_FILE_PATH')).$file;
                //         $old_file_path = storage_path(config('custom.DOCUMENT_FILE_PATH')).$file;
                //         // dd(File::exists($old_file_path));
                //         if (File::exists($old_file_path)) {
                //             @unlink(storage_path(config('custom.DOCUMENT_FILE_PATH')).$file);
                //         }
                //     }
                //     $fileName = md5(date('Y-m-d H:i:s:u')).rand(10,10000).'.'.$request->document_file->getClientOriginalExtension();
                //     $filePath = $request->file('document_file')->storeAs('uploads/document_file', $fileName, 'public');
                //     $business_info->document_file = $fileName;
                //     $business_info->save();
                // }
                


            DB::commit();
            // dd($business_info->id, $collet_pg_id);
                // $document_data = BusinessInfo::select()
                //                             ->where('id',$business_info->id)
                //                             ->first()
                //                             ->only('document_file_url');

                $photo_gallery_data = PhotoGallery::select()
                                            ->whereIn('id',$collet_pg_id)
                                            ->get()
                                            ->each(function($photo_gallery_data){
                                                $photo_gallery_data->makeHidden("photo","user_id","created_at","updated_at");
                                            });
            $arr = array(
                            "status" => true, 
                            "message" => "Media Upload successful", 
                            "data" => [
                                    // "documeent_data"=>$document_data,
                                    "photo_gallery_data"=>$photo_gallery_data
                                    ]
                        );
            return response()->json($arr , 200);
            
        } catch (\Exception $e) {
            DB::rollback();
            $arr = array(   "status" => false,
                            "message" => $e->getMessage(), 
                            "data" => []);
            return response()->json($arr , 422);
        }
    }
}