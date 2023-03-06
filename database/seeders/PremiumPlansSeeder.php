<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PremiumPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon::now();

        DB::table('premium_plans')->updateOrInsert(['id' => 1 ],[
            'total_months' => 1,
            'price_per_month' => 16,
            'discount_in_percentage' => 0,
            'period_time' => "Monthly",
            'created_at' => $mytime->toDateTimeString(),
            'updated_at' => $mytime->toDateTimeString(),
        ]);
        DB::table('premium_plans')->updateOrInsert(['id' => 2 ],[
            'total_months' => 3,
            'price_per_month' => 14,
            'discount_in_percentage' => 12,
            'period_time' => "Quarterly",
            'created_at' => $mytime->toDateTimeString(),
            'updated_at' => $mytime->toDateTimeString(),
        ]);
        
        DB::table('premium_plans')->updateOrInsert(['id' => 3 ],[
            'total_months' => 6,
            'price_per_month' => 12,
            'discount_in_percentage' => 25,
            'period_time' => "Bi Annual",
            'created_at' => $mytime->toDateTimeString(),
            'updated_at' => $mytime->toDateTimeString(),
        ]);

         DB::table('premium_plans')->updateOrInsert(['id' => 4 ],[
            'total_months' => 12,
            'price_per_month' => 10,
            'discount_in_percentage' => 37,
            'period_time' => "Annual",
            'created_at' => $mytime->toDateTimeString(),
            'updated_at' => $mytime->toDateTimeString(),
        ]);
    }
}



