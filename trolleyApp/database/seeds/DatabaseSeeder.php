<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UnitsBasicSeeder::class);
        $this->call(BrandBasicSeeder::class);
        $this->call(CateBasicSeeder::class);
        $this->call(AreaBasicSeeder::class);

        Model::reguard();
    }
}
