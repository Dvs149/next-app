<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon::now();

        Reward::updateOrInsert(['id' => 1 ],[
                        'r_type' => 'gold',
                        'r_point' => '10000',
                        'tag_line' => 'Get a free metal card',
                        'created_at' => $mytime->toDateTimeString(),
                        'updated_at' => $mytime->toDateTimeString()
            ]);
            Reward::updateOrInsert(['id' => 2 ],[
                        'r_type' => 'silver',
                        'r_point' => '6000',
                        'tag_line' => 'Get a free plastic card',
                        'created_at' => $mytime->toDateTimeString(),
                        'updated_at' => $mytime->toDateTimeString()
            ]);
            Reward::updateOrInsert(['id' => 3 ],[
                        'r_type' => 'bronze',
                        'r_point' => '3000',
                        'tag_line' => 'Get a free tag',
                        'created_at' => $mytime->toDateTimeString(),
                        'updated_at' => $mytime->toDateTimeString()
            ]);
    }
}
