<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PartRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        factory(\App\PartsRequest::class, 100)->create();

        $faker->addProvider(new \MattWells\Faker\Vehicle\Provider($faker));

        $created_at = \Carbon\Carbon::createFromTimeStamp($faker->dateTimeBetween('-5 minutes', 'now')->getTimestamp());

        $vehicleMake = $faker->vehicleMake;

        // generate a local request
        $localPartRequest = \App\PartsRequest::create([
            'user_id' => 3,
            'vehicle_registration' => $faker->vehicleRegistration,
            'vehicle_make' => $vehicleMake,
            'vehicle_model' => $faker->vehicleModel($vehicleMake),
            'vehicle_year' => $faker->biasedNumberBetween(1998, 2019, 'sqrt'),
            'parts_description' => $faker->sentences($nb = 2, $asText = true),
            'deadline' => $faker->randomElement([90, 120]),
            'delivery_postcode' => 'CM21 9JX',
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
    }
}
