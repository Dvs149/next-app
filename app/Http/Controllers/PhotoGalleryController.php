<?php

namespace App\Http\Controllers;

use File;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoGalleryController extends Controller
{
    public function delete_photo_galary(Request $request, $delete_photo_id)
    {
        // validatio for id to be deleted
        if($delete_photo_id){
            $request->merge([   
                        'photo_id' => $delete_photo_id,
                    ]);
        } 
        $request->validate([
            'photo_id' => 'required|exists:photo_gallery,id|not_in:0',
        ]);

        $pg_id_for_delete = $request->photo_id;

        $user = Auth::user();
        $photo_galley = PhotoGallery::findOrFail($pg_id_for_delete);
        //check wether image is stored or not, if stored then removed old image
        $file= $photo_galley->photo;
        
        $old_file_path_original_path = storage_path(config('custom.DELETE_PHOTO_GALLERY_PATH_ORIGINAL_SIZE')).'/'.$file;
        $old_file_path_small_path = storage_path(config('custom.DELETE_PHOTO_GALLERY_PATH_SMALL_SIZE')).'/'.$file;
        // check path exist for both photo for original and shrink size
        if (File::exists($old_file_path_original_path) || File::exists($old_file_path_small_path)) {
            
            @unlink($old_file_path_original_path);
            @unlink($old_file_path_small_path);
        }
        $photo_galley->delete();

        $arr = array("status" => true, "message" => "Photo has been deleted", "data" => array());
        return response()->json($arr , 200);

    }
}
