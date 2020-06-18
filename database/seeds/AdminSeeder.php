<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //first admin must has: login_id:admin, password: password
        factory(App\Models\Admin::class, 1)->create(["login_id" => "admin", "password" => "password"]);
        factory(App\Models\Admin::class, 4)->create();
    }
}
