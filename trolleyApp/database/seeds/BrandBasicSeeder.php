<?php

use Illuminate\Database\Seeder;

class BrandBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('brands')->insert([
        	'brand_name' => 'Trolley Retail',
        ]);
    }
}
