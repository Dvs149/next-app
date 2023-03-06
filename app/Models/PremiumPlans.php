<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumPlans extends Model
{
    use HasFactory;
    protected $table = 'premium_plans';
    protected $guarded = [];
    
}
