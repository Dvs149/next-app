<?php

namespace App\Models;

use Helper;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'country_code',
        'referral_code',
        'facebook_link',
        'snapchat_link',
        'twitter_link',
        'tiktok_link',
        'linkedin_link',
        'instagram_link',
        'youtube_link',
        'behance_link',
        'soundcloud_link',
        'podcast_link',

        

        'facebook_visibility',
        'snapchat_visibility',
        'twitter_visibility',
        'tiktok_visibility',
        'linkedin_visibility',
        'instagram_visibility',
        'youtube_visibility',

        'behance_visibility',
        'soundcloud_visibility',
        'podcast_visibility',


        'facebook_order',
        'snapchat_order',
        'twitter_order',
        'tiktok_order',
        'linkedin_order',
        'instagram_order',
        'youtube_order',

        'behance_order',
        'soundcloud_order',
        'podcast_order',


        'youtube_video_link',
    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['profile_url','profile_photo_url','reward_type','u_id','cover_photo_url','profile_photo_base'];

    public function feedback()
    {
        return $this->hasMany(Feedback::class,'user_id','id');
    }

    public function team_colleagues()
    {
        return $this->hasOne(TeamColleagues::class,'tac_id','id');
    }

    public function photo_gallery()
    {
        return $this->hasMany(PhotoGallery::class,'user_id','id');
    }

    public function themecolor()
    {
        return $this->hasOne(ThemeColor::class,'user_id','id');
    }

    public function business_info()
    {
        return $this->hasOne(BusinessInfo::class,'user_id','id')
                    ->withDefault([
                        "b_bio"=> "",
                        // "b_name"=> "",
                        // "b_email"=> "",
                        "b_title"=> "",
                        "b_company_name"=> "",
                        "b_department"=> "",
                        "b_contact_number"=> "",
                        "b_ext"=> "",
                        "b_website"=> "",
                        "b_whatsapp_url"=> "",
                        "b_location_latitude"=> "",
                        "b_location_longitute"=> "",
                        "document_file"=> "",
                        "document_file_url"=> "", 
                    ]);
    }
    public function getProfileUrlAttribute()
    {
        return config('custom.URL_GENERATOR_FOR_PROFILE').Helper::encrypt($this->id);
    }
    public function getProfilePhotoUrlAttribute()
    {
        if(isset($this->attributes['profile_photo']))
        {
            return $this->attributes['profile_photo'] ? url(config('custom.PROFILE_PHOTO_URL_PATH')).'/'.$this->attributes['profile_photo'] : null;
        }
    }
    public function getProfilePhotoBaseAttribute()
    {
        $base64 = null;
        if(isset($this->attributes['profile_photo'])){
            $path = $this->attributes['profile_photo'] ? url(config('custom.PROFILE_PHOTO_URL_PATH')).'/'.$this->attributes['profile_photo'] : null;
            if($path){
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                return $base64;
            }
        }
        return $base64;
    }

    public function getCoverPhotoUrlAttribute()
    {

        if(isset($this->attributes['cover_photo']))
        {
            return $this->attributes['cover_photo'] ? url(config('custom.COVER_PHOTO_URL_PATH')).'/'.$this->attributes['cover_photo'] : null;
        }
    }

    public function getRewardTypeAttribute()
    {
        if(isset($this->attributes['reward_points']))
        {
            return Helper::reward_type($this->attributes['reward_points']);
        }
    }

    public function getUIdAttribute()
    {
        return Helper::encrypt($this->id);
    }
}
