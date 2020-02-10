<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        //Create a unit
        $unit = new \App\Unit();
        $unit->title = "TT-ICO";
        $unit->save();

        //Create an education
        $education = new \App\Education();
        $education->unit_id = 1;
        $education->title = "Software Developer";
        $education->crebo = "25604";
        $education->points = "400";
        $education->save();
    }
}
