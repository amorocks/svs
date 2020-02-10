<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
        for($i = 0; $i < 40; $i++)
        {
        	$user = new App\User();
        	$user->id = "D".rand(100000, 999999);
        	$user->name = $faker->name;
        	$user->email = $faker->safeEmail;
        	$user->type = 'student';
        	$user->mentor_id = rand(0,1) ? 'br10' : 'ab01';
        	$user->save();
        }
    }
}
