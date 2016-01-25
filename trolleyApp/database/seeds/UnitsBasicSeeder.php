<?php

use Illuminate\Database\Seeder;

class UnitsBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('units')->insert([
        	'unit_name' => 'Kilograms',
        	'shortform' => 'Kg'
        ]);
        DB::table('units')->insert([
        	'unit_name' => 'grams',
        	'shortform' => 'g'
        ]);
        DB::table('units')->insert([
        	'unit_name' => 'litres',
        	'shortform' => 'l'
        ]);
        DB::table('units')->insert([
        	'unit_name' => 'millilitre',
        	'shortform' => 'ml'
        ]);
        DB::table('units')->insert([
        	'unit_name' => 'pieces',
        	'shortform' => 'pcs'
        ]);
    }
}
