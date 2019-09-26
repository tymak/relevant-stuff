<?php

use Illuminate\Database\Seeder;
use App\Noticeboard;

class NoticeboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Noticeboard::create([
            'building_id'    => 1,
        ]);
        
        Noticeboard::create([
            'building_id'    => 2,
        ]);
    }
}
