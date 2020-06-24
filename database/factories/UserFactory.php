<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $avatar = factory(App\Models\File::class)->create(["path" => "user"]);
    return [
        "login_id" => $faker->userName,
        "password" => $faker->password,
        "first_name" => $faker->firstName,
        "last_name" => $faker->lastName,
        "email" => $faker->email,
        "gender" => $faker->biasedNumberBetween(0, 1),
        "address" => $faker->address,
        "birthday" => $faker->dateTimeThisCentury->format("d/m/Y"),
        "code" => $faker->isbn10,
        "company_id" => App\Models\Company::all()->random()->id,
        "avatar" => $avatar->id,
        "position" => $faker->biasedNumberBetween(0, 3),
        "start_at" => $faker->dateTimeThisCentury->format("d/m/Y"),
    ];
});
