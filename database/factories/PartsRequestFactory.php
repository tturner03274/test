<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\PartsRequest::class, function (Faker $faker) {

    $faker->addProvider(new \MattWells\Faker\Vehicle\Provider($faker));

    $created_at = \Carbon\Carbon::createFromTimeStamp($faker->dateTimeBetween('-2 hours', 'now')->getTimestamp());

    $vehicleMake = $faker->vehicleMake;

    return [
        'user_id' => 3,
        'vehicle_registration' => $faker->vehicleRegistration,
        'vehicle_make' => $vehicleMake,
        'vehicle_model' => $faker->vehicleModel($vehicleMake),
        'vehicle_year' => $faker->biasedNumberBetween(1998, 2019, 'sqrt'),
        'parts_description' => $faker->sentences($nb = 2, $asText = true),
        'deadline' => $faker->randomElement([15, 30, 60, 90, 120]),
        'delivery_postcode' => $faker->postcode,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});
