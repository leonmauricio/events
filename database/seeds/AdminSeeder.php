<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
	        'name' => 'Mauricio',
	        'email' => 'mauriciomunoz011@gmail.com',
	        'password' => bcrypt('123456'),
	        'remember_token' => str_random(10),
	        'admin' => 1,
	    ]);
    }
}
