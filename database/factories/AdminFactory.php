<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    $avatar = factory(App\Models\File::class)->create(["additional" => "admin"]);
    return [
        //
        "login_id" => $faker->userName,
        "password" => $faker->password,
        "first_name" => $faker->firstName,
        "last_name" => $faker->lastName,
        "email" => $faker->email,
        "gender" => $faker->biasedNumberBetween(0, 1),
        "address" => $faker->address,
        "birthday" => $faker->dateTimeBetween('-50 years', 'now')->format("d/m/Y"),
        "avatar" => $avatar->id,
    ];
});
