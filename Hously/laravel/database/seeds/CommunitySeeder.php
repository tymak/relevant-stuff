<?php

use Illuminate\Database\Seeder;
use App\Community;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Community::create([
            'chat_id'     => 1,
            'building_id'    => 1,
            'community_name'    => 'Obecná komunita',
        ]);
        Community::create([
            'chat_id'     => 2,
            'building_id'    => 1,
            'community_name'    => 'Zábava',
        ]);

        Community::create([
            'chat_id'     => 3,
            'building_id'    => 2,
            'community_name'    => 'Obecná komunita',
        ]);
    }
}
