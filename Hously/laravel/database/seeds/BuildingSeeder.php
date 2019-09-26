<?php

use Illuminate\Database\Seeder;
use App\Building;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::create([
            'city'     => 'Praha',
            'street'    => 'Na Prikope',
            'house_number'    => 1,
            'postal'    => 11000,
            'owner_id'    => 1,
            'construction_date' => '2019-06-20',
            'floors_above_ground' => 2,
            'floors_bellow_ground' => 1,
            'heating' => 1,
            'gas' => 1,
            'elevator' => 1,

        ]);
        Building::create([
            'city'     => 'Praha',
            'street'    => 'Opletalova',
            'house_number'    => 57,
            'postal'    => 11000,
            'construction_date' => '2019-06-20',
            'floors_above_ground' => 3,
            'floors_bellow_ground' => 1,
            'heating' => 1,
            'gas' => 1,
            'elevator' => 1,
            ]);
    }
}
