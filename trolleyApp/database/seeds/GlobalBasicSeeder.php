<?php

use Illuminate\Database\Seeder;

class GlobalBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('globalsettings')->insert([
        	[
	        	'name' => 'appname',
	        	'value' => 'Trolleyin'
	        ],
        	[
	        	'name' => 'tagline',
	        	'value' => 'Awesome Shopping'
	        ],
        	[
	        	'name' => 'helpline',
	        	'value' => '9443385256',
	        ],
        	[
	        	'name' => 'sales',
	        	'value' => '9443385256',
	        ],
        	[
	        	'name' => 'delivery',
	        	'value' => '9443385256',
	        ],
        	[
	        	'name' => 'fblink',
	        	'value' => 'https://www.facebook.com/Trolleyincom-349633465160538/',
	        ],
        	[
	        	'name' => 'twitlink',
	        	'value' => 'https://twitter.com/trolleytry',
	        ],
        	[
	        	'name' => 'gplink',
	        	'value' => 'google.com',
	        ],
        	[
	        	'name' => 'salesemail',
	        	'value' => 'info@trolleyin.com',
	        ]

        ]);
    }
}
