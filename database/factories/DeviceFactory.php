<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    $image = factory(App\Models\File::class)->create(["additional" => "device"]);
    return [
        //
        "code" => $faker->isbn10,
        "name" => $faker->firstName,
        "price"=> $faker->randomNumber(3),
        "company_id" => App\Models\Company::all()->random()->id,
        "image" => $image->id,
    ];
});
