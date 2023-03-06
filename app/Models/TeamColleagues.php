<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamColleagues extends Model
{
    use HasFactory;
    protected $table = 'team_and_colegues';
    protected $guarded = [];

    // protected $appends = ['tac_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'tac_id', 'id');
    }
}
