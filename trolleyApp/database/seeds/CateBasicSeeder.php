<?php

use Illuminate\Database\Seeder;

class CateBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('categories')->insert([
        	'category_name' => 'Vegetables',
        ]);
        DB::table('categories')->insert([
        	'category_name' => 'Grocery',
        ]);
    }
}
