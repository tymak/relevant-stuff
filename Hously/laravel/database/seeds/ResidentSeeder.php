<?php

use Illuminate\Database\Seeder;
use App\Resident;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resident::create([
            'user_id'     => 4,
            'flat_id'    => 1,
            'building_id' => 1,
            'begining_of_first_rent'    => '2001-01-01',
            'begining_of_current_rent'    => '2005-01-01',
            'contract_id'    => 1,
            'end_of_current_rent' => null,
            'number_of_residents'    => 1,
            'rental'    => 12000,
        ]);
    }
}
