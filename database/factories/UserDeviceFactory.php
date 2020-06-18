<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserDevice;
use Faker\Generator as Faker;

$factory->define(UserDevice::class, function (Faker $faker) {
    return [
        //
        "user_id" => App\Models\User::all()->random()->id,
        "device_id" => App\Models\Device::all()->random()->id,
        "is_using" => $faker->boolean()
    ];
});
