<?php

use Illuminate\Database\Seeder;
use App\Flat;

class FlatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flat::create([
            'building_id'     => 1,
            'floor'    => 1,
            'number' => 1,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 1,
            'floor'    => 1,
            'number' => 2,
            'residential' => 0,
        ]);

        Flat::create([
            'building_id'     => 1,
            'floor'    => 1,
            'number' => 3,
            'residential' => 0,
        ]);
        
        Flat::create([
            'building_id'     => 1,
            'floor'    => 1,
            'number' => 4,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 1,
            'floor'    => 2,
            'number' => 5,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 1,
            'floor'    => 2,
            'number' => 6,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 1,
            'floor'    => 2,
            'number' => 7,
            'residential' => 1,
        ]);
        
        Flat::create([
            'building_id'     => 1,
            'floor'    => 2,
            'number' => 8,
            'residential' => 1,
        ]);



        Flat::create([
            'building_id'     => 2,
            'floor'    => 1,
            'number' => 1,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 1,
            'number' => 2,
            'residential' => 0,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 1,
            'number' => 3,
            'residential' => 0,
        ]);
        
        Flat::create([
            'building_id'     => 2,
            'floor'    => 1,
            'number' => 4,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 2,
            'number' => 5,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 2,
            'number' => 6,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 2,
            'number' => 7,
            'residential' => 1,
        ]);
        
        Flat::create([
            'building_id'     => 2,
            'floor'    => 2,
            'number' => 8,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 3,
            'number' => 9,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 3,
            'number' => 10,
            'residential' => 1,
        ]);

        Flat::create([
            'building_id'     => 2,
            'floor'    => 3,
            'number' => 11,
            'residential' => 1,
        ]);
        
        Flat::create([
            'building_id'     => 2,
            'floor'    => 3,
            'number' => 12,
            'residential' => 1,
        ]);
    }
}
