<?php

use Illuminate\Database\Seeder;
use App\Superuser;

class SuperuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Superuser::create([
            'user_id'     => 1,
        ]);
    }
}
