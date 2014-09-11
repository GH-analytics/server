<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            Eloquent::unguard();
            
            // Run seeders if developing
            if (app()->env == "development") {
                
                $this->call('UsersTableSeeder');
                
                $this->call('UploadsTableSeeder');
            }
	}

}
