<?php

use Illuminate\Database\Seeder;
use App\Schedules;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Schedules::class,20)->create();
    }
}
