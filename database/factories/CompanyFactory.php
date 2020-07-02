<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $logo = factory(App\Models\File::class)->create(["additional" => "company"]);
    return [
        //
        "name" => $faker->company,
        "address" => $faker->address,
        "phone" => $faker->phoneNumber,
        "email" => $faker->companyEmail,
        "url" => $faker->url,
        "logo" =>$logo->id
    ];
});
