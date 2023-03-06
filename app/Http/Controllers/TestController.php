<?php

namespace App\Http\Controllers;

use Helper;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function tst()
    {
        echo Helper::encrypt(2)."<br>";
        echo Helper::decrypt('Y1poWjBsU1N4UC92Mkhzem8wMkNhdz09')."<br>";
    }

    public function test(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo_gallery' => 'required',
            'photo_gallery.*' => 'image|mimes:jpeg,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],422);
        } 
        
        $file_list = array();
        // dd($request->file('photo_gallery'));
        // dd($filesize);
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
                
                array_push($file_list,$fileNameWithExtension);

                $pg->photo = $fileNameWithExtension;
                $pg->user_id = Auth::user()->id;
                $pg->save();
            }
        }
        
        $arr = array(
                        "status" => true, 
                        "message" => "Image Upload successful", 
                        "data" => $file_list
                    );
        return response()->json($arr , 200);

    
    }

    public function test_backup(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2024'
        // ]);

        $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2024'
        ]);

        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()],422);
        // } 
  
        $image = $request->file('images');
        $pg = new PhotoGallery;
        // dd($request->hasfile('images'));
        // dd($filesize);
        if($request->hasfile('images')) {
            
            $fileName = md5(date('Y-m-d H:i:s:u')).rand(10,10000);
            $fileNameWithExtension = $fileName.'.'.$request->images->getClientOriginalExtension();
            $filePath = $request->file('images')->storeAs('uploads/photo_gallery/original_size', $fileNameWithExtension, 'public');
            
            if(number_format($request->file('images')->getSize()/1000) > 700){
                $img = Image::make($image->getRealPath());
                $destinationPath = storage_path('app/public/uploads/photo_gallery/small_size');
                $img->resize(1000, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$fileNameWithExtension); 
            } else {
                $filePath = $request->file('images')->storeAs('uploads/photo_gallery/small_size', $fileNameWithExtension, 'public');
            }
        }
        
        $pg->photo = $fileNameWithExtension;
        $pg->user_id = Auth::user()->id;
        $pg->save();

        $arr = array(
                        "status" => true, 
                        "message" => "Image Upload successful", 
                        "data" => [$fileNameWithExtension]
                    );
        return response()->json($arr , 200);

    
    }

    public function shortner()
    {
        $url_link = "http://161.35.41.64:8087/";
        $url = Helper::url_shortner($url_link);
        dd($url);
    }
}
