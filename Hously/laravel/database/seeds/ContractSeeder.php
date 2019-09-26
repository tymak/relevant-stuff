<?php

use Illuminate\Database\Seeder;
use App\Contract;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contract::create([
            'name'     => 'Na Dobu Neurčitou',
            'type'    => 'Nájemní',
        ]);

        Contract::create([
            'name'     => 'Na Dobu Určitou',
            'type'    => 'Nájemní',
        ]);
    }
}
