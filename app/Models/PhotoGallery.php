<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    use HasFactory;
    protected $table = 'photo_gallery';
    protected $guarded = [];

    protected $appends = ['photo_gallery_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function getPhotoGalleryUrlAttribute()
    {
        if(isset($this->attributes['photo']))
        {
            return $this->attributes['photo'] ? url(config('custom.PHOTO_GALLERY_URL_PATH')).'/'.$this->attributes['photo'] : null;
        }
    }

}
