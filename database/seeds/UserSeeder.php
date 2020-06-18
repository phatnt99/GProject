<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\User::class, 1)->create(["login_id" => "user", "password" => "password"]);
        factory(App\Models\User::class, 4)->create();
    }
}
