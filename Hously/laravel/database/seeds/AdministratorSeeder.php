<?php

use Illuminate\Database\Seeder;
use App\Administrator;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrator::create([
            'user_id'     => 2,
            'building_id'    => 1,
        ]);
    }
}
