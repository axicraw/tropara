<?php

use Illuminate\Database\Seeder;

class AreaBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('areas')->insert([
        	'area_name' => 'Thillainagar',
        	'delivery_cost' => '20',
        	'city_id' => 1,
            'deliverable'=> 1
        ]);
         DB::table('areas')->insert([
        	'area_name' => 'Beemanagar',
        	'delivery_cost' => '20',
        	'city_id' => 1,
            'deliverable'=> 1
        ]);
         DB::table('areas')->insert([
        	'area_name' => 'Cantonment',
        	'delivery_cost' => '20',
        	'city_id' => 1,
            'deliverable'=> 1
        ]);
         DB::table('areas')->insert([
        	'area_name' => 'Bharathiyar Salai',
        	'delivery_cost' => '20',
        	'city_id' => 1,
            'deliverable'=> 1
        ]);
         DB::table('areas')->insert([
        	'area_name' => 'Palakarai',
        	'delivery_cost' => '20',
        	'city_id' => 1,
            'deliverable'=> 1
        ]);
    }
}
