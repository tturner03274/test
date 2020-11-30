<?php

use Illuminate\Database\Seeder;

class PartAvailabilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $availabilities = [
            "On the shelf",
            "Same day",
            "Next day",
            "Back order",
        ];

        $seed_data = [];
        $i = 0;
        foreach ($availabilities as $availability) {
            $seed_data[$i]['name'] = $availability;
            $seed_data[$i]['created_at'] = Carbon\Carbon::now();
            $seed_data[$i]['updated_at'] = Carbon\Carbon::now();
            $i++;
        }
        // generate the default user roles
        DB::table('part_availabilities')->insert($seed_data);
    }
}
