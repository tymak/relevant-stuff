<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'     => 'Admin',
            'last_name'    => 'Novák',
            'birth_date'    => '2001-01-01',
            'phone_number'    => 123456789,
            'email'    => 'admin@admin.com',
            'password' => bcrypt('123456789')
        ]);
        User::create([
            'first_name'     => 'Vlastník',
            'last_name'    => 'Vlastnikov',
            'birth_date'    => '2001-01-01',
            'phone_number'    => 987654321,
            'email'    => 'vlastnik@vlastnik.com',
            'password' => bcrypt('123456789')
        ]);

        User::create([
            'first_name'     => 'Anna',
            'last_name'    => 'Obyvatelová',
            'birth_date'    => '2001-01-01',
            'phone_number'    => 456123789,
            'email'    => 'obyvatel@obyvatel.com',
            'password' => bcrypt('123456789')
        ]);

        User::create([
            'first_name'     => 'Nina',
            'last_name'    => 'Nováková',
            'birth_date'    => '2001-01-01',
            'phone_number'    => 147258369,
            'email'    => 'nova@nova.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
