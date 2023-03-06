<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    use HasFactory;
    protected $table = 'business_info';
    protected $guarded = [];
    protected $appends = ['document_file_url'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getDocumentFileUrlAttribute()
    {
        if(isset($this->attributes['document_file']))
        {
            return $this->attributes['document_file'] ? url(config('custom.DOCUMENT_FILE_URL_PATH')).'/'.$this->attributes['document_file'] : null;
        }
    }
}
