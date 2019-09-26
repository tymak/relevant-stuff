<?php

use Illuminate\Database\Seeder;
use App\Owner;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::create([
            'user_id'     => 3,
            'building_id'    => 1,
        ]);
    }
}
